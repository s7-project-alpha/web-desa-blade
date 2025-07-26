@extends('public.layouts.app')

@section('title', 'Posyandu - Desa Tanjung Selamat')
@section('description', 'Informasi lengkap tentang Posyandu Desa Tanjung Selamat - lokasi, jadwal, layanan, dan kegiatan posyandu')

@section('content')
<!-- Header Section dengan animasi -->
<div class="relative bg-cover bg-center text-white py-14 animate-fadeIn" style="background-image: url('{{ asset('images/posyandu.png') }}')">
    <div class="absolute inset-0 bg-black opacity-70"></div>
    <div class="relative min-h-[212px] mx-auto px-4 sm:px-6 lg:px-10">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-6 animate-popIn">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h1 class="text-5xl md:text-5xl font-bold mb-4 animate-fadeInDown">Posyandu Desa Tanjung Selamat</h1>
            <p class="text-xl text-red-100 max-w-3xl mx-auto animate-fadeInUp delay-100">
                Pos Pelayanan Terpadu - Memberikan layanan kesehatan dasar untuk ibu, bayi, dan balita secara terpadu dan berkelanjutan
            </p>
        </div>
    </div>
</div>

<!-- Overview Statistics dengan animasi counter -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Posyandu Desa Tanjung Selamat</h2>
            <p class="text-lg text-gray-600 animate-slideInUp delay-100">Sehat Bersama Posyandu</p>
            <p class="text-gray-500 mt-2 animate-fadeIn delay-200">Memantau tumbuh kembang buah hati tercinta</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Total Balita -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 text-center border border-blue-200  hover-scale" style="animation-delay: 100ms">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-500 rounded-full mb-4  delay-150">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-medium text-blue-600 mb-2 animate-fadeIn delay-200">Total Balita Terdaftar</h3>
                <p class="text-3xl font-bold text-blue-700 counter" data-target="{{ $posyanduData['overview']['total_balita'] }}" data-prefix="" data-suffix="">0</p>
                <p class="text-sm text-blue-500 mt-1 animate-fadeIn delay-300">+5%</p>
            </div>

            <!-- Balita Gizi Baik -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 text-center border border-green-200  hover-scale" style="animation-delay: 200ms">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-500 rounded-full mb-4  delay-250">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-medium text-green-600 mb-2 animate-fadeIn delay-250">Balita Gizi Baik</h3>
                <p class="text-3xl font-bold text-green-700 counter" data-target="{{ $posyanduData['overview']['balita_gizi_baik'] }}" data-prefix="" data-suffix="">0</p>
                <p class="text-sm text-green-500 mt-1 animate-fadeIn delay-350">+3%</p>
            </div>

            <!-- Cakupan Imunisasi -->
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-8 text-center border border-purple-200  hover-scale" style="animation-delay: 300ms">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-500 rounded-full mb-4  delay-350">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm2.5 6a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45-1.5a1.5 1.5 0 003 0 1.5 1.5 0 00-3 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-medium text-purple-600 mb-2 animate-fadeIn delay-350">Cakupan Imunisasi</h3>
                <p class="text-3xl font-bold text-purple-700 counter" data-target="{{ str_replace('%', '', $posyanduData['overview']['cakupan_imunisasi']) }}" data-prefix="" data-suffix="%">0</p>
                <p class="text-sm text-purple-500 mt-1 animate-fadeIn delay-450">+2%</p>
            </div>

            <!-- Ibu Hamil Aktif -->
            <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-2xl p-8 text-center border border-pink-200  hover-scale" style="animation-delay: 400ms">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-pink-500 rounded-full mb-4  delay-450">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-medium text-pink-600 mb-2 animate-fadeIn delay-450">Ibu Hamil Aktif</h3>
                <p class="text-3xl font-bold text-pink-700 counter" data-target="{{ $posyanduData['overview']['ibu_hamil_aktif'] }}" data-prefix="" data-suffix="">0</p>
                <p class="text-sm text-pink-500 mt-1 animate-fadeIn delay-550">+1</p>
            </div>
        </div>
    </div>
</div>

