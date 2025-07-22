{{-- resources/views/public/berita/index.blade.php --}}
@extends('public.layouts.app')

@section('title', 'Berita & Pengumuman - Desa Tanjung Selamat')
@section('description', 'Informasi terkini seputar kegiatan, pembangunan, dan pengumuman penting Desa Tanjung Selamat')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-emerald-500 to-90% via-sky-500 via-30% to-indigo-500 from-10% text-white py-16">
    <div class="min-h-[196px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-4">Berita & Pengumuman</h1>
            <p class="text-xl text-blue-100 mb-8">Informasi terkini seputar kegiatan, pembangunan, dan pengumuman penting Desa Tanjung Selamat</p>

            <!-- Search Form -->
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('public.berita.search') }}" method="GET" class="flex">
                    <input type="text"
                           name="q"
                           value="{{ request('q') }}"
                           placeholder="Cari berita atau pengumuman..."
                           class="flex-1 px-6 py-4 rounded-l-xl border-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <button type="submit"
                            class="px-8 py-4 bg-gray-300 hover:bg-gray-600 rounded-r-xl transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
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
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
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
            <div class="bg-white rounded-xl shadow-md p-6">
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
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
@endsection
