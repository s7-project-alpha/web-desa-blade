@extends('public.layouts.app')

@section('title', 'Perangkat Desa - Desa Tanjung Selamat')
@section('description', 'Struktur organisasi dan perangkat desa Tanjung Selamat, kepala desa, sekretaris, bendahara, kepala dusun, dan BPD')

@section('content')
<!-- Header Section -->
<section class="bg-gradient-to-r from-emerald-500 to-90% via-sky-500 via-30% to-indigo-500 from-10% text-white py-16">
    <div class="flex flex-col items-center justify-center min-h-[196px] mx-auto px-8 sm:px-6 lg:px-10">
        <div class="text-center max-w-3xl w-full">
            <h1 class="text-5xl md:text-5xl font-bold mb-4">Perangkat Desa</h1>
            <p class="text-2xl text-blue-100">Struktur Organisasi Pemerintahan Desa Tanjung Selamat</p>
        </div>
    </div>
</section>

@php
    $perangkatData = \App\Models\PerangkatDesa::getAllForPublic();
@endphp

<!-- Kepala Desa Section -->
@if($perangkatData['kepala_desa'])
    @php $kepala = $perangkatData['kepala_desa']; @endphp
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Kepala Desa</h2>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 shadow-lg">
                    <div class="flex flex-col lg:flex-row items-center lg:items-start space-y-6 lg:space-y-0 lg:space-x-8">
                        <div class="flex-shrink-0">
                            <div class="w-48 h-48 rounded-full overflow-hidden bg-gray-200 shadow-lg">
                                <img src="{{ $kepala->foto_url }}" alt="{{ $kepala->nama }}" class="w-full h-full object-cover">
                            </div>
                        </div>

                        <div class="flex-1 text-center lg:text-left">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $kepala->nama }}</h3>
                            <p class="text-lg text-blue-600 font-semibold mb-2">{{ $kepala->jabatan }}</p>
                            @if($kepala->periode)
                                <p class="text-gray-600 mb-4">Periode: {{ $kepala->periode }}</p>
                            @endif

                            @if($kepala->pendidikan)
                                <div class="mb-4">
                                    <h4 class="font-semibold text-gray-900 mb-2">Pendidikan:</h4>
                                    <p class="text-gray-700 whitespace-pre-line">{{ $kepala->pendidikan }}</p>
                                </div>
                            @endif

                            @if($kepala->visi)
                                <div class="mb-4">
                                    <h4 class="font-semibold text-gray-900 mb-2">Visi:</h4>
                                    <p class="text-gray-700 italic whitespace-pre-line">{{ $kepala->visi }}</p>
                                </div>
                            @endif

                            <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                                @if($kepala->telepon)
                                    <a href="tel:{{ $kepala->telepon }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                        </svg>
                                        {{ $kepala->telepon }}
                                    </a>
                                @endif

                                @if($kepala->email)
                                    <a href="mailto:{{ $kepala->email }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                        </svg>
                                        {{ $kepala->email }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<!-- Perangkat Desa Section -->
@if($perangkatData['perangkat_desa']->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Perangkat Desa</h2>
                <p class="text-lg text-gray-600">Tim kerja pemerintahan desa</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($perangkatData['perangkat_desa'] as $perangkat)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-200">
                        <div class="p-6 text-center">
                            <div class="w-24 h-24 mx-auto rounded-full overflow-hidden bg-gray-200 mb-4">
                                <img src="{{ $perangkat->foto_url }}" alt="{{ $perangkat->nama }}" class="w-full h-full object-cover">
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $perangkat->nama }}</h3>
                            <p class="text-blue-600 font-semibold mb-4">{{ $perangkat->jabatan }}</p>

                            @if($perangkat->tugas_array)
                                <div class="mb-4 text-left">
                                    <h4 class="font-semibold text-gray-900 mb-2 text-center">Tugas & Tanggung Jawab:</h4>
                                    <ul class="text-sm text-gray-600 space-y-1">
                                        @foreach(array_slice($perangkat->tugas_array, 0, 3) as $tugas)
                                            @if(trim($tugas))
                                                <li class="flex items-start">
                                                    <span class="w-1.5 h-1.5 bg-gray-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                                                    <span>{{ trim($tugas) }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="flex flex-col gap-2">
                                @if($perangkat->telepon)
                                    <a href="tel:{{ $perangkat->telepon }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-phone mr-1"></i>{{ $perangkat->telepon }}
                                    </a>
                                @endif

                                @if($perangkat->email)
                                    <a href="mailto:{{ $perangkat->email }}" class="text-sm text-gray-600 hover:text-gray-800 break-all">
                                        <i class="fas fa-envelope mr-1"></i>{{ $perangkat->email }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Kepala Dusun Section -->
@if($perangkatData['kepala_dusun']->count() > 0)
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Kepala Dusun</h2>
                <p class="text-lg text-gray-600">Pemimpin di tingkat dusun</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($perangkatData['kepala_dusun'] as $kepala)
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6 shadow-lg hover:shadow-xl transition duration-200">
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto rounded-full overflow-hidden bg-gray-200 mb-4">
                                <img src="{{ $kepala->foto_url }}" alt="{{ $kepala->nama }}" class="w-full h-full object-cover">
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $kepala->nama }}</h3>
                            @if($kepala->dusun)
                                <p class="text-green-600 font-semibold mb-2">{{ $kepala->dusun }}</p>
                            @endif
                            @if($kepala->rt_rw)
                                <p class="text-sm text-gray-600 mb-4">{{ $kepala->rt_rw }}</p>
                            @endif

                            @if($kepala->telepon)
                                <a href="tel:{{ $kepala->telepon }}" class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition duration-200">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                    </svg>
                                    {{ $kepala->telepon }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- BPD Section -->
@if($perangkatData['bpd']->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Badan Permusyawaratan Desa (BPD)</h2>
                <p class="text-lg text-gray-600">Lembaga legislatif desa yang mengayomi adat istiadat</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($perangkatData['bpd'] as $anggota)
                    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-200">
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto rounded-full overflow-hidden bg-gray-200 mb-4">
                                <img src="{{ $anggota->foto_url }}" alt="{{ $anggota->nama }}" class="w-full h-full object-cover">
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $anggota->nama }}</h3>
                            <p class="text-yellow-600 font-semibold mb-4">{{ $anggota->jabatan }}</p>

                            @if($anggota->telepon)
                                <a href="tel:{{ $anggota->telepon }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                                    {{ $anggota->telepon }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Contact CTA Section -->
<section class="py-16 bg-gradient-to-r from-emerald-500 to-90% via-sky-500 via-30% to-indigo-500 from-10%">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">
            Butuh Bantuan atau Informasi?
        </h2>
        <p class="text-xl text-blue-100 mb-8">
            Hubungi perangkat desa untuk mendapat pelayanan terbaik
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('public.kontak') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-200">
                Kontak Kantor Desa
            </a>
            <a href="{{ route('public.home') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-200">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection
