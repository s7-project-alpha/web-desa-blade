@extends('public.layouts.app')

@section('title', $galeri->judul . ' - Galeri Desa Tanjung Selamat')
@section('description', $galeri->deskripsi ?: 'Foto galeri dari Desa Tanjung Selamat')

@section('content')
<!-- Breadcrumb -->
<section class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center space-x-2 text-sm text-gray-600">
            <a href="{{ route('public.home') }}" class="hover:text-blue-600">Beranda</a>
            <span>/</span>
            <a href="{{ route('public.galeri.index') }}" class="hover:text-blue-600">Galeri</a>
            <span>/</span>
            <a href="{{ route('public.galeri.index', ['kategori' => $galeri->kategori->slug]) }}" class="hover:text-blue-600">{{ $galeri->kategori->nama_kategori }}</a>
            <span>/</span>
            <span class="text-gray-900">{{ Str::limit($galeri->judul, 30) }}</span>
        </nav>
    </div>
</section>

<!-- Main Content -->
<section class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Photo -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Image -->
                    <div class="relative">
                        <img src="{{ $galeri->foto_url }}"
                             alt="{{ $galeri->alt_text }}"
                             class="w-full h-auto max-h-screen object-contain bg-gray-100">

                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full text-sm font-medium text-white"
                                  style="background-color: {{ $galeri->kategori->warna_badge }}">
                                {{ $galeri->kategori->nama_kategori }}
                            </span>
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
                        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4">{{ $galeri->judul }}</h1>

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

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between mt-6 pt-6 border-t border-gray-200">
                            <div class="flex space-x-3">
                                <button onclick="downloadImage()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Download
                                </button>
                                <button onclick="shareImage()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                    </svg>
                                    Bagikan
                                </button>
                            </div>

                            <div class="flex space-x-3">
                                <a href="{{ route('public.galeri.index', ['kategori' => $galeri->kategori->slug]) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    Lihat kategori {{ $galeri->kategori->nama_kategori }} →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Related Gallery -->
                @if($relatedGaleri->count() > 0)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Galeri Terkait</h3>
                        <div class="space-y-4">
                            @foreach($relatedGaleri as $related)
                                <a href="{{ route('public.galeri.index', $related->slug) }}" class="flex items-center space-x-3 hover:bg-gray-50 p-2 rounded-lg transition duration-200">
                                    <img src="{{ $related->foto_url }}"
                                         alt="{{ $related->alt_text }}"
                                         class="w-16 h-16 object-cover rounded-lg">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 line-clamp-2">{{ $related->judul }}</h4>
                                        <p class="text-xs text-gray-500 mt-1">{{ $related->created_at->format('d M Y') }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Latest Gallery -->
                @if($latestGaleri->count() > 0)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Galeri Terbaru</h3>
                        <div class="space-y-4">
                            @foreach($latestGaleri as $latest)
                                <a href="{{ route('public.galeri.index', $latest->slug) }}" class="flex items-center space-x-3 hover:bg-gray-50 p-2 rounded-lg transition duration-200">
                                    <img src="{{ $latest->foto_url }}"
                                         alt="{{ $latest->alt_text }}"
                                         class="w-16 h-16 object-cover rounded-lg">
                                    <div class="flex-1 min-w-0">
                                        <span class="inline-block px-2 py-1 text-xs font-medium text-white rounded-full mb-1"
                                              style="background-color: {{ $latest->kategori->warna_badge }}">
                                            {{ $latest->kategori->nama_kategori }}
                                        </span>
                                        <h4 class="text-sm font-medium text-gray-900 line-clamp-2">{{ $latest->judul }}</h4>
                                        <p class="text-xs text-gray-500 mt-1">{{ $latest->created_at->format('d M Y') }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('public.galeri.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Lihat semua galeri →
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Back to Gallery -->
                <div class="bg-blue-50 rounded-lg p-6 text-center">
                    <svg class="mx-auto h-8 w-8 text-blue-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Jelajahi Galeri Lainnya</h3>
                    <p class="text-sm text-gray-600 mb-4">Temukan lebih banyak foto kegiatan dan dokumentasi desa</p>
                    <a href="{{ route('public.galeri.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                        </svg>
                        Kembali ke Galeri
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function downloadImage() {
    const link = document.createElement('a');
    link.href = '{{ $galeri->foto_url }}';
    link.download = '{{ $galeri->judul }}.jpg';
    link.target = '_blank';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function shareImage() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $galeri->judul }}',
            text: '{{ $galeri->deskripsi ?: "Galeri dari Desa Tanjung Selamat" }}',
            url: window.location.href
        });
    } else {
        // Fallback to copy URL to clipboard
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Link telah disalin ke clipboard!');
        });
    }
}
</script>
@endsection
