@extends('public.layouts.app')

@section('title', $berita->meta_title ?: $berita->judul . ' - Desa Tanjung Selamat')
@section('description', $berita->meta_description ?: $berita->ringkasan)

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Breadcrumb -->
    <section class="bg-white border-b py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('public.home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('public.berita') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">
                                Berita
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 truncate">{{ Str::limit($berita->judul, 50) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <article class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Header -->
                    <div class="p-6 sm:p-8">
                        <!-- Category & Meta Info -->
                        <div class="flex flex-wrap items-center gap-4 mb-6">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium"
                                  style="background-color: {{ $berita->kategori->warna }}20; color: {{ $berita->kategori->warna }}">
                                {{ $berita->kategori->nama }}
                            </span>

                            @if($berita->is_utama)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800">
                                    BERITA UTAMA
                                </span>
                            @endif
                        </div>

                        <!-- Title -->
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                            {{ $berita->judul }}
                        </h1>

                        <!-- Meta Information -->
                        <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600 mb-8 pb-6 border-b border-gray-200">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $berita->penulis }}</span>
                            </div>

                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $berita->tanggal_publikasi->format('d F Y, H:i') }} WIB</span>
                            </div>

                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ number_format($berita->views) }} kali dibaca</span>
                            </div>

                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $berita->reading_time }}</span>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        @if($berita->gambar_utama)
                            <div class="mb-8">
                                <img src="{{ Storage::url($berita->gambar_utama) }}"
                                     alt="{{ $berita->judul }}"
                                     class="w-full h-96 object-cover rounded-lg shadow-lg">
                            </div>
                        @endif

                        <!-- Summary -->
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-8 rounded-r-lg">
                            <p class="text-lg text-gray-800 font-medium leading-relaxed">
                                {{ $berita->ringkasan }}
                            </p>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="px-6 sm:px-8 pb-8">
                        <div class="prose prose-lg max-w-none">
                            {!! nl2br($berita->konten) !!}
                        </div>

                        <!-- Tags -->
                        @if($berita->tags)
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <h4 class="text-sm font-medium text-gray-700 mb-3">Tags:</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($berita->tags as $tag)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-700">
                                            #{{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Share Buttons -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-700 mb-3">Bagikan:</h4>
                            <div class="flex gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                   target="_blank" rel="noopener"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                    Facebook
                                </a>

                                <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . request()->url()) }}"
                                   target="_blank" rel="noopener"
                                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                    </svg>
                                    WhatsApp
                                </a>

                                <button onclick="copyToClipboard()"
                                        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    Salin Link
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="space-y-6">
                    <!-- Berita Terkait -->
                    @if($beritaTerkait->count() > 0)
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Berita Terkait</h3>
                            <div class="space-y-4">
                                @foreach($beritaTerkait as $related)
                                    <article class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                                        <div class="flex space-x-3">
                                            @if($related->gambar_utama)
                                                <img src="{{ Storage::url($related->gambar_utama) }}"
                                                     alt="{{ $related->judul }}"
                                                     class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex-shrink-0 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            @endif

                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-medium text-gray-900 hover:text-blue-600 transition duration-200 line-clamp-2">
                                                    <a href="{{ route('public.berita.detail', $related->slug) }}">
                                                        {{ $related->judul }}
                                                    </a>
                                                </h4>
                                                <div class="mt-1 flex items-center text-xs text-gray-500">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ $related->formatted_date }}
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Berita Populer -->
                    @if($beritaPopuler->count() > 0)
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Berita Populer</h3>
                            <div class="space-y-4">
                                @foreach($beritaPopuler as $index => $popular)
                                    <article class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                                        <div class="flex space-x-3">
                                            <div class="flex-shrink-0">
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-600 text-white text-sm font-bold">
                                                    {{ $index + 1 }}
                                                </span>
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-medium text-gray-900 hover:text-blue-600 transition duration-200 line-clamp-2">
                                                    <a href="{{ route('public.berita.detail', $popular->slug) }}">
                                                        {{ $popular->judul }}
                                                    </a>
                                                </h4>
                                                <div class="mt-1 flex items-center text-xs text-gray-500">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ number_format($popular->views) }} views
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Back to List -->
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <a href="{{ route('public.berita') }}"
                           class="flex items-center justify-center w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Daftar Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Copy to clipboard script -->
<script>
function copyToClipboard() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = `
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            Tersalin!
        `;
        button.classList.remove('bg-gray-600', 'hover:bg-gray-700');
        button.classList.add('bg-green-600', 'hover:bg-green-700');

        setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('bg-green-600', 'hover:bg-green-700');
            button.classList.add('bg-gray-600', 'hover:bg-gray-700');
        }, 2000);
    });
}
</script>

@php
    // Increment views
    $berita->incrementViews();

    // Get related news
    $beritaTerkait = \App\Models\Berita::where('kategori_berita_id', $berita->kategori_berita_id)
                                      ->where('id', '!=', $berita->id)
                                      ->where('is_published', true)
                                      ->orderBy('tanggal_publikasi', 'desc')
                                      ->limit(5)
                                      ->get();

    // Get popular news
    $beritaPopuler = \App\Models\Berita::where('is_published', true)
                                      ->where('id', '!=', $berita->id)
                                      ->orderBy('views', 'desc')
                                      ->limit(5)
                                      ->get();
@endphp
@endsection