<!-- Lokasi Posyandu dengan animasi -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Lokasi Posyandu</h2>
            <p class="text-lg text-gray-600 animate-slideInUp delay-100">Posyandu yang tersedia di Desa Tanjung Selamat</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posyanduData['posyandu_list'] as $index => $posyandu)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow duration-300 animate-slideInUp hover-scale" style="animation-delay: {{ $index * 100 }}ms">
                <div class="bg-gradient-to-r from-red-500 to-red-600 p-6 text-white">
                    <h3 class="text-xl font-bold mb-2">{{ $posyandu['nama'] }}</h3>
                    <p class="text-red-100">{{ $posyandu['dusun'] }} {{ $posyandu['rt_rw'] }}</p>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start animate-fadeIn delay-150">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $posyandu['jadwal'] }}</p>
                                <p class="text-sm text-gray-600">{{ $posyandu['jam'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-start animate-fadeIn delay-200">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $posyandu['penanggung_jawab'] }}</p>
                                <p class="text-sm text-gray-600">{{ $posyandu['telepon'] }}</p>
                            </div>
                        </div>

                        <div class="border-t pt-4 animate-fadeIn delay-250">
                            <p class="text-sm font-medium text-gray-900 mb-2">Layanan:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($posyandu['layanan'] as $layanan)
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">{{ $layanan }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-3 text-center animate-fadeIn delay-300">
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

<!-- Layanan Posyandu dengan animasi -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Layanan Posyandu</h2>
            <p class="text-lg text-gray-600 animate-slideInUp delay-100">Berbagai layanan kesehatan yang tersedia</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($posyanduData['layanan'] as $index => $layanan)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 text-center hover:shadow-xl transition-shadow duration-300 animate-popIn hover-scale" style="animation-delay: {{ $index * 100 }}ms">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4 animate-popIn">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2 animate-fadeIn delay-150">{{ $layanan['nama'] }}</h3>
                <p class="text-sm text-gray-600 mb-3 animate-fadeIn delay-200">{{ $layanan['deskripsi'] }}</p>
                <div class="space-y-2 animate-fadeIn delay-250">
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

<!-- Tenaga Kesehatan dengan animasi -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Tenaga Kesehatan</h2>
            <p class="text-lg text-gray-600 animate-slideInUp delay-100">Tim tenaga kesehatan profesional</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posyanduData['tenaga_kesehatan'] as $index => $tenaga)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 animate-popIn hover-scale" style="animation-delay: {{ $index * 100 }}ms">
                <div class="p-6 text-center">
                    <img class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-red-100 transition-transform duration-300"
                         src="{{ $tenaga['foto'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($tenaga['nama']) . '&background=DC2626&color=fff&size=200' }}"
                         alt="{{ $tenaga['nama'] }}">
                    <h3 class="text-xl font-bold text-gray-900 mb-1 animate-fadeIn delay-150">{{ $tenaga['nama_lengkap'] }}</h3>
                    <p class="text-red-600 font-medium mb-2 animate-fadeIn delay-200">{{ $tenaga['jabatan'] }}</p>
                    <div class="space-y-2 text-sm text-gray-600 animate-fadeIn delay-250">
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

<!-- Jadwal Kegiatan Mendatang dengan animasi -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Jadwal Kegiatan Mendatang</h2>
            <p class="text-lg text-gray-600 animate-slideInUp delay-100">Kegiatan posyandu yang akan datang</p>
        </div>

        @if(count($posyanduData['kegiatan_mendatang']) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posyanduData['kegiatan_mendatang'] as $index => $kegiatan)
            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-6 border border-red-200 animate-slideInUp hover-scale" style="animation-delay: {{ $index * 100 }}ms">
                <div class="text-center mb-4 animate-fadeIn delay-150">
                    <h3 class="text-lg font-bold text-red-800 mb-1">{{ $kegiatan['tanggal'] }}</h3>
                    <p class="text-red-600 font-medium">{{ $kegiatan['posyandu'] }}</p>
                    <p class="text-sm text-red-500">{{ $kegiatan['jam'] }}</p>
                </div>

                <div class="space-y-2 animate-fadeIn delay-200">
                    <h4 class="font-medium text-gray-900 text-center">{{ $kegiatan['nama_kegiatan'] }}</h4>
                    @if(count($kegiatan['agenda']) > 0)
                    <ul class="text-sm text-gray-700 space-y-1">
                        @foreach($kegiatan['agenda'] as $aIndex => $agenda)
                        <li class="flex items-start animate-fadeIn" style="animation-delay: {{ $aIndex * 50 + 250 }}ms">
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
        <div class="text-center py-12 animate-fadeIn">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
            </svg>
            <p class="text-gray-500">Belum ada kegiatan yang terjadwal</p>
        </div>
        @endif
    </div>
</div>

<!-- Call to Action dengan animasi -->
<div class="bg-gradient-to-r from-emerald-500 to-90% via-sky-500 via-30% to-indigo-500 text-white py-14 animated-gradient">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4 animate-fadeInDown">Ayo Bergabung dengan Posyandu</h2>
        <p class="text-xl text-red-100 mb-8 max-w-3xl mx-auto animate-fadeInDown delay-100">
            Mari bersama-sama menjaga kesehatan ibu, bayi, dan balita di Desa Tanjung Selamat.
            Kesehatan keluarga adalah investasi terbaik untuk masa depan.
        </p>
        <a href="{{ route('public.kontak') }}" class="inline-flex items-center px-8 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-blue-600 transition-colors duration-300 animate-fadeInDown delay-200 hover-scale">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            Hubungi Kami
        </a>
    </div>
</div>

<!-- Custom CSS for Animations -->
<style>
    /* Animations - hanya aktif ketika memiliki kelas 'animated' */
    .animate-fadeInDown {
        opacity: 0;
        transform: translateY(-20px);
    }

    .animate-fadeInUp {
        opacity: 0;
        transform: translateY(20px);
    }

    .animate-fadeIn {
        opacity: 0;
    }

    .animate-slideInLeft {
        opacity: 0;
        transform: translateX(-50px);
    }

    .animate-slideInRight {
        opacity: 0;
        transform: translateX(50px);
    }

    .animate-slideInUp {
        opacity: 0;
        transform: translateY(50px);
    }

    .animate-popIn {
        opacity: 0;
        transform: scale(0.8);
    }

    /* Animasi saat elemen muncul */
    .animate-fadeInDown.animated {
        animation: fadeInDown 0.8s ease-out forwards;
    }

    .animate-fadeInUp.animated {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-fadeIn.animated {
        animation: fadeIn 1s ease-out forwards;
    }

    .animate-slideInLeft.animated {
        animation: slideInLeft 0.8s ease-out forwards;
    }

    .animate-slideInRight.animated {
        animation: slideInRight 0.8s ease-out forwards;
    }

    .animate-slideInUp.animated {
        animation: slideInUp 0.8s ease-out forwards;
    }

    .animate-popIn.animated {
        animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    /* Efek hover scale */
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-scale:hover {
        transform: scale(1.03);
    }

    /* Animasi gradient background */
    .animated-gradient {
        background-size: 200% 200%;
        animation: gradientBG 8s ease infinite;
    }

    /* Keyframes untuk animasi */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes popIn {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        70% {
            opacity: 1;
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Animation Delays */
    .delay-50 { animation-delay: 50ms !important; }
    .delay-100 { animation-delay: 100ms !important; }
    .delay-150 { animation-delay: 150ms !important; }
    .delay-200 { animation-delay: 200ms !important; }
    .delay-250 { animation-delay: 250ms !important; }
    .delay-300 { animation-delay: 300ms !important; }
    .delay-350 { animation-delay: 350ms !important; }
    .delay-400 { animation-delay: 400ms !important; }
    .delay-450 { animation-delay: 450ms !important; }
    .delay-550 { animation-delay: 550ms !important; }
</style>

<!-- JavaScript for Scroll Trigger Animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk animasi counter
    function animateCounters() {
        const counters = document.querySelectorAll('.counter');
        const speed = 200; // Durasi animasi dalam ms
        const options = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = +entry.target.getAttribute('data-target');
                    const prefix = entry.target.getAttribute('data-prefix') || '';
                    const suffix = entry.target.getAttribute('data-suffix') || '';
                    const count = entry.target;
                    const increment = target / speed;

                    let current = 0;

                    const updateCounter = () => {
                        current += increment;
                        if (current < target) {
                            count.textContent = prefix + Math.floor(current).toLocaleString('id-ID') + suffix;
                            setTimeout(updateCounter, 1);
                        } else {
                            count.textContent = prefix + target.toLocaleString('id-ID') + suffix;
                        }
                    };

                    updateCounter();
                    observer.unobserve(entry.target);
                }
            });
        }, options);

        counters.forEach(counter => {
            observer.observe(counter);
        });
    }

    // Fungsi untuk mengatur animasi saat scroll
    function setupScrollAnimations() {
        // Ambil semua elemen yang memiliki kelas animasi
        const animatedElements = document.querySelectorAll(
            '[class*="animate-"]'
        );

        // Buat Intersection Observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Tambahkan kelas 'animated' untuk memicu animasi
                    const element = entry.target;

                    // Handle delay inline style
                    let delay = element.style.animationDelay || '0ms';
                    delay = parseInt(delay) || 0;

                    setTimeout(() => {
                        element.classList.add('animated');

                        // Jika elemen adalah counter, jalankan animasi counter
                        if (element.classList.contains('counter')) {
                            animateCounters();
                        }
                    }, delay);

                    // Stop observing setelah animasi dipicu
                    observer.unobserve(element);
                }
            });
        }, {
            threshold: 0.1, // Trigger ketika 10% elemen terlihat
            rootMargin: '0px 0px -50px 0px' // Adjust untuk trigger lebih awal
        });

        // Observe semua elemen animasi
        animatedElements.forEach(el => {
            observer.observe(el);
        });
    }

    // Panggil fungsi setup
    setupScrollAnimations();
    animateCounters();
});
</script>

@endsection
