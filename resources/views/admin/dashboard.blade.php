@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
            <p class="text-gray-600">Selamat datang, {{ Auth::user()->name }}! Kelola sistem desa dengan mudah.</p>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500">{{ now()->isoFormat('dddd, DD MMMM YYYY') }}</p>
            <p class="text-xs text-gray-400">{{ now()->format('H:i') }} WIB</p>
        </div>
    </div>
</div>

<!-- Alerts Section -->
@if(count($alerts) > 0)
<div class="mb-6">
    @foreach($alerts as $alert)
    <div class="mb-3 bg-{{ $alert['type'] == 'warning' ? 'yellow' : ($alert['type'] == 'info' ? 'blue' : 'red') }}-50 border-l-4 border-{{ $alert['type'] == 'warning' ? 'yellow' : ($alert['type'] == 'info' ? 'blue' : 'red') }}-400 p-4 rounded-r-lg">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-{{ $alert['type'] == 'warning' ? 'yellow' : ($alert['type'] == 'info' ? 'blue' : 'red') }}-400" fill="currentColor" viewBox="0 0 20 20">
                        @if($alert['icon'] == 'mail')
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        @elseif($alert['icon'] == 'document')
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                        @else
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        @endif
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-{{ $alert['type'] == 'warning' ? 'yellow' : ($alert['type'] == 'info' ? 'blue' : 'red') }}-800">
                        {{ $alert['title'] }}
                    </h3>
                    <p class="text-sm text-{{ $alert['type'] == 'warning' ? 'yellow' : ($alert['type'] == 'info' ? 'blue' : 'red') }}-700">
                        {{ $alert['message'] }}
                    </p>
                </div>
            </div>
            <a href="{{ $alert['action'] }}" class="text-sm font-medium text-{{ $alert['type'] == 'warning' ? 'yellow' : ($alert['type'] == 'info' ? 'blue' : 'red') }}-600 hover:text-{{ $alert['type'] == 'warning' ? 'yellow' : ($alert['type'] == 'info' ? 'blue' : 'red') }}-500">
                {{ $alert['action_text'] }} →
            </a>
        </div>
    </div>
    @endforeach
</div>
@endif

<!-- Quick Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Users Overview -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm">Total Pengguna</p>
                <p class="text-2xl font-bold">{{ number_format($stats['total_users']) }}</p>
                <p class="text-blue-100 text-xs mt-1">
                    @if($stats['user_growth_percentage'] > 0)
                        ↗ +{{ $stats['user_growth_percentage'] }}% bulan ini
                    @elseif($stats['user_growth_percentage'] < 0)
                        ↘ {{ $stats['user_growth_percentage'] }}% bulan ini
                    @else
                        → Tidak ada perubahan
                    @endif
                </p>
            </div>
            <div class="bg-blue-400 bg-opacity-30 rounded-full p-3">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Content Overview -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm">Berita Publikasi</p>
                <p class="text-2xl font-bold">{{ number_format($stats['berita_published']) }}</p>
                <p class="text-green-100 text-xs mt-1">
                    {{ number_format($stats['berita_views_total']) }} total views
                </p>
            </div>
            <div class="bg-green-400 bg-opacity-30 rounded-full p-3">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Services Overview -->
    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-sm">Pengajuan Surat</p>
                <p class="text-2xl font-bold">{{ number_format($stats['total_pengajuan_surat']) }}</p>
                <p class="text-purple-100 text-xs mt-1">
                    {{ $stats['pengajuan_pending'] }} menunggu proses
                </p>
            </div>
            <div class="bg-purple-400 bg-opacity-30 rounded-full p-3">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Messages Overview -->
    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-yellow-100 text-sm">Pesan Masuk</p>
                <p class="text-2xl font-bold">{{ number_format($stats['total_kontak_messages']) }}</p>
                <p class="text-yellow-100 text-xs mt-1">
                    {{ $stats['unread_messages'] }} belum dibaca
                </p>
            </div>
            <div class="bg-yellow-400 bg-opacity-30 rounded-full p-3">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Demografi Stats -->
