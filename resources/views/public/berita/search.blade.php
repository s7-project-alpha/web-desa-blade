{{-- resources/views/public/berita/search.blade.php --}}
@extends('public.layouts.app')

@section('title', 'Pencarian: ' . $search . ' - Desa Tanjung Selamat')
@section('description', 'Hasil pencarian berita dan pengumuman untuk: ' . $search)

@section('content')
<!-- Search Header -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-4">Hasil Pencarian</h1>
            <p class="text-xl text-blue-100 mb-6">Menampilkan hasil untuk: <strong>"{{ $search }}"</strong></p>

            <!-- Search Form -->
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('public.berita.search') }}" method="GET" class="flex">
                    <input type="text"
                           name="q"
                           value="{{ $search }}"
                           placeholder="Cari berita atau pengumuman..."
                           class="flex-1 px-6 py-3 rounded-l-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <button type="submit"
                            class="px-8 py-3 bg-blue-700 hover:bg-blue-800 rounded-r-xl transition-colors duration-200">
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
            <!-- Search Filters -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Pencarian</h3>
                <form action="{{ route('public.berita.search') }}" method="GET" class="space-y-4">
                    <input type="hidden" name="q" value="{{ $search }}">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="kategori" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->slug }}" {{ request('kategori') === $kategori->slug ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis</label>
                        <select name="jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Jenis</option>
                            <option value="berita" {{ request('jenis') === 'berita' ? 'selected' : '' }}>Berita</option>
                            <option value="pengumuman" {{ request('jenis') === 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Terapkan Filter
                    </button>
                </form>
            </div>

            <!-- Quick Links -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Tautan Cepat</h3>
                <div class="space-y-2">
                    <a href="{{ route('public.berita') }}"
                       class="block p-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                        📰 Semua Berita
                    </a>
                    <a href="{{ route('public.berita', ['jenis' => 'pengumuman']) }}"
                       class="block p-3 text-gray-600 hover:bg-gray-50 hover:text-orange-600 rounded-lg transition-colors duration-200">
                        📢 Pengumuman
                    </a>
                    @foreach($kategoris->take(5) as $kategori)
                        <a href="{{ route('public.berita.kategori', $kategori->slug) }}"
                           class="block p-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full mr-3" style="background-color: {{ $kategori->warna }};"></div>
                                {{ $kategori->nama }}
                            </div>
                        </a>
                    @endforeach
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
            <!-- Search Results -->
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900">Hasil Pencarian</h2>
                    <span class="text-sm text-gray-500">{{ $beritas->total() }} artikel ditemukan</span>
                </div>
                @if(request('kategori') || request('jenis'))
                    <div class="mt-2 flex items-center space-x-2">
                        <span class="text-sm text-gray-500">Filter aktif:</span>
                        @if(request('kategori'))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-800">
                                Kategori: {{ $kategoris->where('slug', request('kategori'))->first()->nama ?? request('kategori') }}
                                <a href="{{ route('public.berita.search', ['q' => $search, 'jenis' => request('jenis')]) }}" class="ml-2 text-blue-600 hover:text-blue-800">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </span>
                        @endif
                        @if(request('jenis'))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-orange-100 text-orange-800">
                                Jenis: {{ ucfirst(request('jenis')) }}
                                <a href="{{ route('public.berita.search', ['q' => $search, 'kategori' => request('kategori')]) }}" class="ml-2 text-orange-600 hover:text-orange-800">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </span>
                        @endif
                    </div>
                @endif
            </div>

            @if($beritas->count() > 0)
                <div class="space-y-8">
                    @foreach($beritas as $berita)
                        <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
                            <div class="md:flex">
                                <div class="md:flex-shrink-0">
                                    <img src="{{ $berita->getGambarUtamaUrl() }}"
                                         alt="{{ $berita->judul }}"
                                         class="h-48 w-full object-cover md:h-full md:w-48">
                                </div>
                                <div class="p-6 flex-1">
                                    <!-- Meta Info -->
                                    <div class="flex items-center space-x-2 mb-3">
                                        @if($berita->jenis === 'pengumuman')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                Pengumuman
                                            </span>
                                        @endif
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium"
                                              style="background-color: {{ $berita->kategori->warna }}20; color: {{ $berita->kategori->warna }};">
                                            {{ $berita->kategori->nama }}
                                        </span>
                                        @if($berita->is_featured)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                ⭐ Featured
                                            </span>
                                        @endif
                                        @if($berita->is_urgent)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                🚨 Penting
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-blue-600 transition-colors duration-200">
                                        <a href="{{ route('public.berita.detail', $berita->slug) }}">
                                            {{ $berita->judul }}
                                        </a>
                                    </h3>

                                    <!-- Summary -->
                                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $berita->ringkasan }}</p>

                                    <!-- Meta -->
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
                                            <span>oleh {{ $berita->author_name }}</span>
                                        </div>
                                        <a href="{{ route('public.berita.detail', $berita->slug) }}"
                                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                            Baca Selengkapnya
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
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
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada hasil ditemukan</h3>
                    <p class="text-gray-500 mb-6">
                        Tidak ada berita yang cocok dengan pencarian "<strong>{{ $search }}</strong>"
                        @if(request('kategori') || request('jenis'))
                            dengan filter yang diterapkan
                        @endif
                    </p>
                    <div class="space-y-4">
                        <p class="text-sm text-gray-600">Saran:</p>
                        <ul class="text-sm text-gray-500 space-y-1">
                            <li>• Periksa ejaan kata kunci</li>
                            <li>• Gunakan kata kunci yang lebih umum</li>
                            <li>• Coba hapus beberapa filter</li>
                            <li>• Gunakan sinonim atau kata yang serupa</li>
                        </ul>
                        <div class="flex justify-center space-x-4 mt-6">
                            <a href="{{ route('public.berita.search', ['q' => $search]) }}"
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                Hapus Filter
                            </a>
                            <a href="{{ route('public.berita') }}"
                               class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                                Lihat Semua Berita
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
