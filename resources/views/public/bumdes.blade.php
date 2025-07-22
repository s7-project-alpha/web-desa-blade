@extends('public.layouts.app')

@section('title', 'BUMDes - Desa Tanjung Selamat')
@section('description', 'Badan Usaha Milik Desa Tanjung Selamat - Informasi unit usaha, tim manajemen, dan program BUMDes')

@section('content')
@php
    $bumdesData = \App\Models\Bumdes::getCompleteData();
    $bumdes = $bumdesData['bumdes'] ?? null;
    $unitUsaha = $bumdesData['unit_usaha'] ?? collect();
    $timManajemen = $bumdesData['tim_manajemen'] ?? collect();
@endphp

@if($bumdes)
    <!-- Hero Section with Background Image -->
    <section class="relative min-h-[324px] flex items-center justify-center text-white overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-90% via-sky-500 via-30% to-indigo-500 z-10"></div>
        <div class="absolute inset-0">
            <img src="{{ $bumdes->header_image_url }}" alt="BUMDes Header" class="w-full h-full object-cover">
        </div>

        <div class="relative z-20 text-center max-w-4xl mx-auto px-4">
            @if($bumdes->header_title)
                <h1 class="text-5xl md:text-5xl font-bold mb-4">{{ $bumdes->header_title }}</h1>
            @else
                <h1 class="text-5xl md:text-5xl font-bold mb-4">{{ $bumdes->nama }}</h1>
            @endif

            @if($bumdes->header_subtitle)
                <p class="text-2xl md:text-2xl font-medium text-blue-100">{{ $bumdes->header_subtitle }}</p>
            @endif

            @if($bumdes->tagline)
                <p class="text-xl mt-4 text-blue-100">{{ $bumdes->tagline }}</p>
            @endif
        </div>
    </section>

    <!-- Description Section -->
    @if($bumdes->deskripsi)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Tentang {{ $bumdes->nama }}</h2>
                <p class="text-lg text-gray-600 max-w-4xl mx-auto leading-relaxed">{{ $bumdes->deskripsi }}</p>
                @if($bumdes->tagline)
                    <p class="text-xl text-blue-600 font-semibold mt-6">"{{ $bumdes->tagline }}"</p>
                @endif
                <p class="text-gray-600 mt-2">Bersama menuju kemandirian ekonomi</p>
            </div>
        </section>
    @endif

    <!-- Statistics Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Prestasi BUMDes</h2>
                <p class="text-lg text-gray-600">Pencapaian kinerja keuangan dan operasional</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Total Aset -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition duration-200">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm text-gray-500 mb-2">Total Aset</h3>
                    <p class="text-2xl font-bold text-gray-900 mb-2">{{ $bumdes->formatted_total_aset }}</p>
                    @if($bumdes->aset_growth > 0)
                        <p class="text-sm text-green-600 font-medium">+{{ $bumdes->aset_growth }}%</p>
                    @endif
                </div>

                <!-- Omzet Tahunan -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition duration-200">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm text-gray-500 mb-2">Omzet Tahunan</h3>
                    <p class="text-2xl font-bold text-gray-900 mb-2">{{ $bumdes->formatted_omzet_tahunan }}</p>
                    @if($bumdes->omzet_growth > 0)
                        <p class="text-sm text-green-600 font-medium">+{{ $bumdes->omzet_growth }}%</p>
                    @endif
                </div>

                <!-- Laba Bersih -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition duration-200">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm text-gray-500 mb-2">Laba Bersih</h3>
                    <p class="text-2xl font-bold text-gray-900 mb-2">{{ $bumdes->formatted_laba_bersih }}</p>
                    @if($bumdes->laba_growth > 0)
                        <p class="text-sm text-green-600 font-medium">+{{ $bumdes->laba_growth }}%</p>
                    @endif
                </div>

                <!-- Anggota Aktif -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition duration-200">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm text-gray-500 mb-2">Anggota Aktif</h3>
                    <p class="text-2xl font-bold text-gray-900 mb-2">{{ number_format($bumdes->anggota_aktif) }} orang</p>
                    @if($bumdes->anggota_growth > 0)
                        <p class="text-sm text-green-600 font-medium">+{{ $bumdes->anggota_growth }}%</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Unit Usaha Section -->
    @if($unitUsaha->count() > 0)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Unit Usaha BUMDes</h2>
                    <p class="text-lg text-gray-600">Berbagai bidang usaha yang dikelola BUMDes</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                    @foreach($unitUsaha as $unit)
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 shadow-lg hover:shadow-xl transition duration-200">
                            <div class="flex items-start justify-between mb-4">
                                <h3 class="text-xl font-bold text-gray-900">{{ $unit->nama }}</h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $unit->status_badge_class }}">
                                    {{ ucfirst($unit->status) }}
                                </span>
                            </div>

                            @if($unit->deskripsi)
                                <p class="text-gray-700 mb-4">{{ $unit->deskripsi }}</p>
                            @endif

                            <div class="flex items-center text-blue-600">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold">{{ number_format($unit->jumlah_anggota) }} anggota</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Tim Manajemen Section -->
    @if($timManajemen->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Tim Manajemen</h2>
                    <p class="text-lg text-gray-600">Pengurus dan pengelola BUMDes</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($timManajemen as $tim)
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-200">
                            <div class="p-6 text-center">
                                <div class="w-24 h-24 mx-auto rounded-full overflow-hidden bg-gray-200 mb-4">
                                    <img src="{{ $tim->foto_url }}" alt="{{ $tim->nama }}" class="w-full h-full object-cover">
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $tim->nama }}</h3>
                                <p class="text-green-600 font-semibold mb-3">{{ $tim->jabatan }}</p>

                                @if($tim->pengalaman)
                                    <p class="text-sm text-gray-600 mb-4">{{ $tim->pengalaman }}</p>
                                @endif

                                @if($tim->telepon)
                                    <a href="tel:{{ $tim->telepon }}" class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                        </svg>
                                        {{ $tim->telepon }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Visi Misi Section -->
    @if($bumdes->visi || $bumdes->misi)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Visi & Misi</h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @if($bumdes->visi)
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-8">
                            <h3 class="text-2xl font-bold text-blue-900 mb-4">Visi</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $bumdes->visi }}</p>
                        </div>
                    @endif

                    @if($bumdes->misi)
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-8">
                            <h3 class="text-2xl font-bold text-green-900 mb-4">Misi</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $bumdes->misi }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

@else
    <!-- No Data Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H7m5 0v-5a2 2 0 00-2-2H8a2 2 0 00-2 2v5m5 0V9a2 2 0 012-2h2a2 2 0 012 2v12"></path>
            </svg>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">BUMDes</h1>
            <p class="text-lg text-gray-600">Informasi BUMDes akan segera tersedia</p>
        </div>
    </section>
@endif

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-emerald-500 to-90% via-sky-500 via-30% to-indigo-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">
            Tertarik Bergabung dengan BUMDes?
        </h2>
        <p class="text-xl text-blue-100 mb-8">
            Hubungi tim manajemen untuk informasi lebih lanjut tentang program dan unit usaha BUMDes
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('public.kontak') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-200">
                Hubungi Kami
            </a>
            <a href="{{ route('public.home') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-200">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection
