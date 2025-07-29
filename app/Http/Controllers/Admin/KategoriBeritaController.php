<?php
// app/Http/Controllers/Admin/KategoriBeritaController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriBeritaController extends Controller
{
    public function index()
    {
        $kategoris = KategoriBerita::withCount(['beritas', 'beritasActive'])
            ->orderBy('urutan')
            ->orderBy('nama')
            ->get();

        return view('admin.kategori-berita.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori-berita.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:kategori_beritas,slug',
            'deskripsi' => 'nullable|string',
            'warna' => 'required|string|size:7',
            'icon' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer|min:0'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['nama']);
        }

        $validated['urutan'] = $validated['urutan'] ?? 0;

        KategoriBerita::create($validated);

        return redirect()->route('admin.kategori-berita.index')
            ->with('success', 'Kategori berita berhasil ditambahkan');
    }

    // PERBAIKAN UTAMA: Tambahkan withCount untuk menghitung total berita
    public function show(KategoriBerita $kategoriBerita)
    {
        // Load kategori dengan count berita dan berita terbaru
        $kategoriBerita = $kategoriBerita->loadCount([
            'beritas', // Total semua berita
            'beritasActive', // Berita yang aktif dan published
            'beritas as beritas_published_count' => function($query) {
                $query->where('status', 'published');
            },
            'beritas as beritas_draft_count' => function($query) {
                $query->where('status', 'draft');
            }
        ])->load(['beritas' => function($query) {
            $query->with('author')->latest()->limit(10);
        }]);

        return view('admin.kategori-berita.show', compact('kategoriBerita'));
    }

    public function edit(KategoriBerita $kategoriBerita)
    {
        return view('admin.kategori-berita.form', compact('kategoriBerita'));
    }

    public function update(Request $request, KategoriBerita $kategoriBerita)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:kategori_beritas,slug,' . $kategoriBerita->id,
            'deskripsi' => 'nullable|string',
            'warna' => 'required|string|size:7',
            'icon' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer|min:0'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['nama']);
        }

        $validated['urutan'] = $validated['urutan'] ?? 0;

        $kategoriBerita->update($validated);

        return redirect()->route('admin.kategori-berita.index')
            ->with('success', 'Kategori berita berhasil diperbarui');
    }

    public function destroy(KategoriBerita $kategoriBerita)
    {
        try {
            // Check if category has articles
            if ($kategoriBerita->beritas()->count() > 0) {
                return redirect()->route('admin.kategori-berita.index')
                    ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki berita');
            }

            $nama = $kategoriBerita->nama;
            $kategoriBerita->delete();

            return redirect()->route('admin.kategori-berita.index')
                ->with('success', "Kategori berita '{$nama}' berhasil dihapus");
        } catch (\Exception $e) {
            return redirect()->route('admin.kategori-berita.index')
                ->with('error', 'Terjadi kesalahan saat menghapus kategori: ' . $e->getMessage());
        }
    }

    public function toggleActive(KategoriBerita $kategoriBerita)
    {
        $kategoriBerita->update([
            'is_active' => !$kategoriBerita->is_active
        ]);

        $status = $kategoriBerita->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "Kategori berita berhasil {$status}");
    }
}
