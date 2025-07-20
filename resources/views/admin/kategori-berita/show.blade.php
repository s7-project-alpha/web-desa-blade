{{-- resources/views/admin/kategori-berita/show.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.kategori-berita.index') }}"
           class="p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Kategori Berita</h1>
            <p class="text-gray-600 mt-2">Informasi lengkap kategori {{ $kategoriBerita->nama }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Category Info -->
        <div class="glass-card rounded-2xl p-8">
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center" style="background-color: {{ $kategoriBerita->warna }}20; color: {{ $kategoriBerita->warna }};">
                        @if($kategoriBerita->icon)
                            <i class="{{ $kategoriBerita->icon }} text-2xl"></i>
                        @else
                            <div class="w-8 h-8 rounded-full" style="background-color: {{ $kategoriBerita->warna }};"></div>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $kategoriBerita->nama }}</h2>
                        <p class="text-gray-600">{{ $kategoriBerita->slug }}</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.kategori-berita.edit', $kategoriBerita->slug) }}"
                       class="btn-modern px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-medium rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                </div>
            </div>

            @if($kategoriBerita->deskripsi)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $kategoriBerita->deskripsi }}</p>
                </div>
            @endif

            <!-- Category Details -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center p-4 bg-gray-50 rounded-xl">
                    <div class="text-2xl font-bold text-gray-900">{{ $kategoriBerita->beritas_count }}</div>
                    <div class="text-sm text-gray-500">Total Berita</div>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-xl">
                    <div class="text-2xl font-bold text-gray-900">{{ $kategoriBerita->beritas_active_count }}</div>
                    <div class="text-sm text-gray-500">Berita Aktif</div>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-xl">
                    <div class="text-2xl font-bold text-gray-900">{{ $kategoriBerita->urutan }}</div>
                    <div class="text-sm text-gray-500">Urutan</div>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-xl">
                    <div class="text-2xl font-bold {{ $kategoriBerita->is_active ? 'text-green-600' : 'text-red-600' }}">
                        {{ $kategoriBerita->is_active ? 'Aktif' : 'Nonaktif' }}
                    </div>
                    <div class="text-sm text-gray-500">Status</div>
                </div>
            </div>
        </div>

        <!-- Recent Articles -->
        @if($kategoriBerita->beritas->count() > 0)
            <div class="glass-card rounded-2xl p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Berita Terbaru</h3>
                    <a href="{{ route('admin.berita.index', ['kategori' => $kategoriBerita->id]) }}"
                       class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                        Lihat Semua
                    </a>
                </div>
                <div class="space-y-4">
                    @foreach($kategoriBerita->beritas as $berita)
                        <article class="flex items-start space-x-4 p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors duration-200">
                            <img src="{{ $berita->getGambarUtamaUrl() }}"
                                 alt="{{ $berita->judul }}"
                                 class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                            <div class="flex-1">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 line-clamp-1 mb-2">
                                            <a href="{{ route('admin.berita.show', $berita) }}" class="hover:text-blue-600">
                                                {{ $berita->judul }}
                                            </a>
                                        </h4>
                                        <p class="text-sm text-gray-600 line-clamp-2 mb-2">{{ $berita->ringkasan }}</p>
                                        <div class="flex items-center space-x-4 text-xs text-gray-500">
                                            <span>{{ $berita->formatted_date }}</span>
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $berita->views }}
                                            </span>
                                            <span>oleh {{ $berita->author_name }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2 ml-4">
                                        {!! $berita->status_badge !!}
                                        @if($berita->is_featured)
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">
                                                ⭐ Featured
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Quick Actions -->
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.berita.create') }}?kategori={{ $kategoriBerita->id }}"
                   class="w-full btn-modern flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tulis Berita Baru
                </a>
                <a href="{{ route('admin.berita.index', ['kategori' => $kategoriBerita->id]) }}"
                   class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    Kelola Berita
                </a>
                <a href="{{ route('admin.kategori-berita.edit', $kategoriBerita->slug) }}"
                   class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Kategori
                </a>
            </div>
        </div>

        <!-- Category Settings -->
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengaturan Kategori</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Warna</span>
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded-full border-2 border-gray-200" style="background-color: {{ $kategoriBerita->warna }};"></div>
                        <span class="text-sm font-mono text-gray-600">{{ $kategoriBerita->warna }}</span>
                    </div>
                </div>
                @if($kategoriBerita->icon)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-700">Icon</span>
                        <div class="flex items-center space-x-2">
                            <i class="{{ $kategoriBerita->icon }}" style="color: {{ $kategoriBerita->warna }};"></i>
                            <span class="text-sm font-mono text-gray-600">{{ $kategoriBerita->icon }}</span>
                        </div>
                    </div>
                @endif
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Urutan</span>
                    <span class="text-sm font-medium text-gray-900">{{ $kategoriBerita->urutan }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Status</span>
                    <form action="{{ route('admin.kategori-berita.toggle-active', $kategoriBerita) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 {{ $kategoriBerita->is_active ? 'bg-blue-600' : 'bg-gray-200' }}">
                            <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $kategoriBerita->is_active ? 'translate-x-5' : 'translate-x-0' }}"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Dibuat</span>
                    <span class="text-sm text-gray-900">{{ $kategoriBerita->created_at->format('d/m/Y') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Diperbarui</span>
                    <span class="text-sm text-gray-900">{{ $kategoriBerita->updated_at->format('d/m/Y') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Total Views</span>
                    <span class="text-sm text-gray-900">{{ $kategoriBerita->beritas->sum('views') }}</span>
                </div>
            </div>
        </div>

        <!-- Public Link -->
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tautan Publik</h3>
            <div class="space-y-3">
                <div class="p-3 bg-gray-50 rounded-lg">
                    <div class="text-xs text-gray-500 mb-1">URL Kategori</div>
                    <div class="text-sm text-gray-900 break-all">{{ route('public.berita.kategori', $kategoriBerita->slug) }}</div>
                </div>
                <a href="{{ route('public.berita.kategori', $kategoriBerita->slug) }}"
                   target="_blank"
                   class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M7 13l3 3 7-7"></path>
                    </svg>
                    Lihat di Website
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
