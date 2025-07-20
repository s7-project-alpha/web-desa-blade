@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
        <a href="{{ route('admin.galeri.index') }}" class="hover:text-blue-600">Galeri</a>
        <span>/</span>
        <span class="text-gray-900">{{ Str::limit($galeri->judul, 30) }}</span>
    </div>
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $galeri->judul }}</h1>
            <p class="text-gray-600">Detail foto galeri</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.galeri.edit', $galeri) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Galeri
            </a>
            <a href="{{ route('public.galeri.detail', $galeri->slug) }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200">
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
    <!-- Photo Display -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Image -->
            <div class="relative">
                <img src="{{ $galeri->foto_url }}"
                     alt="{{ $galeri->alt_text }}"
                     class="w-full h-auto max-h-screen object-contain bg-gray-100">

                <!-- Badges -->
                <div class="absolute top-4 left-4 flex flex-col space-y-2">
                    <!-- Category Badge -->
                    <span class="px-3 py-1 rounded-full text-sm font-medium text-white"
                          style="background-color: {{ $galeri->kategori->warna_badge }}">
                        {{ $galeri->kategori->nama_kategori }}
                    </span>

                    @if($galeri->is_featured)
                        <span class="bg-yellow-500 text-white text-sm px-3 py-1 rounded-full">
                            ⭐ Unggulan
                        </span>
                    @endif

                    @if(!$galeri->is_active)
                        <span class="bg-red-500 text-white text-sm px-3 py-1 rounded-full">
                            Nonaktif
                        </span>
                    @endif
                </div>

                <!-- Views -->
                <div class="absolute top-4 right-4">
                    <span class="bg-black bg-opacity-60 text-white text-sm px-3 py-1 rounded flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $galeri->views_count }} views
                    </span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $galeri->judul }}</h2>

                @if($galeri->deskripsi)
                    <p class="text-gray-700 leading-relaxed mb-6">{{ $galeri->deskripsi }}</p>
                @endif

                <!-- Photo Meta Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
                    @if($galeri->photographer)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Fotografer</p>
                                <p class="font-medium text-gray-900">{{ $galeri->photographer }}</p>
                            </div>
                        </div>
                    @endif

                    @if($galeri->lokasi)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Lokasi</p>
                                <p class="font-medium text-gray-900">{{ $galeri->lokasi }}</p>
                            </div>
                        </div>
                    @endif

                    @if($galeri->tanggal_foto)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Foto</p>
                                <p class="font-medium text-gray-900">{{ $galeri->formatted_tanggal_foto }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Diunggah</p>
                            <p class="font-medium text-gray-900">{{ $galeri->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- SEO Info -->
                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Informasi SEO</h4>
                    <div class="space-y-2 text-sm">
                        <div>
                            <span class="text-gray-500">Slug:</span>
                            <code class="bg-white px-2 py-1 rounded text-xs ml-2">{{ $galeri->slug }}</code>
                        </div>
                        <div>
                            <span class="text-gray-500">Alt Text:</span>
                            <span class="ml-2">{{ $galeri->alt_text ?: 'Tidak ada' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">URL Public:</span>
                            <a href="{{ route('public.galeri.detail', $galeri->slug) }}" target="_blank" class="text-blue-600 hover:text-blue-800 ml-2 text-xs break-all">
                                {{ route('public.galeri.detail', $galeri->slug) }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
            <div class="space-y-3">
                <!-- Toggle Active -->
                <form action="{{ route('admin.galeri.toggle-active', $galeri) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full px-4 py-2 rounded-lg font-medium transition duration-200 {{ $galeri->is_active ? 'bg-red-100 text-red-800 hover:bg-red-200' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                        {{ $galeri->is_active ? 'Nonaktifkan' : 'Aktifkan' }} Galeri
                    </button>
                </form>

                <!-- Toggle Featured -->
                <form action="{{ route('admin.galeri.toggle-featured', $galeri) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full px-4 py-2 rounded-lg font-medium transition duration-200 {{ $galeri->is_featured ? 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                        {{ $galeri->is_featured ? 'Hapus dari Unggulan' : 'Jadikan Unggulan' }}
                    </button>
                </form>

                <!-- Edit Button -->
                <a href="{{ route('admin.galeri.edit', $galeri) }}" class="block w-full px-4 py-2 bg-blue-100 text-blue-800 rounded-lg font-medium text-center hover:bg-blue-200 transition duration-200">
                    Edit Galeri
                </a>

                <!-- Delete Button -->
                <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini? Foto akan dihapus permanen.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 bg-red-100 text-red-800 rounded-lg font-medium hover:bg-red-200 transition duration-200">
                        Hapus Galeri
                    </button>
                </form>
            </div>
        </div>

        <!-- File Info -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Info File</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Nama File:</span>
                    <span class="font-medium">{{ $galeri->foto_original_name ?: 'N/A' }}</span>
                </div>

                @if($galeri->metadata)
                    @if(isset($galeri->metadata['size']))
                        <div class="flex justify-between">
                            <span class="text-gray-500">Ukuran File:</span>
                            <span class="font-medium">{{ number_format($galeri->metadata['size'] / 1024, 1) }} KB</span>
                        </div>
                    @endif

                    @if(isset($galeri->metadata['mime_type']))
                        <div class="flex justify-between">
                            <span class="text-gray-500">Tipe File:</span>
                            <span class="font-medium">{{ $galeri->metadata['mime_type'] }}</span>
                        </div>
                    @endif

                    @if(isset($galeri->metadata['extension']))
                        <div class="flex justify-between">
                            <span class="text-gray-500">Ekstensi:</span>
                            <span class="font-medium uppercase">{{ $galeri->metadata['extension'] }}</span>
                        </div>
                    @endif
                @endif

                <div class="flex justify-between">
                    <span class="text-gray-500">Path:</span>
                    <span class="font-medium text-xs">{{ $galeri->foto_path }}</span>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Total Views:</span>
                    <span class="text-2xl font-bold text-blue-600">{{ $galeri->views_count }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Urutan:</span>
                    <span class="font-medium">{{ $galeri->urutan }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Diupdate:</span>
                    <span class="font-medium text-xs">{{ $galeri->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Back to List -->
        <div class="bg-blue-50 rounded-lg p-6 text-center">
            <svg class="mx-auto h-8 w-8 text-blue-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Kembali ke Daftar</h3>
            <p class="text-sm text-gray-600 mb-4">Lihat semua galeri yang tersedia</p>
            <a href="{{ route('admin.galeri.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                </svg>
                Daftar Galeri
            </a>
        </div>
    </div>
</div>
@endsection
