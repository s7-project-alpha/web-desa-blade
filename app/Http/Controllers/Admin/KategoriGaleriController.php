<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = KategoriGaleri::getAllForAdmin();

        return view('admin.kategori-galeri.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nextUrutan = KategoriGaleri::getNextUrutan();

        return view('admin.kategori-galeri.create', compact('nextUrutan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:kategori_galeri,slug',
            'deskripsi' => 'nullable|string',
            'warna_badge' => 'required|string|max:7',
            'is_active' => 'boolean',
            'urutan' => 'required|integer|min:0'
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = KategoriGaleri::generateUniqueSlug($validated['nama_kategori']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['is_active'] = $request->has('is_active');

        KategoriGaleri::create($validated);

        return redirect()
            ->route('admin.kategori-galeri.index')
            ->with('success', 'Kategori galeri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriGaleri $kategoriGaleri)
    {
        $kategoriGaleri->load(['galeri' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return view('admin.kategori-galeri.show', compact('kategoriGaleri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriGaleri $kategoriGaleri)
    {
        return view('admin.kategori-galeri.edit', compact('kategoriGaleri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriGaleri $kategoriGaleri)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:kategori_galeri,slug,' . $kategoriGaleri->id,
            'deskripsi' => 'nullable|string',
            'warna_badge' => 'required|string|max:7',
            'is_active' => 'boolean',
            'urutan' => 'required|integer|min:0'
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = KategoriGaleri::generateUniqueSlug($validated['nama_kategori'], $kategoriGaleri->id);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['is_active'] = $request->has('is_active');

        $kategoriGaleri->update($validated);

        return redirect()
            ->route('admin.kategori-galeri.index')
            ->with('success', 'Kategori galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriGaleri $kategoriGaleri)
    {
        // Check if category has galeri
        if ($kategoriGaleri->galeri()->count() > 0) {
            return redirect()
                ->route('admin.kategori-galeri.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki galeri.');
        }

        $kategoriGaleri->delete();

        return redirect()
            ->route('admin.kategori-galeri.index')
            ->with('success', 'Kategori galeri berhasil dihapus.');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(KategoriGaleri $kategoriGaleri)
    {
        $kategoriGaleri->update([
            'is_active' => !$kategoriGaleri->is_active
        ]);

        $status = $kategoriGaleri->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()
            ->route('admin.kategori-galeri.index')
            ->with('success', "Kategori galeri berhasil {$status}.");
    }
}
