@extends('public.layouts.app')

@section('title', 'Perangkat Desa - Desa Tanjung Selamat')
@section('description', 'Struktur organisasi dan perangkat desa Tanjung Selamat, kepala desa, sekretaris, bendahara, kepala dusun, dan BPD')

@section('content')
<!-- Header -->
<section class="bg-gradient-to-bl from-violet-500 to-fuchsia-500 text-white py-16">
    <div class="flex flex-col items-center justify-center min-h-[196px] mx-auto px-8 sm:px-6 lg:px-10">
        <div class="text-center max-w-3xl w-full">
            <h1 class="text-5xl md:text-5xl font-bold mb-4 animate-fadeInDown">Perangkat Desa</h1>
            <p class="text-2xl text-blue-100 animate-fadeInUp delay-100">Struktur Organisasi Pemerintahan Desa Tanjung Selamat</p>
        </div>
    </div>
</section>

@php
    $perangkatData = \App\Models\PerangkatDesa::getAllForPublic();
@endphp

<!-- Kepala Desa -->
@if($perangkatData['kepala_desa'])
    @php $kepala = $perangkatData['kepala_desa']; @endphp
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Kepala Desa</h2>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 shadow-lg animate-slideInUp delay-100">
                    <div class="flex flex-col lg:flex-row items-center lg:items-start space-y-6 lg:space-y-0 lg:space-x-8">
                        <div class="flex-shrink-0 animate-popIn">
                            <div class="w-48 h-48 rounded-full overflow-hidden bg-gray-200 shadow-lg hover-scale">
                                <img src="{{ $kepala->foto_url }}" alt="{{ $kepala->nama }}" class="w-full h-full object-cover transition-transform duration-300">
                            </div>
                        </div>

                        <div class="flex-1 text-center lg:text-left animate-fadeIn delay-200">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $kepala->nama }}</h3>
                            <p class="text-lg text-blue-600 font-semibold mb-2">{{ $kepala->jabatan }}</p>
                            @if($kepala->periode)
                                <p class="text-gray-600 mb-4">Periode: {{ $kepala->periode }}</p>
                            @endif

                            @if($kepala->pendidikan)
                                <div class="mb-4">
                                    <h4 class="font-semibold text-gray-900 mb-2">Pendidikan:</h4>
                                    <p class="text-gray-700 whitespace-pre-line">{{ $kepala->pendidikan }}</p>
                                </div>
                            @endif

                            @if($kepala->visi)
                                <div class="mb-4">
                                    <h4 class="font-semibold text-gray-900 mb-2">Visi:</h4>
                                    <p class="text-gray-700 italic whitespace-pre-line">{{ $kepala->visi }}</p>
                                </div>
                            @endif

                            <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start animate-fadeIn delay-300">
                                @if($kepala->telepon)
                                    <a href="tel:{{ $kepala->telepon }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 hover-scale">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                        </svg>
                                        {{ $kepala->telepon }}
                                    </a>
                                @endif

                                @if($kepala->email)
                                    <a href="mailto:{{ $kepala->email }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200 hover-scale">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                        </svg>
                                        {{ $kepala->email }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<!-- Perangkat Desa -->
@if($perangkatData['perangkat_desa']->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Perangkat Desa</h2>
                <p class="text-lg text-gray-600 animate-slideInUp delay-100">Tim kerja pemerintahan desa</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($perangkatData['perangkat_desa'] as $index => $perangkat)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-200 animate-popIn hover-scale" style="animation-delay: {{ $index * 100 }}ms">
                        <div class="p-6 text-center">
                            <div class="w-24 h-24 mx-auto rounded-full overflow-hidden bg-gray-200 mb-4 animate-popIn delay-150">
                                <img src="{{ $perangkat->foto_url }}" alt="{{ $perangkat->nama }}" class="w-full h-full object-cover transition-transform duration-300">
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $perangkat->nama }}</h3>
                            <p class="text-blue-600 font-semibold mb-4">{{ $perangkat->jabatan }}</p>

                            @if($perangkat->tugas_array)
                                <div class="mb-4 text-left animate-fadeIn delay-200">
                                    <h4 class="font-semibold text-gray-900 mb-2 text-center">Tugas & Tanggung Jawab:</h4>
                                    <ul class="text-sm text-gray-600 space-y-1">
                                        @foreach(array_slice($perangkat->tugas_array, 0, 3) as $tugas)
                                            @if(trim($tugas))
                                                <li class="flex items-start animate-fadeIn delay-{{ $loop->index * 50 + 300 }}">
                                                    <span class="w-1.5 h-1.5 bg-gray-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                                                    <span>{{ trim($tugas) }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="flex flex-col gap-2 animate-fadeIn delay-400">
                                @if($perangkat->telepon)
                                    <a href="tel:{{ $perangkat->telepon }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                        <i class="fas fa-phone mr-1"></i>{{ $perangkat->telepon }}
                                    </a>
                                @endif

                                @if($perangkat->email)
                                    <a href="mailto:{{ $perangkat->email }}" class="text-sm text-gray-600 hover:text-gray-800 break-all transition-colors duration-200">
                                        <i class="fas fa-envelope mr-1"></i>{{ $perangkat->email }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Kepala Dusun -->
@if($perangkatData['kepala_dusun']->count() > 0)
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Kepala Dusun</h2>
                <p class="text-lg text-gray-600 animate-slideInUp delay-100">Pemimpin di tingkat dusun</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($perangkatData['kepala_dusun'] as $index => $kepala)
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6 shadow-lg hover:shadow-xl transition duration-200 animate-slideInUp hover-scale" style="animation-delay: {{ $index * 100 }}ms">
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto rounded-full overflow-hidden bg-gray-200 mb-4 animate-popIn">
                                <img src="{{ $kepala->foto_url }}" alt="{{ $kepala->nama }}" class="w-full h-full object-cover transition-transform duration-300">
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $kepala->nama }}</h3>
                            @if($kepala->dusun)
                                <p class="text-green-600 font-semibold mb-2">{{ $kepala->dusun }}</p>
                            @endif
                            @if($kepala->rt_rw)
                                <p class="text-sm text-gray-600 mb-4">{{ $kepala->rt_rw }}</p>
                            @endif

                            @if($kepala->telepon)
                                <a href="tel:{{ $kepala->telepon }}" class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition duration-200 hover-scale">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                    </svg>
                                    {{ $kepala->telepon }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- BPD -->
@if($perangkatData['bpd']->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Badan Permusyawaratan Desa (BPD)</h2>
                <p class="text-lg text-gray-600 animate-slideInUp delay-100">Lembaga legislatif desa yang mengayomi adat istiadat</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($perangkatData['bpd'] as $index => $anggota)
                    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-200 animate-slideInUp hover-scale" style="animation-delay: {{ $index * 100 }}ms">
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto rounded-full overflow-hidden bg-gray-200 mb-4 animate-popIn">
                                <img src="{{ $anggota->foto_url }}" alt="{{ $anggota->nama }}" class="w-full h-full object-cover transition-transform duration-300">
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $anggota->nama }}</h3>
                            <p class="text-yellow-600 font-semibold mb-4">{{ $anggota->jabatan }}</p>

                            @if($anggota->telepon)
                                <a href="tel:{{ $anggota->telepon }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                    {{ $anggota->telepon }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Contact CTA -->
<section class="py-16 bg-gradient-to-r from-emerald-500 to-90% via-sky-500 via-30% to-indigo-500 from-10% animated-gradient">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4 animate-fadeInDown">
            Butuh Bantuan atau Informasi?
        </h2>
        <p class="text-xl text-blue-100 mb-8 animate-fadeInDown delay-100">
            Hubungi perangkat desa untuk mendapat pelayanan terbaik
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fadeInDown delay-200">
            <a href="{{ route('public.kontak') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-200 hover-scale">
                Kontak Kantor Desa
            </a>
            <a href="{{ route('public.home') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-200 hover-scale">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

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
    .delay-300 { animation-delay: 300ms !important; }
    .delay-400 { animation-delay: 400ms !important; }
</style>

<!-- JavaScript for Scroll Trigger Animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
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
});
</script>

@endsection
