@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Galeri Desa</h1>
            <p class="text-gray-600">Kelola foto-foto kegiatan dan dokumentasi desa</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
            <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
            </svg>
            Tambah Galeri
        </a>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        {{ session('error') }}
    </div>
@endif

<!-- Filter Section -->
<div class="bg-white rounded-lg shadow mb-6">
    <div class="p-6">
        <form method="GET" action="{{ route('admin.galeri.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                <input type="text"
                       id="search"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Judul, fotografer, lokasi..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Category Filter -->
            <div>
                <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select id="kategori_id"
                        name="kategori_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status"
                        name="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <!-- Featured Filter -->
            <div>
                <label for="featured" class="block text-sm font-medium text-gray-700 mb-1">Unggulan</label>
                <select id="featured"
                        name="featured"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Semua</option>
                    <option value="1" {{ request('featured') === '1' ? 'selected' : '' }}>Unggulan</option>
                    <option value="0" {{ request('featured') === '0' ? 'selected' : '' }}>Biasa</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                    Filter
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition duration-200">
                    Reset
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Gallery Grid -->
<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        @if($galeri->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($galeri as $item)
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition duration-200">
                        <!-- Image -->
                        <div class="relative">
                            <img src="{{ $item->foto_url }}"
                                 alt="{{ $item->alt_text }}"
                                 class="w-full h-48 object-cover">

                            <!-- Badges -->
                            <div class="absolute top-2 left-2 flex flex-col space-y-1">
                                @if($item->is_featured)
                                    <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded">Unggulan</span>
                                @endif
                                @if(!$item->is_active)
                                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">Nonaktif</span>
                                @endif
                            </div>

                            <!-- Category Badge -->
                            <div class="absolute top-2 right-2">
                                <span class="text-white text-xs px-2 py-1 rounded-full" style="background-color: {{ $item->kategori->warna_badge }}">
                                    {{ $item->kategori->nama_kategori }}
                                </span>
                            </div>

                            <!-- Views -->
                            <div class="absolute bottom-2 left-2">
                                <span class="bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $item->views_count }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $item->judul }}</h3>

                            @if($item->deskripsi)
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $item->deskripsi }}</p>
                            @endif

                            <!-- Meta Info -->
                            <div class="space-y-1 text-xs text-gray-500 mb-3">
                                @if($item->photographer)
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $item->photographer }}
                                    </div>
                                @endif
                                @if($item->lokasi)
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $item->lokasi }}
                                    </div>
                                @endif
                                <div class="flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $item->created_at->format('d M Y') }}
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center">
                                <div class="flex space-x-1">
                                    <a href="{{ route('admin.galeri.show', $item) }}" class="text-blue-600 hover:text-blue-800 text-sm">Lihat</a>
                                    <span class="text-gray-300">|</span>
                                    <a href="{{ route('admin.galeri.edit', $item) }}" class="text-indigo-600 hover:text-indigo-800 text-sm">Edit</a>
                                </div>

                                <div class="flex space-x-1">
                                    <!-- Toggle Active -->
                                    <form action="{{ route('admin.galeri.toggle-active', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-xs px-2 py-1 rounded {{ $item->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }} transition duration-200">
                                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </form>

                                    <!-- Toggle Featured -->
                                    <form action="{{ route('admin.galeri.toggle-featured', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-xs px-2 py-1 rounded {{ $item->is_featured ? 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} transition duration-200">
                                            {{ $item->is_featured ? '⭐' : '☆' }}
                                        </button>
                                    </form>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.galeri.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs px-2 py-1 rounded bg-red-100 text-red-800 hover:bg-red-200 transition duration-200">
                                            ✕
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $galeri->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada galeri</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan foto galeri pertama Anda.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Tambah Galeri
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
