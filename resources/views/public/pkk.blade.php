@extends('public.layouts.app')

@section('title', 'PKK - Desa Tanjung Selamat')
@section('description', 'Informasi PKK (Pemberdayaan Kesejahteraan Keluarga) Desa Tanjung Selamat')

@section('content')
@if($pkkData)
    @php
        $info = $pkkData['info'];
        $programKerja = $pkkData['program_kerja'];
        $pengurus = $pkkData['pengurus'];
        $kegiatanTerbaru = $pkkData['kegiatan_terbaru'];
    @endphp

    <!-- Hero Section dengan animasi -->
    <section class="bg-gradient-to-r from-pink-500 to-purple-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 animate-fadeInDown">{{ $info->judul }}</h1>
                <p class="text-xl md:text-2xl mb-4 text-pink-100 animate-fadeInUp delay-100">
                    Pemberdayaan Kesejahteraan Keluarga - Menggerakkan dan memberdayakan perempuan untuk meningkatkan kesejahteraan keluarga dan masyarakat
                </p>
                @if($info->slogan)
                    <p class="text-lg text-pink-200 mb-8 animate-fadeInUp delay-200">{{ $info->slogan }}</p>
                @endif
                @if($info->visi)
                    <div class="bg-white/10 rounded-lg p-6 backdrop-blur-sm animate-fadeIn delay-300">
                        <h2 class="text-2xl font-bold mb-4">Visi PKK</h2>
                        <p class="text-lg leading-relaxed">{{ $info->visi }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Statistics Section dengan animasi counter -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center" style="animation-delay: 100ms">
                    <div class="bg-pink-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 delay-150">
                        <svg class="w-10 h-10 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-pink-600 counter" data-target="{{ $info->anggota_aktif }}" data-prefix="" data-suffix="">0</h3>
                    <p class="text-gray-600 animate-fadeIn delay-200">Anggota Aktif</p>
                </div>

                <div class="text-center" style="animation-delay: 200ms">
                    <div class="bg-purple-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 delay-250">
                        <svg class="w-10 h-10 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-purple-600 counter" data-target="{{ $info->program_aktif }}" data-prefix="" data-suffix="">0</h3>
                    <p class="text-gray-600 animate-fadeIn delay-250">Program Aktif</p>
                </div>

                <div class="text-center" style="animation-delay: 300ms">
                    <div class="bg-indigo-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 delay-350">
                        <svg class="w-10 h-10 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-indigo-600 counter" data-target="{{ $info->kegiatan_per_tahun }}" data-prefix="" data-suffix="">0</h3>
                    <p class="text-gray-600 animate-fadeIn delay-350">Kegiatan/Tahun</p>
                </div>

                <div class="text-center" style="animation-delay: 400ms">
                    <div class="bg-teal-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 delay-450">
                        <svg class="w-10 h-10 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-teal-600 counter" data-target="{{ $info->pokja_aktif }}" data-prefix="" data-suffix="">0</h3>
                    <p class="text-gray-600 animate-fadeIn delay-450">Pokja Aktif</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Kerja Section dengan animasi -->
    @if($programKerja->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Program Kerja PKK</h2>
                    <p class="text-lg text-gray-600 animate-slideInUp delay-100">Program-program unggulan PKK Desa Tanjung Selamat</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($programKerja as $index => $program)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 animate-slideInUp hover-scale" style="animation-delay: {{ $index * 100 }}ms">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-{{ $program->color ?? 'blue' }}-100 rounded-lg flex items-center justify-center mr-4 animate-popIn">
                                        <svg class="w-6 h-6 text-{{ $program->color ?? 'blue' }}-600" fill="currentColor" viewBox="0 0 20 20">
                                            @if($program->icon == 'users')
                                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                            @elseif($program->icon == 'heart')
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                            @elseif($program->icon == 'home')
                                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                            @elseif($program->icon == 'star')
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            @elseif($program->icon == 'book')
                                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V4.804z"></path>
                                            @else
                                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                            @endif
                                        </svg>
                                    </div>
                                    <div class="animate-fadeIn delay-150">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $program->nama_program }}</h3>
                                        <p class="text-sm text-{{ $program->color ?? 'blue' }}-600 font-medium">{{ number_format($program->peserta_aktif) }} peserta aktif</p>
                                    </div>
                                </div>

                                <p class="text-gray-600 mb-4 animate-fadeIn delay-200">{{ $program->deskripsi }}</p>

                                @if($program->kegiatan && count($program->kegiatan) > 0)
                                    <div class="space-y-2 animate-fadeIn delay-300">
                                        @foreach($program->kegiatan as $kIndex => $kegiatan)
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 text-{{ $program->color ?? 'blue' }}-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $kegiatan }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Pengurus Section dengan animasi -->
    @if($pengurus->count() > 0)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Pengurus PKK</h2>
                    <p class="text-lg text-gray-600 animate-slideInUp delay-100">Struktur kepengurusan PKK Desa Tanjung Selamat</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($pengurus as $index => $anggota)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 animate-fadeIn hover-scale" style="animation-delay: {{ $index * 100 }}ms">
                            <div class="aspect-w-3 aspect-h-4">
                                <img src="{{ $anggota->foto_url }}" alt="{{ $anggota->nama }}" class="w-full h-64 object-cover transition-transform duration-300">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 animate-fadeIn delay-150">{{ $anggota->nama }}</h3>
                                <p class="text-pink-600 font-medium mb-2 animate-fadeIn delay-200">{{ $anggota->jabatan }}</p>

                                @if($anggota->deskripsi)
                                    <p class="text-gray-600 text-sm mb-4 animate-fadeIn delay-250">{{ $anggota->deskripsi }}</p>
                                @endif

                                @if($anggota->telepon)
                                    <div class="flex items-center text-sm text-gray-600 mb-2 animate-fadeIn delay-300">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                        </svg>
                                        {{ $anggota->telepon }}
                                    </div>
                                @endif

                                @if($anggota->email)
                                    <div class="flex items-center text-sm text-gray-600 animate-fadeIn delay-350">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                        </svg>
                                        {{ $anggota->email }}
                                    </div>
                                @endif

                                @if($anggota->telepon && $anggota->getWhatsAppUrl())
                                    <div class="mt-4 animate-fadeIn delay-400">
                                        <a href="{{ $anggota->getWhatsAppUrl() }}" target="_blank"
                                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 hover-scale">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                            </svg>
                                            WhatsApp
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Kegiatan Terbaru Section dengan animasi -->
    @if($kegiatanTerbaru->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-slideInUp">Kegiatan Terbaru</h2>
                    <p class="text-lg text-gray-600 animate-slideInUp delay-100">Kegiatan-kegiatan terbaru PKK Desa Tanjung Selamat</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($kegiatanTerbaru as $index => $kegiatan)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 animate-slideInUp hover-scale" style="animation-delay: {{ $index * 100 }}ms">
                            @if($kegiatan->foto_url)
                                <div class="aspect-w-16 aspect-h-9">
                                    <img src="{{ $kegiatan->foto_url }}" alt="{{ $kegiatan->nama_kegiatan }}" class="w-full h-48 object-cover transition-transform duration-300">
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4 animate-fadeIn delay-150">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $kegiatan->getStatusBadge()['class'] }}">
                                        {{ $kegiatan->getStatusBadge()['text'] }}
                                    </span>
                                    <span class="text-sm text-gray-500">{{ $kegiatan->getFormattedTanggal() }}</span>
                                </div>

                                <h3 class="text-xl font-bold text-gray-900 mb-2 animate-fadeIn delay-200">{{ $kegiatan->nama_kegiatan }}</h3>
                                <p class="text-gray-600 mb-4 animate-fadeIn delay-250">{{ $kegiatan->getExcerpt(120) }}</p>

                                <div class="space-y-2 text-sm text-gray-600 animate-fadeIn delay-300">
                                    @if($kegiatan->waktu)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $kegiatan->getFormattedWaktu() }}
                                        </div>
                                    @endif

                                    @if($kegiatan->lokasi)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $kegiatan->lokasi }}
                                        </div>
                                    @endif

                                    @if($kegiatan->jumlah_peserta)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                            </svg>
                                            {{ number_format($kegiatan->jumlah_peserta) }} peserta
                                        </div>
                                    @endif

                                    @if($kegiatan->penanggung_jawab)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $kegiatan->penanggung_jawab }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@else
    <!-- No Data Section dengan animasi -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-white rounded-lg shadow-lg p-12 animate-popIn">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 animate-fadeIn">Data PKK Belum Tersedia</h3>
                <p class="text-gray-600 mb-6 animate-fadeIn delay-100">Informasi tentang PKK Desa Tanjung Selamat sedang dalam proses pembaruan.</p>
                <a href="{{ route('public.home') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 animate-fadeIn delay-200 hover-scale">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>