@if($demografi)
<div class="mb-8">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">
        Data Demografi Desa ({{ $demografi->tahun }})
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Penduduk</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($demografi->total_penduduk) }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Kepala Keluarga</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($demografi->total_kepala_keluarga) }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Luas Wilayah</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $demografi->luas_wilayah }} KM²</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Kepadatan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $demografi->kepadatan_penduduk }}/KM²</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Module Overview Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- BUMDes Overview -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">BUMDes</h3>
            <div class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                {{ $stats['bumdes_active'] }} Aktif
            </div>
        </div>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Unit Usaha</span>
                <span class="text-sm font-medium">{{ $stats['unit_usaha_count'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Tim Manajemen</span>
                <span class="text-sm font-medium">{{ $stats['tim_manajemen_count'] }}</span>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.bumdes.index') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                Kelola BUMDes →
            </a>
        </div>
    </div>

    <!-- PKK Overview -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">PKK</h3>
            <div class="bg-pink-100 text-pink-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                {{ $stats['pkk_kegiatan_mendatang'] }} Kegiatan
            </div>
        </div>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Program Kerja</span>
                <span class="text-sm font-medium">{{ $stats['pkk_program_kerja'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Pengurus Aktif</span>
                <span class="text-sm font-medium">{{ $stats['pkk_pengurus'] }}</span>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.pkk.index') }}" class="text-pink-600 hover:text-pink-500 text-sm font-medium">
                Kelola PKK →
            </a>
        </div>
    </div>

    <!-- Posyandu Overview -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Posyandu</h3>
            <div class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                {{ $stats['posyandu_active'] }} Aktif
            </div>
        </div>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Total Balita</span>
                <span class="text-sm font-medium">{{ $stats['total_balita_posyandu'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Ibu Hamil</span>
                <span class="text-sm font-medium">{{ $stats['total_ibu_hamil'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Cakupan Imunisasi</span>
                <span class="text-sm font-medium">{{ $stats['avg_cakupan_imunisasi'] }}%</span>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.posyandu.index') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                Kelola Posyandu →
            </a>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Latest Content -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Konten Terbaru</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($latestBerita->take(3) as $berita)
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">
                            {{ $berita->judul }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $berita->kategori->nama ?? 'Umum' }} • {{ $berita->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-sm">Belum ada berita terbaru</p>
                @endforelse
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.berita.index') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                    Lihat Semua Berita →
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($recentActivities as $activity)
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-{{ $activity['type'] == 'success' ? 'green' : ($activity['type'] == 'warning' ? 'yellow' : 'blue') }}-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-{{ $activity['type'] == 'success' ? 'green' : ($activity['type'] == 'warning' ? 'yellow' : 'blue') }}-600" fill="currentColor" viewBox="0 0 20 20">
                                @if($activity['icon'] == 'newspaper')
                                <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                                @elseif($activity['icon'] == 'document')
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                @elseif($activity['icon'] == 'mail')
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                @else
                                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3z" clip-rule="evenodd"></path>
                                @endif
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">{{ $activity['title'] }}</p>
                        <p class="text-sm text-gray-500 truncate">{{ $activity['description'] }}</p>
                        <p class="text-xs text-gray-400">{{ $activity['user'] }} • {{ $activity['time'] }}</p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-sm">Belum ada aktivitas terbaru</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions & System Info -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('admin.berita.create') }}" class="flex items-center p-3 text-sm font-medium text-gray-700 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                <svg class="w-5 h-5 text-blue-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                Tambah Berita
            </a>
            <a href="{{ route('admin.galeri.create') }}" class="flex items-center p-3 text-sm font-medium text-gray-700 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                </svg>
                Upload Galeri
            </a>
            <a href="{{ route('admin.perangkat-desa.index') }}" class="flex items-center p-3 text-sm font-medium text-gray-700 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                <svg class="w-5 h-5 text-purple-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
                Kelola Perangkat
            </a>
            <a href="{{ route('admin.demografi.index') }}" class="flex items-center p-3 text-sm font-medium text-gray-700 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                <svg class="w-5 h-5 text-yellow-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" clip-rule="evenodd"></path>
                </svg>
                Update Demografi
            </a>
        </div>
    </div>

    <!-- System Information -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Sistem</h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Versi Laravel</span>
                <span class="text-sm font-medium text-gray-900 bg-gray-100 px-2 py-1 rounded">{{ app()->version() }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Versi PHP</span>
                <span class="text-sm font-medium text-gray-900 bg-gray-100 px-2 py-1 rounded">{{ PHP_VERSION }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Login Terakhir</span>
                <span class="text-sm font-medium text-gray-900">{{ Auth::user()->updated_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Status Server</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1.5"></span>
                    Online
                </span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Storage Usage</span>
                <span class="text-sm font-medium text-gray-900">
                    <div class="w-20 bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Pengajuan Surat Status -->
@if($stats['total_pengajuan_surat'] > 0)
<div class="bg-white rounded-lg shadow mb-8">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Status Pengajuan Surat</h3>
            <a href="{{ route('admin.pengajuan-surat.index') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                Lihat Semua →
            </a>
        </div>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div class="text-center">
                <div class="text-2xl font-bold text-yellow-600">{{ $stats['pengajuan_pending'] }}</div>
                <div class="text-sm text-gray-600">Pending</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $stats['pengajuan_diproses'] }}</div>
                <div class="text-sm text-gray-600">Diproses</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600">{{ $stats['pengajuan_selesai'] }}</div>
                <div class="text-sm text-gray-600">Selesai</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-red-600">{{ $stats['pengajuan_ditolak'] }}</div>
                <div class="text-sm text-gray-600">Ditolak</div>
            </div>
        </div>

        @if(count($latestPengajuanSurat) > 0)
        <div class="mt-6 pt-6 border-t border-gray-200">
            <h4 class="text-sm font-medium text-gray-900 mb-3">Pengajuan Terbaru</h4>
            <div class="space-y-3">
                @foreach($latestPengajuanSurat->take(3) as $pengajuan)
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $pengajuan->nama_pemohon }}</p>
                        <p class="text-xs text-gray-500">{{ $pengajuan->jenis_surat ?? 'Surat' }} • {{ $pengajuan->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $pengajuan->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                           ($pengajuan->status == 'diproses' ? 'bg-blue-100 text-blue-800' :
                            ($pengajuan->status == 'selesai' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                        {{ ucfirst($pengajuan->status) }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endif

@push('scripts')
<script>
    // Add any JavaScript for dashboard interactivity
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-refresh dashboard every 5 minutes
        setTimeout(function() {
            window.location.reload();
        }, 300000);
    });
</script>
@endpush

@endsection
