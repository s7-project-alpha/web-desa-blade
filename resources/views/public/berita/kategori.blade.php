{{-- resources/views/public/berita/kategori.blade.php --}}
@extends('public.layouts.app')

@section('title', 'Berita ' . $kategori->nama . ' - Desa Tanjung Selamat')
@section('description', 'Kumpulan berita dan informasi seputar ' . strtolower($kategori->nama) . ' di Desa Tanjung Selamat')

@section('content')
<!-- Category Header -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <!-- Category Icon & Title -->
            <div class="flex items-center justify-center mb-6">
                <div class="w-20 h-20 rounded-2xl flex items-center justify-center mr-6" style="background-color: {{ $kategori->warna }};">
                    @if($kategori->icon)
                        <i class="{{ $kategori->icon }} text-3xl text-white"></i>
                    @else
                        <div class="w-10 h-10 rounded-full bg-white"></div>
                    @endif
                </div>
                <div class="text-left">
                    <h1 class="text-4xl font-bold mb-2">{{ $kategori->nama }}</h1>
                    @if($kategori->deskripsi)
                        <p class="text-xl text-blue-100">{{ $kategori->deskripsi }}</p>
                    @endif
                </div>
            </div>

            <!-- Breadcrumb -->
            <nav class="flex justify-center mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('public.home') }}" class="inline-flex items-center text-sm font-medium text-blue-200 hover:text-white">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-9 9a1 1 0 001.414 1.414L2 12.414V15a3 3 0 003 3h6a3 3 0 003-3v-2.586l.293.293a1 1 0 001.414-1.414l-9-9z"></path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('public.berita') }}" class="ml-1 text-sm font-medium text-blue-200 hover:text-white md:ml-2">Berita</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-blue-100 md:ml-2">{{ $kategori->nama }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Search Form -->
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('public.berita.search') }}" method="GET" class="flex">
                    <input type="hidden" name="kategori" value="{{ $kategori->slug }}">
                    <input type="text"
                           name="q"
                           value="{{ request('q') }}"
                           placeholder="Cari berita {{ strtolower($kategori->nama) }}..."
                           class="flex-1 px-6 py-4 rounded-l-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <button type="submit"
                            class="px-8 py-4 bg-blue-700 hover:bg-blue-800 rounded-r-xl transition-colors duration-200">
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
            <!-- Category Navigation -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Kategori Lainnya</h3>
                <div class="space-y-2">
                    <a href="{{ route('public.berita') }}"
                       class="flex items-center justify-between p-3 rounded-lg transition-colors duration-200 text-gray-600 hover:bg-gray-50">
                        <span>Semua Berita</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    @foreach($kategoris as $kat)
                        <a href="{{ route('public.berita.kategori', $kat->slug) }}"
                           class="flex items-center justify-between p-3 rounded-lg transition-colors duration-200 {{ $kat->slug === $kategori->slug ? 'text-white font-medium' : 'text-gray-600 hover:bg-gray-50' }}"
                           @if($kat->slug === $kategori->slug) style="background-color: {{ $kat->warna }};" @endif>
                            <span class="flex items-center">
                                @if($kat->icon)
                                    <i class="{{ $kat->icon }} text-sm mr-3"></i>
                                @else
                                    <div class="w-3 h-3 rounded-full mr-3" style="background-color: {{ $kat->warna }};"></div>
                                @endif
                                {{ $kat->nama }}
                            </span>
                            <span class="text-sm {{ $kat->slug === $kategori->slug ? 'bg-white bg-opacity-20 text-white' : 'bg-gray-100 text-gray-600' }} px-2 py-1 rounded-full">
                                {{ $kat->berita_count }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Filter by Type -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Jenis</h3>
                <div class="space-y-2">
                    <a href="{{ route('public.berita.kategori', $kategori->slug) }}"
                       class="flex items-center justify-between p-3 rounded-lg transition-colors duration-200 {{ !request('jenis') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                        <span>Semua</span>
                    </a>
                    <a href="{{ route('public.berita.kategori', [$kategori->slug, 'jenis' => 'berita']) }}"
                       class="flex items-center justify-between p-3 rounded-lg transition-colors duration-200 {{ request('jenis') === 'berita' ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                        <span>Berita</span>
                    </a>
                    <a href="{{ route('public.berita.kategori', [$kategori->slug, 'jenis' => 'pengumuman']) }}"
                       class="flex items-center justify-between p-3 rounded-lg transition-colors duration-200 {{ request('jenis') === 'pengumuman' ? 'bg-orange-50 text-orange-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                        <span>Pengumuman</span>
                    </a>
                </div>
            </div>

            <!-- Latest News -->
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
            <!-- Category Statistics -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold" style="color: {{ $kategori->warna }};">{{ $beritas->total() }}</div>
                        <div class="text-sm text-gray-500">Total Artikel</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-600">{{ $beritas->where('jenis', 'berita')->count() }}</div>
                        <div class="text-sm text-gray-500">Berita</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-orange-600">{{ $beritas->where('jenis', 'pengumuman')->count() }}</div>
                        <div class="text-sm text-gray-500">Pengumuman</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600">{{ $beritas->sum('views') }}</div>
                        <div class="text-sm text-gray-500">Total Views</div>
                    </div>
                </div>
            </div>

            <!-- Articles List -->
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        @if(request('jenis') === 'berita')
                            Berita {{ $kategori->nama }}
                        @elseif(request('jenis') === 'pengumuman')
                            Pengumuman {{ $kategori->nama }}
                        @else
                            Semua Artikel {{ $kategori->nama }}
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
                                                📢 Pengumuman
                                            </span>
                                        @endif
                                        @if($berita->is_featured)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                ⭐ Utama
                                            </span>
                                        @endif
                                        @if($berita->is_urgent)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                🚨 Penting
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
                            {{ $beritas->appends(request()->query())->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="w-24 h-24 mx-auto mb-6 rounded-2xl flex items-center justify-center" style="background-color: {{ $kategori->warna }}20;">
                            @if($kategori->icon)
                                <i class="{{ $kategori->icon }} text-4xl" style="color: {{ $kategori->warna }};"></i>
                            @else
                                <div class="w-12 h-12 rounded-full" style="background-color: {{ $kategori->warna }};"></div>
                            @endif
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada artikel</h3>
                        <p class="text-gray-500 mb-6">
                            Belum ada {{ request('jenis') ? request('jenis') : 'artikel' }} yang dipublikasikan untuk kategori {{ $kategori->nama }}
                        </p>
                        <div class="space-y-4">
                            <a href="{{ route('public.berita.kategori', $kategori->slug) }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Lihat Semua Artikel
                            </a>
                        </div>
                    </div>
                @endif
            </section>
        </div>
    </div>
</div>
@endsection
