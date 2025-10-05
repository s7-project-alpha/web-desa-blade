<?php
// app/Http/Controllers/KontakMessageController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontakMessage;
use App\Models\Kontak;
use App\Mail\KontakMessageMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class KontakMessageController extends Controller
{
    /**
     * Store a newly created message in storage.
     */
    public function store(Request $request)
    {
        // Rate limiting to prevent spam
        $key = 'kontak-message:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik.",
                'errors' => ['email' => ["Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik."]]
            ], 429);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => ['nullable', 'string', 'regex:/^08[0-9]{9,11}$/'],
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string|max:2000',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'telepon.regex' => 'Nomor telepon harus dimulai dengan 08 dan terdiri dari 11-13 digit.',
            'subjek.required' => 'Subjek wajib diisi.',
            'subjek.max' => 'Subjek tidak boleh lebih dari 255 karakter.',
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.max' => 'Pesan tidak boleh lebih dari 2000 karakter.',
        ]);

        try {
            Log::info('Starting message submission process', [
                'email' => $validated['email'],
                'subjek' => $validated['subjek']
            ]);

            // Begin transaction
            DB::beginTransaction();

            try {
                // Create message record first
                $kontakMessage = KontakMessage::create([
                    'nama' => $validated['nama'],
                    'email' => $validated['email'],
                    'telepon' => $validated['telepon'] ?? null,
                    'subjek' => $validated['subjek'],
                    'pesan' => $validated['pesan'],
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);

                Log::info('Message saved to database', ['id' => $kontakMessage->id]);

                // Get active kontak for admin email
                $kontakDesa = Kontak::where('is_active', true)->first();

                if (!$kontakDesa || empty($kontakDesa->email)) {
                    Log::warning('No active contact or email configured');
                    // Still commit the transaction - message is saved
                    DB::commit();

                    return response()->json([
                        'success' => true,
                        'message' => 'Pesan Anda berhasil disimpan. Kami akan segera menghubungi Anda.'
                    ]);
                }

                // Check mail configuration
                if (empty(config('mail.mailers.smtp.host')) || empty(config('mail.from.address'))) {
                    Log::error('Mail configuration incomplete', [
                        'host' => config('mail.mailers.smtp.host'),
                        'from' => config('mail.from.address')
                    ]);

                    // Still commit - message is saved
                    DB::commit();

                    return response()->json([
                        'success' => true,
                        'message' => 'Pesan Anda berhasil disimpan. Kami akan segera menghubungi Anda.'
                    ]);
                }

                // Try to send email
                try {
                    Log::info('Attempting to send email', [
                        'to' => $kontakDesa->email,
                        'from' => config('mail.from.address')
                    ]);

                    Mail::to($kontakDesa->email)->send(new KontakMessageMail($kontakMessage));

                    Log::info('Email sent successfully');

                    // Email sent successfully
                    DB::commit();
                    RateLimiter::hit($key, 300);

                    return response()->json([
                        'success' => true,
                        'message' => 'Pesan Anda berhasil dikirim. Terima kasih!'
                    ]);

                } catch (\Exception $emailError) {
                    Log::error('Email sending failed but message saved', [
                        'error' => $emailError->getMessage(),
                        'trace' => $emailError->getTraceAsString()
                    ]);

                    // Commit anyway - message is saved
                    DB::commit();

                    return response()->json([
                        'success' => true,
                        'message' => 'Pesan Anda berhasil disimpan. Kami akan segera menghubungi Anda.'
                    ]);
                }

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Database error', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('General error in message submission', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Admin: Display messages
     */
    public function index(Request $request)
    {
        $query = KontakMessage::query();

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'read') {
                $query->read();
            } elseif ($request->status === 'unread') {
                $query->unread();
            }
        }

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subjek', 'like', "%{$search}%")
                  ->orWhere('pesan', 'like', "%{$search}%");
            });
        }

        $messages = $query->latest()->paginate(15);
        $unreadCount = KontakMessage::getUnreadCount();

        return view('admin.kontak.messages.index', compact('messages', 'unreadCount'));
    }

    /**
     * Admin: Show specific message
     */
    public function show(KontakMessage $kontakMessage)
    {
        $kontakMessage->markAsRead();
        return view('admin.kontak.messages.show', compact('kontakMessage'));
    }

    /**
     * Admin: Mark message as read/unread
     */
    public function toggleRead(KontakMessage $kontakMessage)
    {
        if ($kontakMessage->is_read) {
            $kontakMessage->markAsUnread();
            $message = 'Pesan ditandai sebagai belum dibaca';
        } else {
            $kontakMessage->markAsRead();
            $message = 'Pesan ditandai sebagai sudah dibaca';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'is_read' => $kontakMessage->is_read
        ]);
    }

    /**
     * Admin: Delete message
     */
    public function destroy(KontakMessage $kontakMessage)
    {
        try {
            $kontakMessage->delete();
            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting message', [
                'id' => $kontakMessage->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus pesan'
            ], 500);
        }
    }
}
