<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PerangkatDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategori = $request->get('kategori', 'all');

        $query = PerangkatDesa::query();

        if ($kategori !== 'all') {
            $query->byKategori($kategori);
        }

        $perangkatDesa = $query->ordered()->paginate(10);

        $kategoriOptions = PerangkatDesa::getKategoriOptions();

        return view('admin.perangkat-desa.index', compact('perangkatDesa', 'kategoriOptions', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriOptions = PerangkatDesa::getKategoriOptions();

        return view('admin.perangkat-desa.create', compact('kategoriOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kategori' => 'required|in:kepala_desa,perangkat_desa,kepala_dusun,bpd',
            'periode' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'pendidikan' => 'nullable|string',
            'visi' => 'nullable|string',
            'tugas_tanggung_jawab' => 'nullable|string',
            'dusun' => 'nullable|string|max:255',
            'rt_rw' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'urutan' => 'integer|min:0'
        ];

        // Validate kepala desa uniqueness
        if ($request->kategori === 'kepala_desa') {
            $existingKepalaDesa = PerangkatDesa::byKategori('kepala_desa')->active()->first();
            if ($existingKepalaDesa) {
                return back()->withErrors(['kategori' => 'Kepala Desa aktif sudah ada. Nonaktifkan yang lama terlebih dahulu.'])->withInput();
            }
        }

        $validated = $request->validate($rules);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('perangkat-desa', 'public');
        }

        PerangkatDesa::create($validated);

        return redirect()->route('admin.perangkat-desa.index')
            ->with('success', 'Data perangkat desa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PerangkatDesa $perangkatDesa)
    {
        return view('admin.perangkat-desa.show', compact('perangkatDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PerangkatDesa $perangkatDesa)
    {
        $kategoriOptions = PerangkatDesa::getKategoriOptions();

        return view('admin.perangkat-desa.edit', compact('perangkatDesa', 'kategoriOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PerangkatDesa $perangkatDesa)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kategori' => 'required|in:kepala_desa,perangkat_desa,kepala_dusun,bpd',
            'periode' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'pendidikan' => 'nullable|string',
            'visi' => 'nullable|string',
            'tugas_tanggung_jawab' => 'nullable|string',
            'dusun' => 'nullable|string|max:255',
            'rt_rw' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'urutan' => 'integer|min:0'
        ];

        // Validate kepala desa uniqueness
        if ($request->kategori === 'kepala_desa' && $perangkatDesa->kategori !== 'kepala_desa') {
            $existingKepalaDesa = PerangkatDesa::byKategori('kepala_desa')->active()->first();
            if ($existingKepalaDesa) {
                return back()->withErrors(['kategori' => 'Kepala Desa aktif sudah ada. Nonaktifkan yang lama terlebih dahulu.'])->withInput();
            }
        }

        $validated = $request->validate($rules);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($perangkatDesa->foto) {
                Storage::disk('public')->delete($perangkatDesa->foto);
            }
            $validated['foto'] = $request->file('foto')->store('perangkat-desa', 'public');
        }

        $perangkatDesa->update($validated);

        return redirect()->route('admin.perangkat-desa.index')
            ->with('success', 'Data perangkat desa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerangkatDesa $perangkatDesa)
    {
        // Delete foto
        if ($perangkatDesa->foto) {
            Storage::disk('public')->delete($perangkatDesa->foto);
        }

        $perangkatDesa->delete();

        return redirect()->route('admin.perangkat-desa.index')
            ->with('success', 'Data perangkat desa berhasil dihapus.');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(PerangkatDesa $perangkatDesa)
    {
        // Prevent deactivating the only active kepala desa
        if ($perangkatDesa->kategori === 'kepala_desa' && $perangkatDesa->is_active) {
            return back()->withErrors(['error' => 'Tidak dapat menonaktifkan Kepala Desa. Harus ada Kepala Desa yang aktif.']);
        }

        $perangkatDesa->update(['is_active' => !$perangkatDesa->is_active]);

        $status = $perangkatDesa->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.perangkat-desa.index')
            ->with('success', "Data perangkat desa berhasil {$status}.");
    }
}
