<?php
// app/Http/Controllers/Admin/KontakController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;
use App\Models\KontakPejabat;
use App\Models\KontakMessage;
use Illuminate\Support\Facades\Storage;

class KontakController extends Controller
{
    /**
     * Display kontak dashboard
     */
    public function index()
    {
        $kontak = Kontak::first();
        $totalPejabat = KontakPejabat::active()->count();
        $totalMessages = KontakMessage::count();
        $unreadMessages = KontakMessage::unread()->count();
        $recentMessages = KontakMessage::latest()->limit(5)->get();

        return view('admin.kontak.index', compact(
            'kontak',
            'totalPejabat',
            'totalMessages',
            'unreadMessages',
            'recentMessages'
        ));
    }

    /**
     * Show form for editing kontak
     */
    public function editKontak()
    {
        $kontak = Kontak::firstOrCreate([
            'nama_kantor' => 'Kantor Desa Tanjung Selamat'
        ], [
            'alamat' => 'Jl. Raya Desa No. 123, Tanjung Selamat',
            'kecamatan' => 'Kec. Sunggal',
            'kabupaten' => 'Kabupaten Deli Serdang',
            'provinsi' => 'Sumatera Utara',
            'kode_pos' => '20353',
            'email' => 'desatanjungselamat@email.com',
            'telepon' => '(061) 123-4567',
            'jam_operasional' => "Senin - Jumat: 08:00 - 16:00 WIB\nSabtu: 08:00 - 12:00 WIB",
            'is_active' => true
        ]);

        return view('admin.kontak.edit-kontak', compact('kontak'));
    }

    /**
     * Update kontak information
     */
    public function updateKontak(Request $request)
    {
        $validated = $request->validate([
            'nama_kantor' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:50',
            'fax' => 'nullable|string|max:50',
            'jam_operasional' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'deskripsi' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        $kontak = Kontak::firstOrFail();
        $kontak->update($validated);

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Informasi kontak berhasil diperbarui!');
    }

    /**
     * Display kontak pejabat list
     */
    public function pejabat(Request $request)
    {
        $query = KontakPejabat::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $pejabat = $query->ordered()->paginate(10);

        return view('admin.kontak.pejabat.index', compact('pejabat'));
    }

    /**
     * Show form for creating kontak pejabat
     */
    public function createPejabat()
    {
        return view('admin.kontak.pejabat.create');
    }

    /**
     * Store kontak pejabat
     */
    public function storePejabat(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'telepon' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string|max:1000',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('kontak-pejabat', 'public');
        }

        KontakPejabat::create($validated);

        return redirect()->route('admin.kontak.pejabat')
            ->with('success', 'Data pejabat berhasil ditambahkan!');
    }

    /**
     * Show form for editing kontak pejabat
     */
    public function editPejabat(KontakPejabat $pejabat)
    {
        return view('admin.kontak.pejabat.edit', compact('pejabat'));
    }

    /**
     * Update kontak pejabat
     */
    public function updatePejabat(Request $request, KontakPejabat $pejabat)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'telepon' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string|max:1000',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('foto')) {
            // Delete old photo
            $pejabat->deleteFoto();
            $validated['foto'] = $request->file('foto')->store('kontak-pejabat', 'public');
        }

        $pejabat->update($validated);

        return redirect()->route('admin.kontak.pejabat')
            ->with('success', 'Data pejabat berhasil diperbarui!');
    }

    /**
     * Toggle pejabat active status
     */
    public function toggleActivePejabat(KontakPejabat $pejabat)
    {
        $pejabat->toggleActive();

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diubah',
            'is_active' => $pejabat->is_active
        ]);
    }

    /**
     * Delete kontak pejabat
     */
    public function destroyPejabat(KontakPejabat $pejabat)
    {
        try {
            $pejabat->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data pejabat berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data'
            ], 500);
        }
    }
}
