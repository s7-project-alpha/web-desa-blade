<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        // Basic statistics for dashboard
        $stats = [
            'total_admin' => User::where('role', 'admin')->count(),
            'total_super_admin' => User::where('role', 'super_admin')->count(),
            'active_users' => User::where('is_active', true)->count(),
            'total_users' => User::count(),

            // Perangkat Desa stats
            'total_perangkat' => \App\Models\PerangkatDesa::active()->count(),
            'kepala_desa' => \App\Models\PerangkatDesa::byKategori('kepala_desa')->active()->count(),

            // BUMDes stats
            'bumdes_active' => \App\Models\Bumdes::where('is_active', true)->count(),
            'unit_usaha_count' => \App\Models\BumdesUnitUsaha::where('is_active', true)->count(),
            'tim_manajemen_count' => \App\Models\BumdesTimManajemen::where('is_active', true)->count(),

            // PKK stats
            'pkk_active' => \App\Models\Pkk::where('is_active', true)->count(),
            'pkk_program_kerja' => \App\Models\PkkProgramKerja::active()->count(),
            'pkk_pengurus' => \App\Models\PkkPengurus::active()->count(),
            'pkk_kegiatan' => \App\Models\PkkKegiatan::active()->count(),
            'pkk_kegiatan_mendatang' => \App\Models\PkkKegiatan::upcoming()->count(),

            // Posyandu stats
            'posyandu_active' => \App\Models\Posyandu::active()->count(),
            'total_posyandu' => \App\Models\Posyandu::count(),
            'total_balita_posyandu' => \App\Models\Posyandu::active()->sum('total_balita'),
            'balita_gizi_baik_posyandu' => \App\Models\Posyandu::active()->sum('balita_gizi_baik'),
            'tenaga_kesehatan_posyandu' => \App\Models\PosyanduTenagaKesehatan::active()->count(),
            'kegiatan_posyandu_mendatang' => \App\Models\PosyanduKegiatan::upcoming()->count(),
            'layanan_posyandu_active' => \App\Models\PosyanduLayanan::active()->count(),
            'avg_cakupan_imunisasi' => round(\App\Models\Posyandu::active()->avg('cakupan_imunisasi'), 1),
            'total_ibu_hamil' => \App\Models\Posyandu::active()->sum('ibu_hamil_aktif'),

            // Berita stats
            'total_berita' => \App\Models\Berita::count(),
            'berita_published' => \App\Models\Berita::published()->count(),
            'berita_draft' => \App\Models\Berita::where('status', 'draft')->count(),
            'berita_featured' => \App\Models\Berita::featured()->published()->count(),
            'berita_jenis_berita' => \App\Models\Berita::byJenis('berita')->published()->count(),
            'berita_jenis_pengumuman' => \App\Models\Berita::byJenis('pengumuman')->published()->count(),
            'berita_views_total' => \App\Models\Berita::published()->sum('views'),
            'berita_bulan_ini' => \App\Models\Berita::published()
                ->whereMonth('published_at', now()->month)
                ->whereYear('published_at', now()->year)
                ->count(),
            'kategori_berita_active' => \App\Models\KategoriBerita::active()->count(),
            'total_kategori_berita' => \App\Models\KategoriBerita::count(),

            // Galeri stats
            'total_galeri' => \App\Models\Galeri::count(),
            'galeri_active' => \App\Models\Galeri::active()->count(),
            'galeri_featured' => \App\Models\Galeri::featured()->count(),
            'kategori_galeri_active' => \App\Models\KategoriGaleri::active()->count(),

            // Kontak stats
            'total_kontak_pejabat' => \App\Models\KontakPejabat::active()->count(),
            'total_kontak_messages' => \App\Models\KontakMessage::count(),
            'unread_messages' => \App\Models\KontakMessage::unread()->count(),
            'recent_messages' => \App\Models\KontakMessage::recent(7)->count(),

            // Pengajuan Surat stats
            'total_pengajuan_surat' => \App\Models\PengajuanSurat::count(),
            'pengajuan_pending' => \App\Models\PengajuanSurat::byStatus('pending')->count(),
            'pengajuan_diproses' => \App\Models\PengajuanSurat::byStatus('diproses')->count(),
            'pengajuan_selesai' => \App\Models\PengajuanSurat::byStatus('selesai')->count(),
            'pengajuan_ditolak' => \App\Models\PengajuanSurat::byStatus('ditolak')->count(),
            'pengajuan_hari_ini' => \App\Models\PengajuanSurat::whereDate('created_at', today())->count(),
            'pengajuan_bulan_ini' => \App\Models\PengajuanSurat::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)->count(),
        ];

        // Calculate additional useful metrics
        $stats['user_growth_percentage'] = $this->calculateGrowthPercentage('users');
        $stats['berita_growth_percentage'] = $this->calculateGrowthPercentage('berita');
        $stats['pengajuan_growth_percentage'] = $this->calculateGrowthPercentage('pengajuan_surat');

        // Get latest demografi data for dashboard
        $demografi = \App\Models\Demografi::getActive();

        // Get latest visi misi
        $visiMisi = \App\Models\VisiMisi::getActive();

        // Get BUMDes data for dashboard
        $bumdes = \App\Models\Bumdes::getActive();

        // Get PKK data for dashboard
        $pkk = \App\Models\Pkk::getActive();

        // Get Posyandu data for dashboard
        $posyandu = \App\Models\Posyandu::getCompleteData();

        // Get latest messages for dashboard
        $latestMessages = \App\Models\KontakMessage::latest()->limit(5)->get();

        // Get kontak info
        $kontakInfo = \App\Models\Kontak::getActive();

        // Get latest pengajuan surat for dashboard
        $latestPengajuanSurat = \App\Models\PengajuanSurat::with([])
            ->latest()
            ->limit(5)
            ->get();

        // Get pengajuan surat statistics by jenis
        $pengajuanByJenis = \App\Models\PengajuanSurat::selectRaw('jenis_surat, COUNT(*) as total')
            ->groupBy('jenis_surat')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                $jenisSuratOptions = \App\Models\PengajuanSurat::getJenisSuratOptions();
                return [
                    'jenis' => $jenisSuratOptions[$item->jenis_surat] ?? $item->jenis_surat,
                    'total' => $item->total
                ];
            });

        // Get pengajuan surat trend (last 7 days)
        $pengajuanTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = \App\Models\PengajuanSurat::whereDate('created_at', $date)->count();
            $pengajuanTrend[] = [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('d/m'),
                'count' => $count
            ];
        }

        // Get latest PKK kegiatan for dashboard
        $latestPkkKegiatan = \App\Models\PkkKegiatan::active()->latest()->limit(3)->get();

        // Get latest Posyandu kegiatan for dashboard
        $latestPosyanduKegiatan = \App\Models\PosyanduKegiatan::active()
            ->upcoming()
            ->with('posyandu')
            ->latest()
            ->limit(3)
            ->get();

        // Get latest berita for dashboard
        $latestBerita = \App\Models\Berita::with(['kategori', 'author'])
            ->latest()
            ->limit(5)
            ->get();

        // Get berita statistics by category
        $beritaByKategori = \App\Models\KategoriBerita::withCount([
            'beritas' => function ($query) {
                $query->where('status', 'published');
            }
        ])
            ->active()
            ->orderBy('beritas_count', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($kategori) {
                return [
                    'nama' => $kategori->nama,
                    'warna' => $kategori->warna,
                    'total' => $kategori->beritas_count
                ];
            });

        // Get berita trend (last 7 days)
        $beritaTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = \App\Models\Berita::where('status', 'published')
                ->whereDate('published_at', $date)
                ->count();
            $beritaTrend[] = [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('d/m'),
                'count' => $count
            ];
        }

        // Get alerts for admin attention
        $alerts = $this->getAdminAlerts($stats);

        // Get recent activities
        $recentActivities = $this->getRecentActivities();

        return view('admin.dashboard', compact(
            'stats',
            'demografi',
            'visiMisi',
            'bumdes',
            'pkk',
            'posyandu',
            'latestMessages',
            'kontakInfo',
            'latestPengajuanSurat',
            'pengajuanByJenis',
            'pengajuanTrend',
            'latestPkkKegiatan',
            'latestPosyanduKegiatan',
            'latestBerita',
            'beritaByKategori',
            'beritaTrend',
            'alerts',
            'recentActivities'
        ));
    }

    /**
     * Calculate growth percentage for the current month
     */
    private function calculateGrowthPercentage($model)
    {
        $currentMonth = 0;
        $previousMonth = 0;

        switch ($model) {
            case 'users':
                $currentMonth = User::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)->count();
                $previousMonth = User::whereMonth('created_at', now()->subMonth()->month)
                    ->whereYear('created_at', now()->subMonth()->year)->count();
                break;
            case 'berita':
                $currentMonth = \App\Models\Berita::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)->count();
                $previousMonth = \App\Models\Berita::whereMonth('created_at', now()->subMonth()->month)
                    ->whereYear('created_at', now()->subMonth()->year)->count();
                break;
            case 'pengajuan_surat':
                $currentMonth = \App\Models\PengajuanSurat::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)->count();
                $previousMonth = \App\Models\PengajuanSurat::whereMonth('created_at', now()->subMonth()->month)
                    ->whereYear('created_at', now()->subMonth()->year)->count();
                break;
        }

        if ($previousMonth == 0) return $currentMonth > 0 ? 100 : 0;

        return round((($currentMonth - $previousMonth) / $previousMonth) * 100, 1);
    }

    /**
     * Get alerts that need admin attention
     */
    private function getAdminAlerts($stats)
    {
        $alerts = [];

        if ($stats['unread_messages'] > 0) {
            $alerts[] = [
                'type' => 'warning',
                'icon' => 'mail',
                'title' => 'Pesan Belum Dibaca',
                'message' => "Ada {$stats['unread_messages']} pesan yang belum dibaca",
                'action' => route('admin.kontak.messages.index'),
                'action_text' => 'Lihat Pesan'
            ];
        }

        if ($stats['pengajuan_pending'] > 0) {
            $alerts[] = [
                'type' => 'info',
                'icon' => 'document',
                'title' => 'Pengajuan Surat Pending',
                'message' => "Ada {$stats['pengajuan_pending']} pengajuan surat yang menunggu diproses",
                'action' => route('admin.pengajuan-surat.index'),
                'action_text' => 'Proses Sekarang'
            ];
        }

        if ($stats['berita_draft'] > 5) {
            $alerts[] = [
                'type' => 'warning',
                'icon' => 'document-text',
                'title' => 'Banyak Draft Berita',
                'message' => "Ada {$stats['berita_draft']} draft berita yang belum dipublikasi",
                'action' => route('admin.berita.index'),
                'action_text' => 'Kelola Berita'
            ];
        }

        return $alerts;
    }

    /**
     * Get recent activities
     */
    private function getRecentActivities()
    {
        $activities = [];

        // Latest published news
        $latestNews = \App\Models\Berita::published()->latest()->first();
        if ($latestNews) {
            $activities[] = [
                'type' => 'success',
                'icon' => 'newspaper',
                'title' => 'Berita Baru Dipublikasi',
                'description' => $latestNews->judul,
                'time' => $latestNews->published_at->diffForHumans(),
                'user' => $latestNews->author->name ?? 'System'
            ];
        }

        // Latest pengajuan surat
        $latestPengajuan = \App\Models\PengajuanSurat::latest()->first();
        if ($latestPengajuan) {
            $activities[] = [
                'type' => 'info',
                'icon' => 'document',
                'title' => 'Pengajuan Surat Baru',
                'description' => "Pengajuan " . ($latestPengajuan->jenis_surat ?? 'surat'),
                'time' => $latestPengajuan->created_at->diffForHumans(),
                'user' => $latestPengajuan->nama_pemohon ?? 'Unknown'
            ];
        }

        // Latest message
        $latestMessage = \App\Models\KontakMessage::latest()->first();
        if ($latestMessage) {
            $activities[] = [
                'type' => 'warning',
                'icon' => 'mail',
                'title' => 'Pesan Baru Masuk',
                'description' => Str::limit($latestMessage->subject ?? 'Tanpa subjek', 50),
                'time' => $latestMessage->created_at->diffForHumans(),
                'user' => $latestMessage->name ?? 'Unknown'
            ];
        }

        // System activities
        $activities[] = [
            'type' => 'success',
            'icon' => 'login',
            'title' => 'Admin Login',
            'description' => auth()->user()->name . ' berhasil login',
            'time' => 'Baru saja',
            'user' => auth()->user()->name
        ];

        return collect($activities)->take(5);
    }
}
