@extends('public.layouts.app')

@section('title', 'Visi, Misi & Nilai Dasar - Desa Tanjung Selamat')
@section('description', 'Visi, misi, dan nilai dasar Desa Tanjung Selamat sebagai panduan pembangunan dan pelayanan kepada masyarakat')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Visi, Misi & Nilai Dasar
            </h1>
            <p class="text-xl text-blue-100 mb-6">
                Desa Tanjung Selamat
            </p>
            @if($visiMisi)
                <div class="inline-flex items-center bg-blue-500 bg-opacity-20 rounded-full px-4 py-2">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    Periode {{ $visiMisi->periode }}
                </div>
            @endif
        </div>
    </div>
</section>

@if($visiMisi)
<!-- Visi Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-6">
                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Visi</h2>
            <div class="max-w-4xl mx-auto">
                <blockquote class="text-xl md:text-2xl text-gray-700 leading-relaxed italic border-l-4 border-blue-500 pl-6 bg-blue-50 p-8 rounded-r-lg">
                    "{{ $visiMisi->visi }}"
                </blockquote>
            </div>
        </div>
    </div>
</section>

<!-- Misi Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-6">
                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Misi</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl mx-auto">
            @foreach($visiMisi->misi_array as $index => $misi)
                @if(trim($misi))
                    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-200">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                <span class="text-green-600 font-bold text-lg">{{ $index + 1 }}</span>
                            </div>
                            <div>
                                <p class="text-gray-900 leading-relaxed">{{ trim($misi) }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

@if($visiMisi->nilai_dasar)
<!-- Nilai Dasar Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-6">
                <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Nilai Dasar</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($visiMisi->nilai_dasar_array as $index => $nilai)
                @if(trim($nilai))
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-6 border border-purple-200">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
                            </div>
                            <div>
                                <p class="text-gray-900 leading-relaxed">{{ trim($nilai) }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif

@if($visiMisi->tujuan || $visiMisi->sasaran)
<!-- Tujuan & Sasaran Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            @if($visiMisi->tujuan)
            <div>
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Tujuan</h3>
                </div>

                <div class="space-y-4">
                    @foreach($visiMisi->tujuan_array as $index => $tujuan)
                        @if(trim($tujuan))
                            <div class="bg-white rounded-lg p-4 shadow border-l-4 border-yellow-400">
                                <div class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-sm font-medium mr-3">
                                        {{ $index + 1 }}
                                    </span>
                                    <p class="text-gray-900 leading-relaxed">{{ trim($tujuan) }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            @if($visiMisi->sasaran)
            <div>
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Sasaran</h3>
                </div>

                <div class="space-y-4">
                    @foreach($visiMisi->sasaran_array as $index => $sasaran)
                        @if(trim($sasaran))
                            <div class="bg-white rounded-lg p-4 shadow border-l-4 border-red-400">
                                <div class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-sm font-medium mr-3">
                                        {{ $index + 1 }}
                                    </span>
                                    <p class="text-gray-900 leading-relaxed">{{ trim($sasaran) }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

@else
<!-- No Data Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-md mx-auto">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h2 class="mt-6 text-2xl font-bold text-gray-900">Visi Misi Belum Tersedia</h2>
            <p class="mt-2 text-gray-600">Visi, misi, dan nilai dasar desa sedang dalam proses penyusunan. Silakan kunjungi halaman ini lagi di lain waktu.</p>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-16 bg-blue-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">
            Ingin Tahu Lebih Lanjut?
        </h2>
        <p class="text-xl text-blue-100 mb-8">
            Pelajari lebih lanjut tentang profil dan layanan Desa Tanjung Selamat
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('public.perangkat-desa') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-200">
                Perangkat Desa
            </a>
            <a href="{{ route('public.demografi') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-200">
                Data Demografi
            </a>
        </div>
    </div>
</section>
@endsection
