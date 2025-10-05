@extends('public.layouts.app')

@section('title', 'Beranda - Desa Tanjung Selamat')
@section('description', 'Website resmi Desa Tanjung Selamat - Informasi lengkap tentang profil desa, berita terkini, dan layanan masyarakat')

@section('content')
<!-- Hero Section -->
<section class="relative bg-cover bg-center text-white" style="background-image: url('{{ asset('images/kantor.jpg') }}')">
    <div class="absolute inset-0 bg-black opacity-70"></div>
    <div class="relative min-h-[500px] flex flex-col items-center justify-center text-center px-4 sm:px-4 lg:px-8">
        <div class="text-center animate-fadeInDown">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Selamat Datang di<br>
                <span class="text-yellow-300">Desa Tanjung Selamat</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-100 animate-fadeInUp delay-100">
                Desa yang sejahtera, maju, dan berbudaya
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fadeInUp delay-200">
                <a href="{{ route('public.visi-misi') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-200">
                    Profil Desa
                </a>
                <a href="{{ route('public.berita') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-200">
                    Berita Terkini
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 animate-fadeIn">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Data Desa</h2>
            <p class="text-lg text-gray-600">Statistik terkini Desa Tanjung Selamat</p>
        </div>

        @php
            $demografi = \App\Models\Demografi::getActive();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Total Penduduk -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2 counter" data-target="{{ $demografi ? $demografi->total_penduduk : 2580 }}">0</h3>
                <p class="text-gray-600">Total Penduduk</p>
            </div>

            <!-- Kepala Keluarga -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center delay-100">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2 counter" data-target="{{ $demografi ? $demografi->total_kepala_keluarga : 745 }}">0</h3>
                <p class="text-gray-600">Kepala Keluarga</p>
            </div>

            <!-- Luas Wilayah -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center delay-200">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                    <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2 counter" data-target="{{ $demografi ? $demografi->luas_wilayah : 12.5 }}" data-decimal="2">0</h3>
                <p class="text-gray-600">Luas (KM²)</p>
            </div>

            <!-- Jumlah Dusun -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center delay-300">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                    <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2 counter" data-target="{{ $demografi ? $demografi->jumlah_dusun : 8 }}">0</h3>
                <p class="text-gray-600">Dusun</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 animate-fadeIn">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Layanan Desa</h2>
            <p class="text-lg text-gray-600">Berbagai layanan untuk memudahkan masyarakat</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 hover:shadow-lg transition duration-200 animate-slideInLeft">
                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4 animate-bounce">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Administrasi Kependudukan</h3>
                <p class="text-gray-600">Pelayanan KTP, KK, Akta Kelahiran, dan dokumen kependudukan lainnya</p>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6 hover:shadow-lg transition duration-200 animate-slideInUp delay-100">
                <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mb-4 animate-bounce">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Surat Keterangan</h3>
                <p class="text-gray-600">Surat keterangan domisili, usaha, tidak mampu, dan berbagai surat lainnya</p>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-6 hover:shadow-lg transition duration-200 animate-slideInRight delay-200">
                <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mb-4 animate-bounce">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Pelayanan Kesehatan</h3>
                <p class="text-gray-600">Posyandu, Puskesdes, dan program kesehatan masyarakat</p>
            </div>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12 animate-fadeIn">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Berita Terkini</h2>
                <p class="text-lg text-gray-600">Informasi dan pengumuman terbaru dari desa</p>
            </div>
            <a href="{{ route('public.berita') }}" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center">
                Lihat Semua
                <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>

        @if($beritaTerbaru && $beritaTerbaru->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($beritaTerbaru as $index => $berita)
                    <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-200 animate-popIn {{ $index > 0 ? 'delay-' . ($index * 100) : '' }}">
                        <div class="h-48 overflow-hidden">
                            @if($berita->gambar_utama)
                                <img src="{{ $berita->getGambarUtamaUrl() }}"
                                    alt="{{ $berita->judul }}"
                                    class="w-full h-full object-cover hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $berita->published_at ? $berita->published_at->format('d M Y') : $berita->created_at->format('d M Y') }}
                                </div>
                                @if($berita->kategori)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white"
                                          style="background-color: {{ $berita->kategori->warna ?? '#3B82F6' }}">
                                        @if($berita->kategori->icon)
                                            <i class="{{ $berita->kategori->icon }} mr-1"></i>
                                        @endif
                                        {{ $berita->kategori->nama }}
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-xl font-semibold text-gray-900 mb-3 hover:text-blue-600 transition duration-200 line-clamp-2">
                                <a href="{{ route('public.berita.detail', $berita->slug) }}">
                                    {{ $berita->judul }}
                                </a>
                            </h3>

                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ $berita->ringkasan ?: \Str::limit(strip_tags($berita->konten), 120) }}
                            </p>

                            <div class="flex items-center justify-between">
                                <a href="{{ route('public.berita.detail', $berita->slug) }}"
                                   class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                    Baca selengkapnya
                                    <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>

                                @if($berita->views > 0)
                                    <div class="flex items-center text-gray-400 text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ number_format($berita->views) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <!-- No News Available -->
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                        <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Berita</h3>
                <p class="text-gray-600 mb-6">
                    Berita terbaru akan ditampilkan di sini ketika sudah tersedia.
                </p>
                <a href="{{ route('public.berita') }}"
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-200">
                    Lihat Semua Berita
                </a>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-blue-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-fadeIn">
        <h2 class="text-3xl font-bold text-white mb-4">
            Butuh Informasi Lebih Lanjut?
        </h2>
        <p class="text-xl text-blue-100 mb-8">
            Hubungi kantor desa atau kunjungi langsung untuk mendapat pelayanan terbaik
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fadeInUp delay-100">
            <a href="{{ route('public.kontak') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-200">
                Hubungi Kami
            </a>
            <a href="{{ route('public.perangkat-desa') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-200">
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
    .delay-100 { animation-delay: 0.1s; }
    .delay-150 { animation-delay: 0.15s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-600 { animation-delay: 0.6s; }
    .delay-900 { animation-delay: 0.9s; }
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

                    // Handle delay classes
                    let delay = 0;
                    if (element.classList.contains('delay-100')) delay = 100;
                    if (element.classList.contains('delay-150')) delay = 150;
                    if (element.classList.contains('delay-200')) delay = 200;
                    if (element.classList.contains('delay-300')) delay = 300;
                    if (element.classList.contains('delay-600')) delay = 600;
                    if (element.classList.contains('delay-900')) delay = 900;

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

    // Panggil fungsi animasi counter
    animateCounters();
});
</script>
@endsection
