@extends('public.layouts.app')

@section('title', 'Data Demografi - Desa Tanjung Selamat')
@section('description', 'Data kependudukan dan demografi Desa Tanjung Selamat yang meliputi jumlah penduduk, distribusi usia, pendidikan, dan mata pencaharian')

@section('content')
<!-- Hero Section -->
<section class="relative bg-cover bg-center text-white py-20" style="background-image: url('{{ asset('images/demografi.png') }}')">
    <div class="absolute inset-0 bg-black opacity-70"></div>
    <div class="relative min-h-[164px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center animate-fadeInDown">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Data Demografi
            </h1>
            <p class="text-2xl text-green-100 mb-6 animate-fadeInUp delay-100">
                Desa Tanjung Selamat
            </p>
            @if($demografi)
                <div class="inline-flex items-center bg-green-500 bg-opacity-20 rounded-full px-4 py-2 text-xl animate-fadeInUp delay-200">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    Data Tahun {{ $demografi->tahun }}
                </div>
            @endif
        </div>
    </div>
</section>

@if($demografi)
<!-- Quick Statistics -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Statistik Utama</h2>
            <p class="text-lg text-gray-600 animate-slideInUp delay-100">Data kependudukan Desa Tanjung Selamat tahun {{ $demografi->tahun }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Total Penduduk -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2 counter" data-target="{{ $demografi->total_penduduk }}">0</h3>
                <p class="text-gray-600">Total Penduduk</p>
            </div>

            <!-- Kepala Keluarga -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center delay-100">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2 counter" data-target="{{ $demografi->total_kepala_keluarga }}">0</h3>
                <p class="text-gray-600">Kepala Keluarga</p>
            </div>

            <!-- Luas Wilayah -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center delay-200">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                    <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2 counter" data-target="{{ $demografi->luas_wilayah }}" data-decimal="2">0</h3>
                <p class="text-gray-600">Luas Wilayah (KM²)</p>
            </div>

            <!-- Kepadatan Penduduk -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center delay-300">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                    <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.62-1.62a4.017 4.017 0 001.731.085zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-1.106-1.106A6.002 6.002 0 004 10c0 .954.223 1.856.619 2.657l1.539-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.539a4.002 4.002 0 00-2.346.033L7.246 4.667z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2 counter" data-target="{{ $demografi->kepadatan_penduduk }}">0</h3>
                <p class="text-gray-600">Kepadatan/KM²</p>
            </div>
        </div>

        <!-- Additional Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Komposisi Gender -->
            <div class="bg-white rounded-lg shadow p-6 animate-slideInLeft">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">Komposisi Gender</h4>
                <div class="space-y-3">
                    <div class="flex justify-between items-center animate-fadeIn">
                        <span class="text-blue-600 flex items-center">
                            <span class="text-xl mr-2">♂</span> Laki-laki
                        </span>
                        <span class="font-medium">{{ number_format($demografi->total_laki_laki) }} ({{ $demografi->persentase_laki_laki }}%)</span>
                    </div>
                    <div class="flex justify-between items-center animate-fadeIn delay-100">
                        <span class="text-pink-600 flex items-center">
                            <span class="text-xl mr-2">♀</span> Perempuan
                        </span>
                        <span class="font-medium">{{ number_format($demografi->total_perempuan) }} ({{ $demografi->persentase_perempuan }}%)</span>
                    </div>
                    <div class="pt-2 border-t animate-fadeIn delay-200">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Rasio Jenis Kelamin</span>
                            <span class="font-medium">{{ $demografi->rasio_jenis_kelamin }}/100</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Wilayah -->
            <div class="bg-white rounded-lg shadow p-6 animate-slideInUp delay-100">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">Informasi Wilayah</h4>
                <div class="space-y-3">
                    <div class="flex justify-between items-center animate-fadeIn">
                        <span class="text-gray-600">Jumlah Dusun</span>
                        <span class="font-medium">{{ $demografi->jumlah_dusun }}</span>
                    </div>
                    <div class="flex justify-between items-center animate-fadeIn delay-50">
                        <span class="text-gray-600">Jumlah RW</span>
                        <span class="font-medium">{{ $demografi->jumlah_rw }}</span>
                    </div>
                    <div class="flex justify-between items-center animate-fadeIn delay-100">
                        <span class="text-gray-600">Jumlah RT</span>
                        <span class="font-medium">{{ $demografi->jumlah_rt }}</span>
                    </div>
                    <div class="pt-2 border-t animate-fadeIn delay-150">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Angka Harapan Hidup</span>
                            <span class="font-medium">{{ $demografi->angka_harapan_hidup }} tahun</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Keluarga -->
            <div class="bg-white rounded-lg shadow p-6 animate-slideInRight delay-200">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">Data Keluarga</h4>
                <div class="space-y-3">
                    <div class="flex justify-between items-center animate-fadeIn">
                        <span class="text-gray-600">Kepala Keluarga</span>
                        <span class="font-medium">{{ number_format($demografi->total_kepala_keluarga) }}</span>
                    </div>
                    <div class="flex justify-between items-center animate-fadeIn delay-100">
                        <span class="text-gray-600">Rata-rata/KK</span>
                        <span class="font-medium">{{ $demografi->rata_rata_anggota_kk }} jiwa</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Distribusi Usia -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 animate-fadeIn">
            <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Distribusi Usia</h2>
            <p class="text-lg text-gray-600 animate-slideInUp delay-100">Sebaran penduduk berdasarkan kelompok usia</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($demografi->distribusi_usia_label as $usia => $jumlah)
                @if($jumlah > 0)
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 border border-blue-200 animate-fadeIn" style="animation-delay: {{ $loop->index * 100 }}ms">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">{{ $usia }}</h4>
                                <p class="text-2xl font-bold text-blue-600 counter" data-target="{{ $jumlah }}">0</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center animate-pulse">
                                <span class="text-white font-bold text-sm">
                                    {{ round(($jumlah / $demografi->total_penduduk) * 100, 1) }}%
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

<!-- Tingkat Pendidikan -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 animate-fadeIn">
            <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Tingkat Pendidikan</h2>
            <p class="text-lg text-gray-600 animate-slideInUp delay-100">Sebaran penduduk berdasarkan tingkat pendidikan</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($demografi->tingkat_pendidikan_label as $pendidikan => $jumlah)
                @if($jumlah > 0)
                    <div class="bg-white rounded-lg shadow p-6 animate-slideInLeft" style="animation-delay: {{ $loop->index * 50 }}ms">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 animate-pulse">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-900">{{ $pendidikan }}</h4>
                                <div class="flex items-center justify-between mt-1">
                                    <span class="text-2xl font-bold text-gray-900 counter" data-target="{{ $jumlah }}">0</span>
                                    <span class="text-sm text-gray-500">
                                        {{ round(($jumlah / array_sum($demografi->tingkat_pendidikan)) * 100, 1) }}%
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

<!-- Mata Pencaharian -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 animate-fadeIn">
            <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Mata Pencaharian</h2>
            <p class="text-lg text-gray-600 animate-slideInUp delay-100">Sebaran penduduk berdasarkan mata pencaharian</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($demografi->mata_pencaharian_label as $pekerjaan => $jumlah)
                @if($jumlah > 0)
                    <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg p-6 border border-yellow-200 animate-fadeIn" style="animation-delay: {{ $loop->index * 50 }}ms">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mr-4 animate-pulse">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                    <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-900">{{ $pekerjaan }}</h4>
                                <div class="flex items-center justify-between mt-1">
                                    <span class="text-xl font-bold text-gray-900 counter" data-target="{{ $jumlah }}">0</span>
                                    <span class="text-sm text-gray-500">
                                        {{ round(($jumlah / array_sum($demografi->mata_pencaharian)) * 100, 1) }}%
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

@if($demografi->keterangan)
<!-- Keterangan -->
<section class="py-16 bg-blue-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 animate-fadeIn">
        <div class="bg-white rounded-lg shadow-lg p-8 animate-popIn">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Keterangan</h3>
            <p class="text-gray-700 leading-relaxed">{{ $demografi->keterangan }}</p>
        </div>
    </div>
</section>
@endif

@else
<!-- No Data Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-fadeIn">
        <div class="max-w-md mx-auto">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <h2 class="mt-6 text-2xl font-bold text-gray-900 animate-slideInUp">Data Demografi Belum Tersedia</h2>
            <p class="mt-2 text-gray-600 animate-slideInUp delay-100">Data kependudukan dan demografi desa sedang dalam proses pendataan. Silakan kunjungi halaman ini lagi di lain waktu.</p>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="bg-gradient-to-r from-emerald-500 to-90% via-sky-500 via-30% to-indigo-500 from-10% py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-fadeIn">
        <h2 class="text-3xl font-bold text-white mb-4 animate-slideInUp">
            Ingin Tahu Lebih Lanjut?
        </h2>
        <p class="text-xl text-green-100 mb-8 animate-slideInUp delay-100">
            Pelajari lebih lanjut tentang profil dan informasi lainnya dari Desa Tanjung Selamat
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-slideInUp delay-200">
            <a href="{{ route('public.visi-misi') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-50 transition duration-200">
                Visi & Misi
            </a>
            <a href="{{ route('public.perangkat-desa') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-green-600 transition duration-200">
                Perangkat Desa
            </a>
        </div>
    </div>
</section>

<!-- Custom CSS for Animations -->
<style>
    /* Animations - hanya aktif ketika memiliki kelas 'animated' */
    .animate-fadeInDown.animated {
        animation: fadeInDown 0.8s ease-out both;
    }

    .animate-fadeInUp.animated {
        animation: fadeInUp 0.8s ease-out both;
    }

    .animate-fadeIn.animated {
        animation: fadeIn 1s ease-out both;
    }

    .animate-slideInLeft.animated {
        animation: slideInLeft 0.8s ease-out both;
    }

    .animate-slideInRight.animated {
        animation: slideInRight 0.8s ease-out both;
    }

    .animate-slideInUp.animated {
        animation: slideInUp 0.8s ease-out both;
    }

    .animate-popIn.animated {
        animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
    }

    .animate-pulse.animated {
        animation: pulse 2s infinite;
    }

    .animate-bounce.animated {
        animation: bounce 1s infinite;
    }

    /* Tambahkan opacity: 0 ke elemen animasi sebelum dipicu */
    .animate-fadeInDown,
    .animate-fadeInUp,
    .animate-fadeIn,
    .animate-slideInLeft,
    .animate-slideInRight,
    .animate-slideInUp,
    .animate-popIn {
        opacity: 0;
    }

    /* Elemen yang sudah dianimasikan */
    .animated {
        opacity: 1;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
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
        }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    /* Animation Delays */
    .delay-50 { animation-delay: 50ms; }
    .delay-100 { animation-delay: 100ms; }
    .delay-150 { animation-delay: 150ms; }
    .delay-200 { animation-delay: 200ms; }
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
                    const decimalPlaces = entry.target.getAttribute('data-decimal') || 0;
                    const count = entry.target;
                    const increment = target / speed;

                    let current = 0;

                    const updateCounter = () => {
                        current += increment;
                        if (current < target) {
                            count.textContent = decimalPlaces > 0
                                ? current.toFixed(decimalPlaces)
                                : Math.floor(current).toLocaleString();
                            setTimeout(updateCounter, 1);
                        } else {
                            count.textContent = decimalPlaces > 0
                                ? target.toFixed(decimalPlaces)
                                : target.toLocaleString();
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