@endif

<!-- Custom CSS for Animations -->
<style>
    /* Animations - hanya aktif ketika memiliki kelas 'animated' */
    .animate-fadeInDown {
        opacity: 0;
        transform: translateY(-20px);
    }

    .animate-fadeInUp {
        opacity: 0;
        transform: translateY(20px);
    }

    .animate-fadeIn {
        opacity: 0;
    }

    .animate-slideInLeft {
        opacity: 0;
        transform: translateX(-50px);
    }

    .animate-slideInRight {
        opacity: 0;
        transform: translateX(50px);
    }

    .animate-slideInUp {
        opacity: 0;
        transform: translateY(50px);
    }

    .animate-popIn {
        opacity: 0;
        transform: scale(0.8);
    }

    .animate-bounce {
        animation: bounce 1s infinite;
    }

    /* Animasi saat elemen muncul */
    .animate-fadeInDown.animated {
        animation: fadeInDown 0.8s ease-out forwards;
    }

    .animate-fadeInUp.animated {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-fadeIn.animated {
        animation: fadeIn 1s ease-out forwards;
    }

    .animate-slideInLeft.animated {
        animation: slideInLeft 0.8s ease-out forwards;
    }

    .animate-slideInRight.animated {
        animation: slideInRight 0.8s ease-out forwards;
    }

    .animate-slideInUp.animated {
        animation: slideInUp 0.8s ease-out forwards;
    }

    .animate-popIn.animated {
        animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    /* Efek hover scale */
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-scale:hover {
        transform: scale(1.03);
    }

    /* Keyframes untuk animasi */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes popIn {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        70% {
            opacity: 1;
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-15px);
        }
    }

    /* Animation Delays */
    .delay-50 { animation-delay: 50ms !important; }
    .delay-100 { animation-delay: 100ms !important; }
    .delay-150 { animation-delay: 150ms !important; }
    .delay-200 { animation-delay: 200ms !important; }
    .delay-250 { animation-delay: 250ms !important; }
    .delay-300 { animation-delay: 300ms !important; }
    .delay-350 { animation-delay: 350ms !important; }
    .delay-400 { animation-delay: 400ms !important; }
    .delay-450 { animation-delay: 450ms !important; }
</style>

<!-- JavaScript for Scroll Trigger Animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk animasi counter
    function animateCounters() {
        const counters = document.querySelectorAll('.counter');
        const speed = 200; // Durasi animasi dalam ms
        const options = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = +entry.target.getAttribute('data-target');
                    const prefix = entry.target.getAttribute('data-prefix') || '';
                    const suffix = entry.target.getAttribute('data-suffix') || '';
                    const count = entry.target;
                    const increment = target / speed;

                    let current = 0;

                    const updateCounter = () => {
                        current += increment;
                        if (current < target) {
                            count.textContent = prefix + Math.floor(current).toLocaleString('id-ID') + suffix;
                            setTimeout(updateCounter, 1);
                        } else {
                            count.textContent = prefix + target.toLocaleString('id-ID') + suffix;
                        }
                    };

                    updateCounter();
                    observer.unobserve(entry.target);
                }
            });
        }, options);

        counters.forEach(counter => {
            observer.observe(counter);
        });
    }

    // Fungsi untuk mengatur animasi saat scroll
    function setupScrollAnimations() {
        // Ambil semua elemen yang memiliki kelas animasi
        const animatedElements = document.querySelectorAll(
            '[class*="animate-"]'
        );

        // Buat Intersection Observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Tambahkan kelas 'animated' untuk memicu animasi
                    const element = entry.target;

                    // Handle delay inline style
                    let delay = element.style.animationDelay || '0ms';
                    delay = parseInt(delay) || 0;

                    setTimeout(() => {
                        element.classList.add('animated');

                        // Jika elemen adalah counter, jalankan animasi counter
                        if (element.classList.contains('counter')) {
                            animateCounters();
                        }
                    }, delay);

                    // Stop observing setelah animasi dipicu
                    observer.unobserve(element);
                }
            });
        }, {
            threshold: 0.1, // Trigger ketika 10% elemen terlihat
            rootMargin: '0px 0px -50px 0px' // Adjust untuk trigger lebih awal
        });

        // Observe semua elemen animasi
        animatedElements.forEach(el => {
            observer.observe(el);
        });
    }

    // Panggil fungsi setup
    setupScrollAnimations();
    animateCounters();
});
</script>

@endsection
