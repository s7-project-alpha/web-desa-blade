{{-- resources/views/public/berita/detail.blade.php --}}
@extends('public.layouts.app')

@section('title', $berita->judul . ' - Desa Tanjung Selamat')
@section('description', $berita->ringkasan)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('public.home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-9 9a1 1 0 001.414 1.414L2 12.414V15a3 3 0 003 3h6a3 3 0 003-3v-2.586l.293.293a1 1 0 001.414-1.414l-9-9z"></path>
                    </svg>
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('public.berita') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Berita</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($berita->judul, 50) }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="lg:grid lg:grid-cols-4 lg:gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-3">
            <article class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Article Header -->
                <div class="p-8">
                    <!-- Meta Info -->
                    <div class="flex items-center space-x-4 mb-6">
                        @if($berita->jenis === 'pengumuman')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                📢 Pengumuman
                            </span>
                        @endif
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium"
                              style="background-color: {{ $berita->kategori->warna }}20; color: {{ $berita->kategori->warna }};">
                            {{ $berita->kategori->nama }}
                        </span>
                        @if($berita->is_featured)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                ⭐ Berita Utama
                            </span>
                        @endif
                        @if($berita->is_urgent)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                🚨 Penting
                            </span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">{{ $berita->judul }}</h1>

                    <!-- Article Info -->
                    <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600 mb-8 pb-8 border-b border-gray-200">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            <span>oleh <strong>{{ $berita->author_name }}</strong></span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $berita->formatted_date }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $berita->views }} views</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $berita->reading_time }}</span>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-8">
                        <p class="text-lg text-gray-800 leading-relaxed">{{ $berita->ringkasan }}</p>
                    </div>
                </div>

                <!-- Featured Image -->
                @if($berita->gambar_utama)
                    <div class="px-8 mb-8">
                        <img src="{{ $berita->getGambarUtamaUrl() }}"
                             alt="{{ $berita->judul }}"
                             class="w-full h-96 object-cover rounded-xl shadow-lg">
                    </div>
                @endif

                <!-- Article Content -->
                <div class="px-8 pb-8">
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($berita->konten)) !!}
                    </div>

                    <!-- Tags -->
                    @if($berita->tags && count($berita->tags) > 0)
                        <div class="mt-12 pt-8 border-t border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700 mb-4">Tags:</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($berita->tags as $tag)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                                        #{{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Source -->
                    @if($berita->sumber)
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <p class="text-sm text-gray-600">
                                <strong>Sumber:</strong> {{ $berita->sumber }}
                            </p>
                        </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-medium text-gray-700 mb-4">Bagikan:</h3>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($berita->judul) }}"
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                                Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . request()->fullUrl()) }}"
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                                WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Related Articles -->
            @if($beritaTerkait->count() > 0)
                <section class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8">Berita Terkait</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($beritaTerkait as $terkait)
                            <article class="bg-white rounded-xl shadow-md overflow-hidden group hover:shadow-lg transition-shadow duration-200">
                                <img src="{{ $terkait->getGambarUtamaUrl() }}"
                                     alt="{{ $terkait->judul }}"
                                     class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-200">
                                <div class="p-6">
                                    <div class="flex items-center space-x-2 mb-3">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium"
                                              style="background-color: {{ $terkait->kategori->warna }}20; color: {{ $terkait->kategori->warna }};">
                                            {{ $terkait->kategori->nama }}
                                        </span>
                                        <span class="text-xs text-gray-500">{{ $terkait->formatted_date }}</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-200">
                                        <a href="{{ route('public.berita.detail', $terkait->slug) }}">
                                            {{ $terkait->judul }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $terkait->ringkasan }}</p>
                                    <a href="{{ route('public.berita.detail', $terkait->slug) }}"
                                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                                        Baca Selengkapnya
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 mt-12 lg:mt-0">
            <!-- Latest News -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Berita Terbaru</h3>
                <div class="space-y-6">
                    @foreach($beritaTerbaru as $item)
                        <article class="flex space-x-3">
                            <img src="{{ $item->getGambarUtamaUrl() }}"
                                 alt="{{ $item->judul }}"
                                 class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-gray-900 line-clamp-2 mb-2">
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

            <!-- Popular News -->
            @if($beritaPopuler->count() > 0)
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Berita Populer</h3>
                    <div class="space-y-4">
                        @foreach($beritaPopuler as $index => $populer)
                            <article class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-bold">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">
                                        <a href="{{ route('public.berita.detail', $populer->slug) }}" class="hover:text-blue-600">
                                            {{ $populer->judul }}
                                        </a>
                                    </h4>
                                    <div class="flex items-center text-xs text-gray-500 space-x-2">
                                        <span>{{ $populer->views }} views</span>
                                        <span>•</span>
                                        <span>{{ $populer->formatted_date }}</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
