<?php
// app/Http/Controllers/Admin/BeritaController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::with(['kategori', 'author'])
            ->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori_berita_id', $request->kategori);
        }

        // Filter by jenis
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $beritas = $query->paginate(15);
        $kategoris = KategoriBerita::getForSelect();
        $statistics = Berita::getStatistics();

        return view('admin.berita.index', compact('beritas', 'kategoris', 'statistics'));
    }

    public function create()
    {
        $kategoris = KategoriBerita::getForSelect();
        return view('admin.berita.form', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:beritas,slug',
            'ringkasan' => 'required|string|max:500',
            'konten' => 'required|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_berita_id' => 'required|exists:kategori_beritas,id',
            'jenis' => 'required|in:berita,pengumuman',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'is_urgent' => 'boolean',
            'tanggal_publikasi' => 'nullable|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_publikasi',
            'tags' => 'nullable|string',
            'sumber' => 'nullable|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'allow_comments' => 'boolean'
        ]);

        // Handle slug
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['judul']);
        }

        // Handle image upload
        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')
                ->store('berita', 'public');
        }

        // Process tags
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        // Set defaults for checkboxes
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_urgent'] = $request->boolean('is_urgent');
        $validated['allow_comments'] = $request->boolean('allow_comments');

        // Set author
        $validated['user_id'] = auth()->id();

        // Set published_at if status is published
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        Berita::create($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    public function show(Berita $berita)
    {
        $berita = $berita->load(['kategori', 'author']);
        return view('admin.berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        $kategoris = KategoriBerita::getForSelect();
        return view('admin.berita.form', compact('berita', 'kategoris'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:beritas,slug,' . $berita->id,
            'ringkasan' => 'required|string|max:500',
            'konten' => 'required|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_berita_id' => 'required|exists:kategori_beritas,id',
            'jenis' => 'required|in:berita,pengumuman',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'is_urgent' => 'boolean',
            'tanggal_publikasi' => 'nullable|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_publikasi',
            'tags' => 'nullable|string',
            'sumber' => 'nullable|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'allow_comments' => 'boolean'
        ]);

        // Handle slug
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['judul']);
        }

        // Handle image upload
        if ($request->hasFile('gambar_utama')) {
            // Delete old image
            if ($berita->gambar_utama) {
                Storage::disk('public')->delete($berita->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar_utama')
                ->store('berita', 'public');
        }

        // Process tags
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        // Set defaults for checkboxes
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_urgent'] = $request->boolean('is_urgent');
        $validated['allow_comments'] = $request->boolean('allow_comments');

        // Set published_at if status changed to published
        if ($validated['status'] === 'published' && $berita->status !== 'published') {
            $validated['published_at'] = now();
        } elseif ($validated['status'] !== 'published') {
            $validated['published_at'] = null;
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $berita)
    {
        // Delete image file
        if ($berita->gambar_utama) {
            Storage::disk('public')->delete($berita->gambar_utama);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus');
    }

    // PERBAIKAN: Ganti parameter dari $beritum ke $berita
    public function toggleActive(Berita $berita)
    {
        $berita->update([
            'is_active' => !$berita->is_active
        ]);

        $status = $berita->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "Berita berhasil {$status}");
    }

    // PERBAIKAN: Ganti parameter dari $beritum ke $berita
    public function toggleFeatured(Berita $berita)
    {
        $berita->update([
            'is_featured' => !$berita->is_featured
        ]);

        $status = $berita->is_featured ? 'dijadikan berita utama' : 'dihapus dari berita utama';

        return redirect()->back()
            ->with('success', "Berita berhasil {$status}");
    }

    // PERBAIKAN: Ganti parameter dari $beritum ke $berita
    public function publish(Berita $berita)
    {
        $berita->publish();

        return redirect()->back()
            ->with('success', 'Berita berhasil dipublikasikan');
    }

    // PERBAIKAN: Ganti parameter dari $beritum ke $berita
    public function unpublish(Berita $berita)
    {
        $berita->unpublish();

        return redirect()->back()
            ->with('success', 'Berita berhasil dibatalkan publikasinya');
    }

    // PERBAIKAN: Ganti parameter dari $beritum ke $berita
    public function archive(Berita $berita)
    {
        $berita->archive();

        return redirect()->back()
            ->with('success', 'Berita berhasil diarsipkan');
    }

    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:publish,unpublish,archive,delete,toggle_featured',
            'selected_items' => 'required|array|min:1',
            'selected_items.*' => 'exists:beritas,id'
        ]);

        $beritas = Berita::whereIn('id', $validated['selected_items']);

        switch ($validated['action']) {
            case 'publish':
                $beritas->update(['status' => 'published', 'published_at' => now()]);
                $message = 'Berita terpilih berhasil dipublikasikan';
                break;

            case 'unpublish':
                $beritas->update(['status' => 'draft', 'published_at' => null]);
                $message = 'Berita terpilih berhasil dibatalkan publikasinya';
                break;

            case 'archive':
                $beritas->update(['status' => 'archived']);
                $message = 'Berita terpilih berhasil diarsipkan';
                break;

            case 'toggle_featured':
                $beritas->get()->each(function($berita) {
                    $berita->update(['is_featured' => !$berita->is_featured]);
                });
                $message = 'Status berita utama berhasil diubah';
                break;

            case 'delete':
                // Delete associated images
                foreach ($beritas->get() as $berita) {
                    if ($berita->gambar_utama) {
                        Storage::disk('public')->delete($berita->gambar_utama);
                    }
                }
                $beritas->delete();
                $message = 'Berita terpilih berhasil dihapus';
                break;
        }

        return redirect()->back()->with('success', $message);
    }
}
