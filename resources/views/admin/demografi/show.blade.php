@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Data Demografi</h1>
                <p class="text-gray-600">Data kependudukan tahun {{ $demografi->tahun }}</p>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:ml-auto">
            @if($demografi->is_active)
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
            <a href="{{ route('admin.demografi.edit', $demografi) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200 text-center">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
            <a href="{{ route('admin.demografi.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200 text-center">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>
</div>

<div class="space-y-6">
    <!-- Data Umum -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-900">Data Umum</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-blue-50 rounded-lg p-4">
                <p class="text-sm font-medium text-blue-600">Total Penduduk</p>
                <p class="text-2xl font-bold text-blue-900">{{ number_format($demografi->total_penduduk) }}</p>
                <p class="text-xs text-blue-500">jiwa</p>
            </div>

            <div class="bg-green-50 rounded-lg p-4">
                <p class="text-sm font-medium text-green-600">Kepala Keluarga</p>
                <p class="text-2xl font-bold text-green-900">{{ number_format($demografi->total_kepala_keluarga) }}</p>
                <p class="text-xs text-green-500">{{ $demografi->rata_rata_anggota_kk }} jiwa/KK</p>
            </div>

            <div class="bg-yellow-50 rounded-lg p-4">
                <p class="text-sm font-medium text-yellow-600">Luas Wilayah</p>
                <p class="text-2xl font-bold text-yellow-900">{{ $demografi->luas_wilayah }}</p>
                <p class="text-xs text-yellow-500">KM² ({{ $demografi->kepadatan_penduduk }}/KM²)</p>
            </div>

            <div class="bg-purple-50 rounded-lg p-4">
                <p class="text-sm font-medium text-purple-600">Angka Harapan Hidup</p>
                <p class="text-2xl font-bold text-purple-900">{{ $demografi->angka_harapan_hidup }}</p>
                <p class="text-xs text-purple-500">tahun</p>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Gender Distribution -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="font-medium text-gray-900 mb-3">Komposisi Gender</h4>
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-blue-600 flex items-center">
                            <span class="text-lg mr-2">♂</span> Laki-laki
                        </span>
                        <span class="font-medium">{{ number_format($demografi->total_laki_laki) }} ({{ $demografi->persentase_laki_laki }}%)</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-pink-600 flex items-center">
                            <span class="text-lg mr-2">♀</span> Perempuan
                        </span>
                        <span class="font-medium">{{ number_format($demografi->total_perempuan) }} ({{ $demografi->persentase_perempuan }}%)</span>
                    </div>
                    <div class="pt-2 border-t">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Rasio Jenis Kelamin</span>
                            <span class="font-medium">{{ $demografi->rasio_jenis_kelamin }}/100</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wilayah Administrative -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="font-medium text-gray-900 mb-3">Wilayah Administratif</h4>
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Jumlah Dusun</span>
                        <span class="font-medium">{{ $demografi->jumlah_dusun }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Jumlah RW</span>
                        <span class="font-medium">{{ $demografi->jumlah_rw }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Jumlah RT</span>
                        <span class="font-medium">{{ $demografi->jumlah_rt }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Distribusi Usia -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-900">Distribusi Usia</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($demografi->distribusi_usia_label as $usia => $jumlah)
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 border border-green-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-sm font-medium text-gray-700">{{ $usia }}</h4>
                            <p class="text-xl font-bold text-green-700">{{ number_format($jumlah) }}</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-green-600 bg-green-200 px-2 py-1 rounded-full">
                                {{ $demografi->total_penduduk > 0 ? round(($jumlah / $demografi->total_penduduk) * 100, 1) : 0 }}%
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Tingkat Pendidikan -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-900">Tingkat Pendidikan</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @php $totalPendidikan = array_sum($demografi->tingkat_pendidikan); @endphp
            @foreach($demografi->tingkat_pendidikan_label as $pendidikan => $jumlah)
                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg p-4 border border-yellow-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-sm font-medium text-gray-700">{{ $pendidikan }}</h4>
                            <p class="text-xl font-bold text-yellow-700">{{ number_format($jumlah) }}</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-yellow-600 bg-yellow-200 px-2 py-1 rounded-full">
                                {{ $totalPendidikan > 0 ? round(($jumlah / $totalPendidikan) * 100, 1) : 0 }}%
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Mata Pencaharian -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-900">Mata Pencaharian</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @php $totalPekerjaan = array_sum($demografi->mata_pencaharian); @endphp
            @foreach($demografi->mata_pencaharian_label as $pekerjaan => $jumlah)
                @if($jumlah > 0)
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 border border-purple-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-700">{{ $pekerjaan }}</h4>
                                <p class="text-lg font-bold text-purple-700">{{ number_format($jumlah) }}</p>
                            </div>
                            <div class="text-right">
                                <span class="text-xs text-purple-600 bg-purple-200 px-2 py-1 rounded-full">
                                    {{ $totalPekerjaan > 0 ? round(($jumlah / $totalPekerjaan) * 100, 1) : 0 }}%
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Agama dan Status Perkawinan -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Agama -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">Agama</h2>
            </div>

            <div class="space-y-3">
                @php $totalAgama = array_sum($demografi->agama); @endphp
                @foreach($demografi->agama as $agama => $jumlah)
                    @if($jumlah > 0)
                        <div class="flex items-center justify-between p-3 bg-indigo-50 rounded-lg">
                            <span class="font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $agama) }}</span>
                            <div class="text-right">
                                <span class="font-bold text-indigo-700">{{ number_format($jumlah) }}</span>
                                <span class="text-xs text-indigo-600 ml-2">
                                    ({{ $totalAgama > 0 ? round(($jumlah / $totalAgama) * 100, 1) : 0 }}%)
                                </span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Status Perkawinan -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-6 h-6 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">Status Perkawinan</h2>
            </div>

            <div class="space-y-3">
                @php $totalPerkawinan = array_sum($demografi->status_perkawinan); @endphp
                @foreach($demografi->status_perkawinan as $status => $jumlah)
                    @if($jumlah > 0)
                        <div class="flex items-center justify-between p-3 bg-pink-50 rounded-lg">
                            <span class="font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $status) }}</span>
                            <div class="text-right">
                                <span class="font-bold text-pink-700">{{ number_format($jumlah) }}</span>
                                <span class="text-xs text-pink-600 ml-2">
                                    ({{ $totalPerkawinan > 0 ? round(($jumlah / $totalPerkawinan) * 100, 1) : 0 }}%)
                                </span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    @if($demografi->keterangan)
    <!-- Keterangan -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-900">Keterangan</h2>
        </div>
        <div class="bg-gray-50 rounded-lg p-4">
            <p class="text-gray-700 leading-relaxed">{{ $demografi->keterangan }}</p>
        </div>
    </div>
    @endif

    <!-- Meta Information -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Data</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <span class="text-sm text-gray-500">Tahun Data</span>
                <p class="font-medium text-gray-900">{{ $demografi->tahun }}</p>
            </div>
            <div>
                <span class="text-sm text-gray-500">Tanggal Dibuat</span>
                <p class="font-medium text-gray-900">{{ $demografi->created_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <span class="text-sm text-gray-500">Terakhir Diperbarui</span>
                <p class="font-medium text-gray-900">{{ $demografi->updated_at->format('d M Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
