<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\KategoriGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Galeri::with('kategori');

        // Filter by category
        if ($request->kategori_id) {
            $query->where('kategori_galeri_id', $request->kategori_id);
        }

        // Search
        if ($request->search) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->status !== null) {
            $query->where('is_active', $request->status);
        }

        // Filter by featured
        if ($request->featured !== null) {
            $query->where('is_featured', $request->featured);
        }

        $galeri = $query->latest()->paginate(12)->withQueryString();
        $kategoris = KategoriGaleri::active()->ordered()->get();

        return view('admin.galeri.index', compact('galeri', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = KategoriGaleri::active()->ordered()->get();
        $nextUrutan = Galeri::getNextUrutan();

        return view('admin.galeri.create', compact('kategoris', 'nextUrutan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_galeri_id' => 'required|exists:kategori_galeri,id',
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:galeri,slug',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB
            'alt_text' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'urutan' => 'required|integer|min:0',
            'photographer' => 'nullable|string|max:255',
            'tanggal_foto' => 'nullable|date',
            'lokasi' => 'nullable|string|max:255'
        ]);

        // Handle photo upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('galeri', $fileName, 'public');

            $validated['foto_path'] = $filePath;
            $validated['foto_original_name'] = $file->getClientOriginalName();

            // Store metadata
            $validated['metadata'] = [
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'extension' => $file->getClientOriginalExtension()
            ];
        }

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Galeri::generateUniqueSlug($validated['judul']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Set alt_text if not provided
        if (empty($validated['alt_text'])) {
            $validated['alt_text'] = $validated['judul'];
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        Galeri::create($validated);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        $galeri->load('kategori');

        return view('admin.galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        $kategoris = KategoriGaleri::active()->ordered()->get();

        return view('admin.galeri.edit', compact('galeri', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'kategori_galeri_id' => 'required|exists:kategori_galeri,id',
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:galeri,slug,' . $galeri->id,
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB
            'alt_text' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'urutan' => 'required|integer|min:0',
            'photographer' => 'nullable|string|max:255',
            'tanggal_foto' => 'nullable|date',
            'lokasi' => 'nullable|string|max:255'
        ]);

        // Handle photo upload if new file provided
        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($galeri->foto_path && Storage::disk('public')->exists($galeri->foto_path)) {
                Storage::disk('public')->delete($galeri->foto_path);
            }

            $file = $request->file('foto');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('galeri', $fileName, 'public');

            $validated['foto_path'] = $filePath;
            $validated['foto_original_name'] = $file->getClientOriginalName();

            // Store metadata
            $validated['metadata'] = [
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'extension' => $file->getClientOriginalExtension()
            ];
        }

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Galeri::generateUniqueSlug($validated['judul'], $galeri->id);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Set alt_text if not provided
        if (empty($validated['alt_text'])) {
            $validated['alt_text'] = $validated['judul'];
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $galeri->update($validated);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        // Delete photo file
        if ($galeri->foto_path && Storage::disk('public')->exists($galeri->foto_path)) {
            Storage::disk('public')->delete($galeri->foto_path);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Galeri $galeri)
    {
        $galeri->update([
            'is_active' => !$galeri->is_active
        ]);

        $status = $galeri->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', "Galeri berhasil {$status}.");
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Galeri $galeri)
    {
        $galeri->update([
            'is_featured' => !$galeri->is_featured
        ]);

        $status = $galeri->is_featured ? 'dijadikan unggulan' : 'dihapus dari unggulan';

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', "Galeri berhasil {$status}.");
    }
}
