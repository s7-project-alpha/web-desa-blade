<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Kontak;
use App\Models\KontakPejabat;
use App\Models\Pkk;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display homepage
     */
    public function index()
    {
        return view('public.index');
    }

    /**
     * Display visi misi page
     */
    public function visiMisi()
    {
        $visiMisi = \App\Models\VisiMisi::getActive();
        return view('public.visi-misi', compact('visiMisi'));
    }

    /**
     * Display demografi page
     */
    public function demografi()
    {
        $demografi = \App\Models\Demografi::getActive();
        return view('public.demografi', compact('demografi'));
    }

    /**
     * Display perangkat desa page
     */
    public function perangkatDesa()
    {
        $perangkatData = \App\Models\PerangkatDesa::getAllForPublic();
        return view('public.perangkat-desa', compact('perangkatData'));
    }

    /**
     * Display bumdes page
     */
    public function bumdes()
    {
        $bumdesData = \App\Models\Bumdes::getCompleteData();
        return view('public.bumdes', compact('bumdesData'));
    }

    /**
     * Display pkk page
     */
    public function pkk()
    {
        $pkkData = Pkk::getCompleteData();
        return view('public.pkk', compact('pkkData'));
    }

    /**
     * Display posyandu page
     */
    public function posyandu()
    {
        $posyanduData = \App\Models\Posyandu::getCompleteData();
        return view('public.posyandu', compact('posyanduData'));
    }

    /**
     * Display berita page
     */
    public function berita(Request $request)
    {
        $filters = [
            'kategori' => $request->kategori,
            'jenis' => $request->jenis,
            'search' => $request->search,
            'per_page' => 12
        ];

        // Get berita with filters
        $beritas = Berita::getForPublic($filters);

        // Get categories for filter
        $kategoris = KategoriBerita::getActiveForPublic();

        // Get featured berita
        $beritaUtama = Berita::getFeaturedForPublic(2);

        // Get latest berita for sidebar
        $beritaTerbaru = Berita::getLatestForPublic(6);

        // Get statistics for categories
        $statistik = [
            'total' => Berita::active()->published()->count(),
            'berita' => Berita::active()->published()->byJenis('berita')->count(),
            'pengumuman' => Berita::active()->published()->byJenis('pengumuman')->count(),
        ];

        // Add category counts
        foreach ($kategoris as $kategori) {
            $statistik['kategori_' . $kategori->slug] = $kategori->berita_count;
        }

        return view('public.berita.index', compact(
            'beritas',
            'kategoris',
            'beritaUtama',
            'beritaTerbaru',
            'statistik',
            'filters'
        ));
    }

    /**
     * Display berita detail page
     */
    public function beritaDetail(Request $request, $slug)
    {
        $berita = Berita::active()
            ->published()
            ->with(['kategori', 'author'])
            ->where(function($query) use ($slug) {
                $query->where('slug', $slug)
                    ->orWhere('id', $slug); // fallback for ID-based URLs
            })
            ->firstOrFail();

        // Increment views
        $berita->incrementViews();

        // Get related berita
        $beritaTerkait = Berita::getRelated($berita, 4);

        // Get latest berita for sidebar
        $beritaTerbaru = Berita::getLatestForPublic(6);

        // Get popular berita
        $beritaPopuler = Berita::active()
            ->published()
            ->popular(30)
            ->with(['kategori'])
            ->limit(5)
            ->get();

        return view('public.berita.detail', compact(
            'berita',
            'beritaTerkait',
            'beritaTerbaru',
            'beritaPopuler'
        ));
    }


    /**
     * Display berita by category
     */
    public function beritaByKategori(Request $request, $kategoriSlug)
    {
        $kategori = KategoriBerita::active()
            ->where('slug', $kategoriSlug)
            ->firstOrFail();

        $filters = [
            'kategori' => $kategoriSlug,
            'jenis' => $request->jenis,
            'search' => $request->search,
            'per_page' => 12
        ];

        $beritas = Berita::getForPublic($filters);

        // Get categories for navigation
        $kategoris = KategoriBerita::getActiveForPublic();

        // Get latest berita for sidebar
        $beritaTerbaru = Berita::getLatestForPublic(6);

        return view('public.berita.kategori', compact(
            'kategori',
            'beritas',
            'kategoris',
            'beritaTerbaru',
            'filters'
        ));
    }

    /**
     * Search berita
     */
    public function searchBerita(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:3|max:255'
        ]);

        $search = $request->q;

        $filters = [
            'search' => $search,
            'kategori' => $request->kategori,
            'jenis' => $request->jenis,
            'per_page' => 12
        ];

        $beritas = Berita::getForPublic($filters);

        // Get categories for filter
        $kategoris = KategoriBerita::getActiveForPublic();

        // Get latest berita for sidebar
        $beritaTerbaru = Berita::getLatestForPublic(6);

        return view('public.berita.search', compact(
            'beritas',
            'kategoris',
            'beritaTerbaru',
            'search',
            'filters'
        ));
    }

    /**
     * Display galeri page
     */
    public function galeri(Request $request)
    {
        $kategoris = \App\Models\KategoriGaleri::getActiveForPublic();

        // Get galeri with filters
        $galeri = \App\Models\Galeri::getAllForPublic(
            kategoriSlug: $request->kategori,
            perPage: 12
        );

        // Get total counts for categories
        $totalGaleri = \App\Models\Galeri::active()->count();

        // Get featured galeri
        $galeriUnggulan = \App\Models\Galeri::getFeaturedForPublic(6);

        return view('public.galeri.index', compact(
            'kategoris',
            'galeri',
            'totalGaleri',
            'galeriUnggulan'
        ));
    }

    /**
     * Display galeri detail page
     */
    public function galeriDetail(Request $request, $slug)
    {
        $galeri = \App\Models\Galeri::active()
            ->with('kategori')
            ->where(function($query) use ($slug) {
                $query->where('slug', $slug)
                      ->orWhere('id', $slug); // fallback for ID-based URLs
            })
            ->firstOrFail();

        // Increment views
        $galeri->incrementViews();

        // Get related galeri
        $relatedGaleri = $galeri->getRelatedGaleri(4);

        // Get latest galeri for sidebar
        $latestGaleri = \App\Models\Galeri::active()
            ->with('kategori')
            ->where('id', '!=', $galeri->id)
            ->latest()
            ->limit(6)
            ->get();

        return view('public.galeri.detail', compact('galeri', 'relatedGaleri', 'latestGaleri'));
    }

    /**
     * Display galeri by category
     */
    public function galeriByKategori(Request $request, $kategoriSlug)
    {
        $kategori = \App\Models\KategoriGaleri::active()
            ->where('slug', $kategoriSlug)
            ->firstOrFail();

        $galeri = \App\Models\Galeri::active()
            ->byKategori($kategoriSlug)
            ->with('kategori')
            ->latest()
            ->paginate(12);

        $kategoris = \App\Models\KategoriGaleri::getActiveForPublic();

        return view('public.galeri.kategori', compact('kategori', 'galeri', 'kategoris'));
    }

    /**
     * Display kontak page
     */
    public function kontak()
    {
        $kontak = \App\Models\Kontak::getForPublic();
        $kontakPejabat = \App\Models\KontakPejabat::getAllForPublic();

        return view('public.kontak', compact('kontak', 'kontakPejabat'));
    }
}
