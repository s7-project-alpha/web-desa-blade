{{-- resources/views/public/posyandu.blade.php --}}
@extends('public.layouts.app')

@section('title', 'Posyandu - Desa Tanjung Selamat')
@section('description', 'Informasi lengkap tentang Posyandu Desa Tanjung Selamat - lokasi, jadwal, layanan, dan kegiatan posyandu')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-red-500 to-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-6">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Posyandu Desa Tanjung Selamat</h1>
            <p class="text-xl text-red-100 max-w-3xl mx-auto">
                Pos Pelayanan Terpadu - Memberikan layanan kesehatan dasar untuk ibu, bayi, dan balita secara terpadu dan berkelanjutan
            </p>
        </div>
    </div>
</div>

<!-- Overview Statistics -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Posyandu Desa Tanjung Selamat</h2>
            <p class="text-lg text-gray-600">Sehat Bersama Posyandu</p>
            <p class="text-gray-500 mt-2">Memantau tumbuh kembang buah hati tercinta</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Total Balita -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 text-center border border-blue-200">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-500 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-medium text-blue-600 mb-2">Total Balita Terdaftar</h3>
                <p class="text-3xl font-bold text-blue-700">{{ $posyanduData['overview']['total_balita'] }}</p>
                <p class="text-sm text-blue-500 mt-1">+5%</p>
            </div>

            <!-- Balita Gizi Baik -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 text-center border border-green-200">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-500 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-medium text-green-600 mb-2">Balita Gizi Baik</h3>
                <p class="text-3xl font-bold text-green-700">{{ $posyanduData['overview']['balita_gizi_baik'] }}</p>
                <p class="text-sm text-green-500 mt-1">+3%</p>
            </div>

            <!-- Cakupan Imunisasi -->
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-8 text-center border border-purple-200">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-500 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm2.5 6a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45-1.5a1.5 1.5 0 003 0 1.5 1.5 0 00-3 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-medium text-purple-600 mb-2">Cakupan Imunisasi</h3>
                <p class="text-3xl font-bold text-purple-700">{{ $posyanduData['overview']['cakupan_imunisasi'] }}%</p>
                <p class="text-sm text-purple-500 mt-1">+2%</p>
            </div>

            <!-- Ibu Hamil Aktif -->
            <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-2xl p-8 text-center border border-pink-200">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-pink-500 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-medium text-pink-600 mb-2">Ibu Hamil Aktif</h3>
                <p class="text-3xl font-bold text-pink-700">{{ $posyanduData['overview']['ibu_hamil_aktif'] }}</p>
                <p class="text-sm text-pink-500 mt-1">+1</p>
            </div>
        </div>
    </div>
</div>

<!-- Lokasi Posyandu -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Lokasi Posyandu</h2>
            <p class="text-lg text-gray-600">Posyandu yang tersedia di Desa Tanjung Selamat</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posyanduData['posyandu_list'] as $posyandu)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="bg-gradient-to-r from-red-500 to-red-600 p-6 text-white">
                    <h3 class="text-xl font-bold mb-2">{{ $posyandu['nama'] }}</h3>
                    <p class="text-red-100">{{ $posyandu['dusun'] }} {{ $posyandu['rt_rw'] }}</p>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $posyandu['jadwal'] }}</p>
                                <p class="text-sm text-gray-600">{{ $posyandu['jam'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $posyandu['penanggung_jawab'] }}</p>
                                <p class="text-sm text-gray-600">{{ $posyandu['telepon'] }}</p>
                            </div>
                        </div>

                        <div class="border-t pt-4">
                            <p class="text-sm font-medium text-gray-900 mb-2">Layanan:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($posyandu['layanan'] as $layanan)
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">{{ $layanan }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-3 text-center">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold text-gray-900">{{ $posyandu['anggota_aktif'] }}</span> anggota aktif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Layanan Posyandu -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Layanan Posyandu</h2>
            <p class="text-lg text-gray-600">Berbagai layanan kesehatan yang tersedia</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($posyanduData['layanan'] as $layanan)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 text-center hover:shadow-xl transition-shadow duration-300">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $layanan['nama'] }}</h3>
                <p class="text-sm text-gray-600 mb-3">{{ $layanan['deskripsi'] }}</p>
                <div class="space-y-2">
                    <div class="flex items-center justify-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $layanan['jadwal'] }}
                    </div>
                    <div class="flex items-center justify-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $layanan['target_usia'] }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Tenaga Kesehatan -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Tenaga Kesehatan</h2>
            <p class="text-lg text-gray-600">Tim tenaga kesehatan profesional</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posyanduData['tenaga_kesehatan'] as $tenaga)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="p-6 text-center">
                    <img class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-red-100"
                         src="{{ $tenaga['foto'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($tenaga['nama']) . '&background=DC2626&color=fff&size=200' }}"
                         alt="{{ $tenaga['nama'] }}">
                    <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $tenaga['nama_lengkap'] }}</h3>
                    <p class="text-red-600 font-medium mb-2">{{ $tenaga['jabatan'] }}</p>
                    <div class="space-y-2 text-sm text-gray-600">
                        <div class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $tenaga['spesialisasi'] }}
                        </div>
                        <div class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            Pengalaman {{ $tenaga['pengalaman'] }}
                        </div>
                        @if($tenaga['telepon'])
                        <div class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                            {{ $tenaga['telepon'] }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Jadwal Kegiatan Mendatang -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Jadwal Kegiatan Mendatang</h2>
            <p class="text-lg text-gray-600">Kegiatan posyandu yang akan datang</p>
        </div>

        @if(count($posyanduData['kegiatan_mendatang']) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posyanduData['kegiatan_mendatang'] as $kegiatan)
            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-6 border border-red-200">
                <div class="text-center mb-4">
                    <h3 class="text-lg font-bold text-red-800 mb-1">{{ $kegiatan['tanggal'] }}</h3>
                    <p class="text-red-600 font-medium">{{ $kegiatan['posyandu'] }}</p>
                    <p class="text-sm text-red-500">{{ $kegiatan['jam'] }}</p>
                </div>

                <div class="space-y-2">
                    <h4 class="font-medium text-gray-900 text-center">{{ $kegiatan['nama_kegiatan'] }}</h4>
                    @if(count($kegiatan['agenda']) > 0)
                    <ul class="text-sm text-gray-700 space-y-1">
                        @foreach($kegiatan['agenda'] as $agenda)
                        <li class="flex items-start">
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                            {{ $agenda }}
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
            </svg>
            <p class="text-gray-500">Belum ada kegiatan yang terjadwal</p>
        </div>
        @endif
    </div>
</div>

<!-- Call to Action -->
<div class="bg-gradient-to-r from-red-500 to-red-600 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Ayo Bergabung dengan Posyandu</h2>
        <p class="text-xl text-red-100 mb-8 max-w-3xl mx-auto">
            Mari bersama-sama menjaga kesehatan ibu, bayi, dan balita di Desa Tanjung Selamat.
            Kesehatan keluarga adalah investasi terbaik untuk masa depan.
        </p>
        <a href="{{ route('public.kontak') }}" class="inline-flex items-center px-8 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-red-600 transition-colors duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            Hubungi Kami
        </a>
    </div>
</div>
@endsection
