@extends('public.layouts.app')

@section('title', 'Galeri Desa - Desa Tanjung Selamat')
@section('description', 'Koleksi foto kegiatan, wisata, pembangunan, dan budaya Desa Tanjung Selamat')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-emerald-500 to-90% via-sky-500 via-30% to-indigo-500 from-10% py-16">
    <div class="flex flex-col items-center justify-center min-h-[196px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl w-full">
            <h1 class="text-5xl font-bold mb-4 text-white">Galeri Desa Tanjung Selamat</h1>
            <p class="text-xl text-blue-100">Koleksi foto kegiatan, wisata, pembangunan, dan budaya Desa Tanjung Selamat</p>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('public.galeri.index') }}"
               class="px-6 py-2 rounded-full font-medium transition duration-200 {{ !request('kategori') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Semua
                <span class="ml-2 bg-white bg-opacity-20 px-2 py-1 rounded-full text-xs">{{ $totalGaleri }}</span>
            </a>
            @foreach($kategoris as $kategori)
                <a href="{{ route('public.galeri.index', ['kategori' => $kategori->slug]) }}"
                   class="px-6 py-2 rounded-full font-medium transition duration-200 {{ request('kategori') == $kategori->slug ? 'text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                   style="{{ request('kategori') == $kategori->slug ? 'background-color: ' . $kategori->warna_badge : '' }}">
                    {{ $kategori->nama_kategori }}
                    <span class="ml-2 bg-white bg-opacity-20 px-2 py-1 rounded-full text-xs">{{ $kategori->galeri_count }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Gallery Section -->
@if($galeriUnggulan->count() > 0 && !request('kategori'))
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Galeri Unggulan</h2>
            <p class="text-lg text-gray-600">Foto-foto pilihan terbaik dari berbagai kegiatan desa</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($galeriUnggulan as $item)
                <div class="group relative overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <a href="{{ route('public.galeri.detail', $item->slug) }}">
                        <div class="aspect-w-16 aspect-h-12">
                            <img src="{{ $item->foto_url }}"
                                 alt="{{ $item->alt_text }}"
                                 class="w-full h-64 object-cover group-hover:scale-105 transition duration-300">
                        </div>

                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>

                        <!-- Content -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-4 group-hover:translate-y-0 transition duration-300">
                            <!-- Category Badge -->
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-medium mb-2"
                                  style="background-color: {{ $item->kategori->warna_badge }}">
                                {{ $item->kategori->nama_kategori }}
                            </span>

                            <h3 class="text-lg font-semibold mb-2">{{ $item->judul }}</h3>

                            @if($item->deskripsi)
                                <p class="text-sm text-gray-200 opacity-0 group-hover:opacity-100 transition duration-300 line-clamp-2">
                                    {{ $item->deskripsi }}
                                </p>
                            @endif

                            <!-- Meta Info -->
                            <div class="flex items-center justify-between mt-3 text-xs text-gray-300 opacity-0 group-hover:opacity-100 transition duration-300">
                                <div class="flex items-center space-x-4">
                                    @if($item->photographer)
                                        <span class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $item->photographer }}
                                        </span>
                                    @endif
                                    <span class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $item->views_count }}
                                    </span>
                                </div>
                                <span>{{ $item->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Gallery Grid Section -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(request('kategori'))
            @php
                $currentKategori = $kategoris->firstWhere('slug', request('kategori'));
            @endphp
            @if($currentKategori)
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $currentKategori->nama_kategori }}</h2>
                    @if($currentKategori->deskripsi)
                        <p class="text-lg text-gray-600">{{ $currentKategori->deskripsi }}</p>
                    @endif
                </div>
            @endif
        @endif

        @if($galeri->count() > 0)
            <!-- Masonry Grid -->
            <div class="columns-1 md:columns-2 lg:columns-3 xl:columns-4 gap-6 space-y-6">
                @foreach($galeri as $item)
                    <div class="break-inside-avoid">
                        <div class="group relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                            <a href="{{ route('public.galeri.detail', $item->slug) }}">
                                <div class="relative">
                                    <img src="{{ $item->foto_url }}"
                                         alt="{{ $item->alt_text }}"
                                         class="w-full h-auto group-hover:scale-105 transition duration-300">

                                    <!-- Category Badge -->
                                    <div class="absolute top-3 left-3">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium text-white"
                                              style="background-color: {{ $item->kategori->warna_badge }}">
                                            {{ $item->kategori->nama_kategori }}
                                        </span>
                                    </div>

                                    <!-- Views -->
                                    <div class="absolute top-3 right-3">
                                        <span class="bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $item->views_count }}
                                        </span>
                                    </div>

                                    <!-- Hover Overlay -->
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition duration-300 flex items-center justify-center">
                                        <div class="transform scale-0 group-hover:scale-100 transition duration-300">
                                            <div class="bg-white rounded-full p-3">
                                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $item->judul }}</h3>

                                    @if($item->deskripsi)
                                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $item->deskripsi }}</p>
                                    @endif

                                    <!-- Meta Info -->
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <div class="flex items-center space-x-3">
                                            @if($item->photographer)
                                                <span class="flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ Str::limit($item->photographer, 10) }}
                                                </span>
                                            @endif
                                            @if($item->lokasi)
                                                <span class="flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ Str::limit($item->lokasi, 10) }}
                                                </span>
                                            @endif
                                        </div>
                                        <span>{{ $item->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $galeri->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada galeri</h3>
                <p class="mt-1 text-gray-500">
                    @if(request('kategori'))
                        Belum ada foto dalam kategori ini.
                    @else
                        Galeri akan segera diisi dengan foto-foto kegiatan desa.
                    @endif
                </p>
                @if(request('kategori'))
                    <div class="mt-6">
                        <a href="{{ route('public.galeri.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            ← Lihat semua galeri
                        </a>
                    </div>
                @endif
            </div>
        @endif
    </div>
</section>
@endsection
