@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <a href="{{ route('admin.visi-misi.index') }}" class="text-blue-600 hover:text-blue-800 mr-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Visi, Misi & Nilai Dasar</h1>
                <p class="text-gray-600">Periode {{ $visiMisi->periode }}</p>
            </div>
        </div>
        <div class="flex space-x-3">
            @if($visiMisi->is_active)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 8 8">
                        <circle cx="4" cy="4" r="3"/>
                    </svg>
                    Aktif
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 8 8">
                        <circle cx="4" cy="4" r="3"/>
                    </svg>
                    Tidak Aktif
                </span>
            @endif
            <a href="{{ route('admin.visi-misi.edit', $visiMisi) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
        </div>
    </div>
</div>

<div class="space-y-6">
    <!-- Visi Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-900">Visi</h2>
        </div>
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
            <p class="text-gray-900 leading-relaxed">{{ $visiMisi->visi }}</p>
        </div>
    </div>

    <!-- Misi Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-900">Misi</h2>
        </div>
        <div class="space-y-3">
            @foreach($visiMisi->misi_array as $index => $misi)
                @if(trim($misi))
                    <div class="flex items-start">
                        <span class="flex-shrink-0 w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm font-medium mr-3">
                            {{ $index + 1 }}
                        </span>
                        <p class="text-gray-900 leading-relaxed">{{ trim($misi) }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    @if($visiMisi->nilai_dasar)
    <!-- Nilai Dasar Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-900">Nilai Dasar</h2>
        </div>
        <div class="space-y-3">
            @foreach($visiMisi->nilai_dasar_array as $index => $nilai)
                @if(trim($nilai))
                    <div class="flex items-start">
                        <span class="flex-shrink-0 w-6 h-6 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-sm font-medium mr-3">
                            {{ $index + 1 }}
                        </span>
                        <p class="text-gray-900 leading-relaxed">{{ trim($nilai) }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    @if($visiMisi->tujuan || $visiMisi->sasaran)
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @if($visiMisi->tujuan)
        <!-- Tujuan Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">Tujuan</h2>
            </div>
            <div class="space-y-3">
                @foreach($visiMisi->tujuan_array as $index => $tujuan)
                    @if(trim($tujuan))
                        <div class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-sm font-medium mr-3">
                                {{ $index + 1 }}
                            </span>
                            <p class="text-gray-900 leading-relaxed">{{ trim($tujuan) }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        @if($visiMisi->sasaran)
        <!-- Sasaran Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">Sasaran</h2>
            </div>
            <div class="space-y-3">
                @foreach($visiMisi->sasaran_array as $index => $sasaran)
                    @if(trim($sasaran))
                        <div class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-sm font-medium mr-3">
                                {{ $index + 1 }}
                            </span>
                            <p class="text-gray-900 leading-relaxed">{{ trim($sasaran) }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif
    </div>
    @endif

    <!-- Meta Information -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <span class="text-sm text-gray-500">Periode</span>
                <p class="font-medium text-gray-900">{{ $visiMisi->periode }}</p>
            </div>
            <div>
                <span class="text-sm text-gray-500">Tanggal Dibuat</span>
                <p class="font-medium text-gray-900">{{ $visiMisi->created_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <span class="text-sm text-gray-500">Terakhir Diperbarui</span>
                <p class="font-medium text-gray-900">{{ $visiMisi->updated_at->format('d M Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
