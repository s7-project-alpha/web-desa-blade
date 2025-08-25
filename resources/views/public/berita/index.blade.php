{{-- resources/views/public/berita/index.blade.php --}}
@extends('public.layouts.app')

@section('title', 'Berita & Pengumuman - Desa Tanjung Selamat')
@section('description', 'Informasi terkini seputar kegiatan, pembangunan, dan pengumuman penting Desa Tanjung Selamat')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-tr from-cyan-300 to-teal-600 text-white py-16">
    <div class="min-h-[196px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-4 animate-fadeInDown">Berita & Pengumuman</h1>
            <p class="text-xl text-blue-100 mb-8 animate-fadeInUp">Informasi terkini seputar kegiatan, pembangunan, dan pengumuman penting Desa Tanjung Selamat</p>

            <!-- Search Form -->
            <div class="max-w-2xl mx-auto animate-fadeIn">
                <form action="{{ route('public.berita.search') }}" method="GET" class="flex">
                    <input type="text"
                           name="q"
                           value="{{ request('q') }}"
                           placeholder="Cari berita atau pengumuman..."
                           class="flex-1 px-6 py-4 rounded-l-xl border-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300">
                   <button type="submit"
                    class="px-5 py-3 bg-teal-400 text-white rounded-r-xl shadow-md hover:bg-teal-600 focus:ring-2 focus:ring-teal-400 transition-all duration-300 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                </form>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="lg:grid lg:grid-cols-4 lg:gap-8">

        <!-- Sidebar -->
        <div class="lg:col-span-1 mb-8 lg:mb-0">
            <!-- Categories Filter -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6 animate-slideInLeft">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Kategori</h3>
                <div class="space-y-2">
                    <a href="{{ route('public.berita') }}"
                       class="flex items-center justify-between p-3 rounded-lg transition-colors duration-200 {{ !request('kategori') && !request('jenis') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                        <span>Semua</span>
                        <span class="text-sm bg-gray-100 text-gray-600 px-2 py-1 rounded-full">{{ $statistik['total'] }}</span>
                    </a>

                    <a href="{{ route('public.berita', ['jenis' => 'pengumuman']) }}"
                       class="flex items-center justify-between p-3 rounded-lg transition-colors duration-200 {{ request('jenis') === 'pengumuman' ? 'bg-orange-50 text-orange-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                        <span>Pengumuman</span>
                        <span class="text-sm bg-gray-100 text-gray-600 px-2 py-1 rounded-full">{{ $statistik['pengumuman'] }}</span>
                    </a>

                    @foreach($kategoris as $kategori)
                        <a href="{{ route('public.berita.kategori', $kategori->slug) }}"
                           class="flex items-center justify-between p-3 rounded-lg transition-colors duration-200 {{ request('kategori') === $kategori->slug ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="flex items-center">
                                <div class="w-3 h-3 rounded-full mr-3" style="background-color: {{ $kategori->warna }};"></div>
                                {{ $kategori->nama }}
                            </span>
                            <span class="text-sm bg-gray-100 text-gray-600 px-2 py-1 rounded-full">{{ $kategori->berita_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Latest News Sidebar -->
            <div class="bg-white rounded-xl shadow-md p-6  animate-slideInLeft">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Berita Terbaru</h3>
                <div class="space-y-4">
                    @foreach($beritaTerbaru as $item)
                        <article class="flex space-x-3">
                            <img src="{{ $item->getGambarUtamaUrl() }}"
                                 alt="{{ $item->judul }}"
                                 class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">
                                    <a href="{{ route('public.berita.detail', $item->slug) }}" class="hover:text-blue-600">
                                        {{ $item->judul }}
                                    </a>
                                </h4>
                                <p class="text-xs text-gray-500">{{ $item->formatted_date }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <!-- Featured News -->
            @if($beritaUtama->count() > 0 && !request()->has('search'))
                <section class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Berita Utama</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        @foreach($beritaUtama as $utama)
                            <article class="bg-white rounded-xl shadow-md overflow-hidden group hover:shadow-lg transition-shadow duration-200">
                                <div class="aspect-w-16 aspect-h-9">
                                    <img src="{{ $utama->getGambarUtamaUrl() }}"
                                         alt="{{ $utama->judul }}"
                                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-200">
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center space-x-2 mb-3">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium"
                                              style="background-color: {{ $utama->kategori->warna }}20; color: {{ $utama->kategori->warna }};">
                                            {{ $utama->kategori->nama }}
                                        </span>
                                        <span class="text-xs text-gray-500">{{ $utama->formatted_date }}</span>
                                        <span class="text-xs text-gray-400">•</span>
                                        <span class="text-xs text-gray-500">{{ $utama->views }} views</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-200">
                                        <a href="{{ route('public.berita.detail', $utama->slug) }}">
                                            {{ $utama->judul }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $utama->ringkasan }}</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-500">oleh {{ $utama->author_name }}</span>
                                        <a href="{{ route('public.berita.detail', $utama->slug) }}"
                                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                                            Baca Selengkapnya
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- All News -->
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        @if(request()->has('search'))
                            Hasil Pencarian
                        @elseif(request()->has('kategori'))
                            Berita {{ $kategoris->where('slug', request('kategori'))->first()->nama ?? '' }}
                        @elseif(request('jenis') === 'pengumuman')
                            Pengumuman Terbaru
                        @else
                            Berita Terbaru
                        @endif
                    </h2>
                    <span class="text-sm text-gray-500">{{ $beritas->total() }} artikel ditemukan</span>
                </div>

                @if($beritas->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 animate-fadeInUp">
                        @foreach($beritas as $berita)
                            <article class="bg-white rounded-xl shadow-md overflow-hidden group hover:shadow-lg transition-shadow duration-200">
                                <div class="aspect-w-16 aspect-h-9">
                                    <img src="{{ $berita->getGambarUtamaUrl() }}"
                                         alt="{{ $berita->judul }}"
                                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-200">
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center space-x-2 mb-3">
                                        @if($berita->jenis === 'pengumuman')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                Pengumuman
                                            </span>
                                        @endif
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium"
                                              style="background-color: {{ $berita->kategori->warna }}20; color: {{ $berita->kategori->warna }};">
                                            {{ $berita->kategori->nama }}
                                        </span>
                                        @if($berita->is_urgent)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Penting
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-200">
                                        <a href="{{ route('public.berita.detail', $berita->slug) }}">
                                            {{ $berita->judul }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $berita->ringkasan }}</p>
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center space-x-4">
                                            <span>{{ $berita->formatted_date }}</span>
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $berita->views }}
                                            </span>
                                        </div>
                                        <a href="{{ route('public.berita.detail', $berita->slug) }}"
                                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                            Baca
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($beritas->hasPages())
                        <div class="mt-12 flex justify-center">
                            {{ $beritas->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada berita ditemukan</h3>
                        <p class="text-gray-500 mb-6">
                            @if(request()->has('search'))
                                Coba ubah kata kunci pencarian Anda
                            @else
                                Belum ada berita yang dipublikasikan untuk kategori ini
                            @endif
                        </p>
                        <a href="{{ route('public.berita') }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Lihat Semua Berita
                        </a>
                    </div>
                @endif
            </section>
        </div>
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

    .animate-bounce {
        animation: bounce 1s infinite;
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

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-15px);
        }
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
