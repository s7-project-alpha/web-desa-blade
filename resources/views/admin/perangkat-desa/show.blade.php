@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Detail Perangkat Desa</h1>
        <p class="text-gray-600">Detail informasi {{ $perangkatDesa->nama }}</p>
    </div>
    <div class="flex space-x-2">
        <a href="{{ route('admin.perangkat-desa.edit', $perangkatDesa) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
            </svg>
            Edit
        </a>
        <a href="{{ route('admin.perangkat-desa.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
            </svg>
            Kembali
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Profile Card -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="text-center">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden bg-gray-200 mb-4">
                    <img src="{{ $perangkatDesa->foto_url }}" alt="{{ $perangkatDesa->nama }}" class="w-full h-full object-cover">
                </div>
                <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $perangkatDesa->nama }}</h2>
                <p class="text-gray-600 mb-2">{{ $perangkatDesa->jabatan }}</p>
                @if($perangkatDesa->periode)
                    <p class="text-sm text-gray-500 mb-4">{{ $perangkatDesa->periode }}</p>
                @endif

                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    @if($perangkatDesa->kategori === 'kepala_desa') bg-purple-100 text-purple-800
                    @elseif($perangkatDesa->kategori === 'perangkat_desa') bg-blue-100 text-blue-800
                    @elseif($perangkatDesa->kategori === 'kepala_dusun') bg-green-100 text-green-800
                    @else bg-yellow-100 text-yellow-800
                    @endif">
                    {{ App\Models\PerangkatDesa::getKategoriOptions()[$perangkatDesa->kategori] }}
                </span>

                <div class="mt-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $perangkatDesa->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $perangkatDesa->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Details -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Contact Information -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kontak</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($perangkatDesa->telepon)
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Telepon</p>
                            <p class="text-gray-900">{{ $perangkatDesa->telepon }}</p>
                        </div>
                    </div>
                @endif

                @if($perangkatDesa->email)
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="text-gray-900">{{ $perangkatDesa->email }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if($perangkatDesa->kategori === 'kepala_dusun' && ($perangkatDesa->dusun || $perangkatDesa->rt_rw))
            <!-- Dusun Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dusun</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($perangkatDesa->dusun)
                        <div>
                            <p class="text-sm text-gray-500">Nama Dusun</p>
                            <p class="text-gray-900">{{ $perangkatDesa->dusun }}</p>
                        </div>
                    @endif

                    @if($perangkatDesa->rt_rw)
                        <div>
                            <p class="text-sm text-gray-500">RT/RW</p>
                            <p class="text-gray-900">{{ $perangkatDesa->rt_rw }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        @if($perangkatDesa->pendidikan)
            <!-- Education -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pendidikan</h3>
                <div class="text-gray-700 whitespace-pre-line">{{ $perangkatDesa->pendidikan }}</div>
            </div>
        @endif

        @if($perangkatDesa->kategori === 'kepala_desa' && $perangkatDesa->visi)
            <!-- Vision -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Visi</h3>
                <div class="text-gray-700 whitespace-pre-line">{{ $perangkatDesa->visi }}</div>
            </div>
        @endif

        @if($perangkatDesa->tugas_tanggung_jawab)
            <!-- Responsibilities -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Tugas & Tanggung Jawab</h3>
                <div class="space-y-2">
                    @foreach($perangkatDesa->tugas_array as $tugas)
                        @if(trim($tugas))
                            <div class="flex items-start">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                <span class="text-gray-700">{{ trim($tugas) }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Meta Information -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Sistem</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Urutan Tampil</p>
                    <p class="text-gray-900">{{ $perangkatDesa->urutan }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Dibuat</p>
                    <p class="text-gray-900">{{ $perangkatDesa->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Terakhir Diupdate</p>
                    <p class="text-gray-900">{{ $perangkatDesa->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
