{{-- resources/views/admin/berita/show.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.berita.index') }}"
           class="p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Berita</h1>
            <p class="text-gray-600 mt-2">Informasi lengkap berita</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-3 space-y-6">
        <!-- Article Content -->
        <article class="glass-card rounded-2xl overflow-hidden">
            <!-- Article Header -->
            <div class="p-8 border-b border-gray-200">
                <!-- Meta Badges -->
                <div class="flex items-center space-x-3 mb-6">
                    {!! $berita->jenis_badge !!}
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium"
                          style="background-color: {{ $berita->kategori->warna }}20; color: {{ $berita->kategori->warna }};">
                        {{ $berita->kategori->nama }}
                    </span>
                    {!! $berita->status_badge !!}
                    @if($berita->is_featured)
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                            ⭐ Berita Utama
                        </span>
                    @endif
                    @if($berita->is_urgent)
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                            🚨 Penting
                        </span>
                    @endif
                </div>

                <!-- Title -->
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">{{ $berita->judul }}</h1>

                <!-- Article Info -->
                <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ $berita->author_name }}</span>
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
            </div>

            <!-- Featured Image -->
            @if($berita->gambar_utama)
                <div class="px-8 py-6">
                    <img src="{{ $berita->getGambarUtamaUrl() }}"
                         alt="{{ $berita->judul }}"
                         class="w-full h-96 object-cover rounded-xl shadow-lg">
                </div>
            @endif

            <!-- Summary -->
            <div class="px-8 py-6 bg-blue-50 border-l-4 border-blue-400">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Ringkasan</h3>
                <p class="text-gray-800 leading-relaxed">{{ $berita->ringkasan }}</p>
            </div>

            <!-- Article Content -->
            <div class="px-8 py-6">
                <div class="prose prose-lg max-w-none">
                    {!! nl2br(e($berita->konten)) !!}
                </div>
            </div>

            <!-- Article Footer -->
            <div class="px-8 py-6 border-t border-gray-200 bg-gray-50">
                <!-- Tags -->
                @if($berita->tags && count($berita->tags) > 0)
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3">Tags:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($berita->tags as $tag)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-200 text-gray-700">
                                    #{{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Source -->
                @if($berita->sumber)
                    <div class="mb-6">
                        <p class="text-sm text-gray-600">
                            <strong>Sumber:</strong> {{ $berita->sumber }}
                        </p>
                    </div>
                @endif

                <!-- Expiry Notice -->
                @if($berita->tanggal_berakhir)
                    <div class="p-4 bg-orange-50 border border-orange-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-orange-800 font-medium">
                                @if($berita->isExpired())
                                    Berita ini telah kedaluwarsa pada {{ $berita->tanggal_berakhir->format('d F Y') }}
                                @else
                                    Berita ini akan kedaluwarsa pada {{ $berita->tanggal_berakhir->format('d F Y') }}
                                @endif
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        </article>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Article Details -->
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Berita</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Jenis</span>
                    <span class="text-sm font-medium text-gray-900 capitalize">{{ $berita->jenis }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Status</span>
                    <span class="text-sm font-medium text-gray-900 capitalize">{{ $berita->status }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Kategori</span>
                    <span class="text-sm font-medium text-gray-900">{{ $berita->kategori->nama }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Penulis</span>
                    <span class="text-sm font-medium text-gray-900">{{ $berita->author->name }}</span>
                </div>
                @if($berita->penulis && $berita->penulis !== $berita->author->name)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-700">Nama Penulis</span>
                        <span class="text-sm font-medium text-gray-900">{{ $berita->penulis }}</span>
                    </div>
                @endif
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Dibuat</span>
                    <span class="text-sm text-gray-900">{{ $berita->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Diperbarui</span>
                    <span class="text-sm text-gray-900">{{ $berita->updated_at->format('d/m/Y H:i') }}</span>
                </div>
                @if($berita->published_at)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-700">Dipublikasi</span>
                        <span class="text-sm text-gray-900">{{ $berita->published_at->format('d/m/Y H:i') }}</span>
                    </div>
                @endif
                @if($berita->tanggal_berakhir)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-700">Berakhir</span>
                        <span class="text-sm text-gray-900">{{ $berita->tanggal_berakhir->format('d/m/Y') }}</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Settings -->
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengaturan</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Berita Utama</span>
                    <form action="{{ route('admin.berita.toggle-featured', $berita) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 {{ $berita->is_featured ? 'bg-yellow-600' : 'bg-gray-200' }}">
                            <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $berita->is_featured ? 'translate-x-5' : 'translate-x-0' }}"></span>
                        </button>
                    </form>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Penting</span>
                    <span class="text-sm {{ $berita->is_urgent ? 'text-red-600' : 'text-gray-400' }}">
                        {{ $berita->is_urgent ? 'Ya' : 'Tidak' }}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Komentar</span>
                    <span class="text-sm {{ $berita->allow_comments ? 'text-green-600' : 'text-gray-400' }}">
                        {{ $berita->allow_comments ? 'Diizinkan' : 'Dinonaktifkan' }}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Status Aktif</span>
                    <form action="{{ route('admin.berita.toggle-active', $berita) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 {{ $berita->is_active ? 'bg-blue-600' : 'bg-gray-200' }}">
                            <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $berita->is_active ? 'translate-x-5' : 'translate-x-0' }}"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Public Links -->
        @if($berita->status === 'published')
            <div class="glass-card rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Tautan Publik</h3>
                <div class="space-y-3">
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <div class="text-xs text-gray-500 mb-1">URL Berita</div>
                        <div class="text-sm text-gray-900 break-all">{{ route('public.berita.detail', $berita->slug) }}</div>
                    </div>
                    <a href="{{ route('public.berita.detail', $berita->slug) }}"
                       target="_blank"
                       class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M7 13l3 3 7-7"></path>
                        </svg>
                        Lihat di Website
                    </a>
                </div>
            </div>
        @endif

        <!-- Danger Zone -->
        <div class="glass-card rounded-2xl p-6 border border-red-200">
            <h3 class="text-lg font-semibold text-red-900 mb-4">Zona Berbahaya</h3>
            <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-red-600 text-white font-medium rounded-xl hover:bg-red-700 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Berita
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
