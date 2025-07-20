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
            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik."
            ]);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string|max:2000',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'telepon.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
            'subjek.required' => 'Subjek wajib diisi.',
            'subjek.max' => 'Subjek tidak boleh lebih dari 255 karakter.',
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.max' => 'Pesan tidak boleh lebih dari 2000 karakter.',
        ]);

        try {
            // Create message record
            $kontakMessage = KontakMessage::create([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'telepon' => $validated['telepon'],
                'subjek' => $validated['subjek'],
                'pesan' => $validated['pesan'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Send email to desa
            $kontakDesa = Kontak::getActive();
            if ($kontakDesa && $kontakDesa->email) {
                Mail::to($kontakDesa->email)->send(new KontakMessageMail($kontakMessage));
            }

            // Increment rate limiter
            RateLimiter::hit($key, 300); // 5 minutes

            return response()->json([
                'success' => true,
                'message' => 'Pesan Anda berhasil dikirim. Terima kasih!'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error sending kontak message: ' . $e->getMessage());

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
        // Mark as read
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
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus pesan'
            ], 500);
        }
    }
}
