@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
        <a href="{{ route('admin.kategori-galeri.index') }}" class="hover:text-blue-600">Kategori Galeri</a>
        <span>/</span>
        <span class="text-gray-900">{{ $kategoriGaleri->nama_kategori }}</span>
    </div>
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $kategoriGaleri->nama_kategori }}</h1>
            <p class="text-gray-600">Detail kategori galeri</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto mt-4 sm:mt-0">
            <a href="{{ route('admin.kategori-galeri.edit', $kategoriGaleri) }}" class="transition duration-200 w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium flex items-center justify-center">
                <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Kategori
            </a>
            <a href="{{ route('public.galeri.index', ['kategori' => $kategoriGaleri->slug]) }}" target="_blank" class="bg-green-600 hover:bg-green-700 transition duration-200 w-full sm:w-auto flex items-center justify-center text-white px-4 py-2 rounded-lg font-medium">
                <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M7 9l5 5m0 0l5-5m-5 5V3"></path>
                </svg>
                Lihat di Website
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Category Info -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <div class="flex items-center mb-6">
                    <span class="inline-block w-8 h-8 rounded-full mr-4" style="background-color: {{ $kategoriGaleri->warna_badge }}"></span>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $kategoriGaleri->nama_kategori }}</h2>
                        <p class="text-gray-500">Kategori Galeri</p>
                    </div>
                </div>

                @if($kategoriGaleri->deskripsi)
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Deskripsi</h3>
                        <p class="text-gray-900 leading-relaxed">{{ $kategoriGaleri->deskripsi }}</p>
                    </div>
                @endif

                <!-- Category Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-gray-50 rounded-lg">
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Informasi Dasar</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Slug:</span>
                                <code class="bg-white px-2 py-1 rounded">{{ $kategoriGaleri->slug }}</code>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Urutan:</span>
                                <span class="font-medium">{{ $kategoriGaleri->urutan }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Status:</span>
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $kategoriGaleri->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $kategoriGaleri->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Statistik</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Total Galeri:</span>
                                <span class="text-2xl font-bold text-blue-600">{{ $kategoriGaleri->galeri->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Galeri Aktif:</span>
                                <span class="font-medium">{{ $kategoriGaleri->galeri->where('is_active', true)->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Galeri Unggulan:</span>
                                <span class="font-medium">{{ $kategoriGaleri->galeri->where('is_featured', true)->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Badge Preview -->
                <div class="mt-6">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Preview Badge</h4>
                    <div class="inline-flex items-center">
                        <span class="px-3 py-1 rounded-full text-sm font-medium text-white" style="background-color: {{ $kategoriGaleri->warna_badge }}">
                            {{ $kategoriGaleri->nama_kategori }}
                        </span>
                        <span class="ml-2 text-xs text-gray-500">{{ $kategoriGaleri->warna_badge }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery List -->
        @if($kategoriGaleri->galeri->count() > 0)
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Galeri dalam Kategori Ini</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($kategoriGaleri->galeri->take(9) as $galeri)
                            <div class="group relative bg-gray-100 rounded-lg overflow-hidden hover:shadow-lg transition duration-200">
                                <a href="{{ route('admin.galeri.show', $galeri) }}">
                                    <div class="aspect-w-16 aspect-h-12">
                                        <img src="{{ $galeri->foto_url }}"
                                             alt="{{ $galeri->alt_text }}"
                                             class="w-full h-32 object-cover group-hover:scale-105 transition duration-200">
                                    </div>

                                    <!-- Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-200"></div>

                                    <!-- Content -->
                                    <div class="absolute bottom-0 left-0 right-0 p-3 text-white transform translate-y-2 group-hover:translate-y-0 transition duration-200">
                                        <h4 class="font-medium text-sm line-clamp-1">{{ $galeri->judul }}</h4>
                                        <div class="flex items-center justify-between mt-1 text-xs">
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $galeri->views_count }}
                                            </span>
                                            @if($galeri->is_featured)
                                                <span class="text-yellow-300">⭐</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Status badges -->
                                    <div class="absolute top-2 right-2 flex flex-col space-y-1">
                                        @if(!$galeri->is_active)
                                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">Nonaktif</span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    @if($kategoriGaleri->galeri->count() > 9)
                        <div class="mt-6 text-center">
                            <a href="{{ route('admin.galeri.index', ['kategori_id' => $kategoriGaleri->id]) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                Lihat semua {{ $kategoriGaleri->galeri->count() }} galeri →
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Galeri dalam Kategori Ini</h3>
                </div>
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada galeri</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan foto galeri pertama untuk kategori ini.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Tambah Galeri
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
            <div class="space-y-3">
                <!-- Toggle Active -->
                <form action="{{ route('admin.kategori-galeri.toggle-active', $kategoriGaleri) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full px-4 py-2 rounded-lg font-medium transition duration-200 {{ $kategoriGaleri->is_active ? 'bg-red-100 text-red-800 hover:bg-red-200' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                        {{ $kategoriGaleri->is_active ? 'Nonaktifkan' : 'Aktifkan' }} Kategori
                    </button>
                </form>

                <!-- Edit Button -->
                <a href="{{ route('admin.kategori-galeri.edit', $kategoriGaleri) }}" class="block w-full px-4 py-2 bg-blue-100 text-blue-800 rounded-lg font-medium text-center hover:bg-blue-200 transition duration-200">
                    Edit Kategori
                </a>

                <!-- Add Gallery -->
                <a href="{{ route('admin.galeri.create') }}" class="block w-full px-4 py-2 bg-green-100 text-green-800 rounded-lg font-medium text-center hover:bg-green-200 transition duration-200">
                    Tambah Galeri
                </a>

                <!-- Delete Button -->
                @if($kategoriGaleri->galeri->count() == 0)
                    <form action="{{ route('admin.kategori-galeri.destroy', $kategoriGaleri) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-100 text-red-800 rounded-lg font-medium hover:bg-red-200 transition duration-200">
                            Hapus Kategori
                        </button>
                    </form>
                @else
                    <div class="w-full px-4 py-2 bg-gray-100 text-gray-500 rounded-lg font-medium text-center cursor-not-allowed">
                        Tidak dapat dihapus (ada {{ $kategoriGaleri->galeri->count() }} galeri)
                    </div>
                @endif
            </div>
        </div>

        <!-- Category Info -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Info Kategori</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Dibuat:</span>
                    <span class="font-medium">{{ $kategoriGaleri->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Diupdate:</span>
                    <span class="font-medium">{{ $kategoriGaleri->updated_at->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">URL Public:</span>
                    <a href="{{ route('public.galeri.index', ['kategori' => $kategoriGaleri->slug]) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs">
                        Lihat →
                    </a>
                </div>
            </div>
        </div>

        <!-- Back to List -->
        <div class="bg-blue-50 rounded-lg p-6 text-center">
            <svg class="mx-auto h-8 w-8 text-blue-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a.997.997 0 01-1.414 0l-7-7A1.997 1.997 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Kembali ke Daftar</h3>
            <p class="text-sm text-gray-600 mb-4">Lihat semua kategori galeri</p>
            <a href="{{ route('admin.kategori-galeri.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                </svg>
                Daftar Kategori
            </a>
        </div>
    </div>
</div>
@endsection
