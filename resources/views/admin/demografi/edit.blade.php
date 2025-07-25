@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Data Demografi</h1>
            <p class="text-gray-600">Edit data kependudukan tahun {{ $demografi->tahun }}</p>
        </div>
         <a href="{{ route('admin.demografi.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
            </svg>
            Kembali
        </a>
    </div>
</div>

<!-- Error Messages -->
@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.demografi.update', $demografi) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Data Umum -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Data Umum</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun Data</label>
                <input type="number" name="tahun" id="tahun"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="{{ date('Y') }}" value="{{ old('tahun', $demografi->tahun) }}" required>
            </div>

            <div>
                <label for="total_penduduk" class="block text-sm font-medium text-gray-700 mb-2">Total Penduduk</label>
                <input type="number" name="total_penduduk" id="total_penduduk"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('total_penduduk', $demografi->total_penduduk) }}" required>
            </div>

            <div>
                <label for="total_kepala_keluarga" class="block text-sm font-medium text-gray-700 mb-2">Total Kepala Keluarga</label>
                <input type="number" name="total_kepala_keluarga" id="total_kepala_keluarga"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('total_kepala_keluarga', $demografi->total_kepala_keluarga) }}" required>
            </div>

            <div>
                <label for="total_laki_laki" class="block text-sm font-medium text-gray-700 mb-2">Total Laki-laki</label>
                <input type="number" name="total_laki_laki" id="total_laki_laki"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('total_laki_laki', $demografi->total_laki_laki) }}" required>
            </div>

            <div>
                <label for="total_perempuan" class="block text-sm font-medium text-gray-700 mb-2">Total Perempuan</label>
                <input type="number" name="total_perempuan" id="total_perempuan"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('total_perempuan', $demografi->total_perempuan) }}" required>
            </div>

            <div>
                <label for="luas_wilayah" class="block text-sm font-medium text-gray-700 mb-2">Luas Wilayah (KM²)</label>
                <input type="number" name="luas_wilayah" id="luas_wilayah" step="0.01"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0.00" value="{{ old('luas_wilayah', $demografi->luas_wilayah) }}" required>
            </div>

            <div>
                <label for="angka_harapan_hidup" class="block text-sm font-medium text-gray-700 mb-2">Angka Harapan Hidup</label>
                <input type="number" name="angka_harapan_hidup" id="angka_harapan_hidup" step="0.01"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="70.50" value="{{ old('angka_harapan_hidup', $demografi->angka_harapan_hidup) }}" required>
            </div>

            <div>
                <label for="jumlah_dusun" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Dusun</label>
                <input type="number" name="jumlah_dusun" id="jumlah_dusun"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('jumlah_dusun', $demografi->jumlah_dusun) }}" required>
            </div>

            <div>
                <label for="jumlah_rt" class="block text-sm font-medium text-gray-700 mb-2">Jumlah RT</label>
                <input type="number" name="jumlah_rt" id="jumlah_rt"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('jumlah_rt', $demografi->jumlah_rt) }}" required>
            </div>

            <div>
                <label for="jumlah_rw" class="block text-sm font-medium text-gray-700 mb-2">Jumlah RW</label>
                <input type="number" name="jumlah_rw" id="jumlah_rw"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('jumlah_rw', $demografi->jumlah_rw) }}" required>
            </div>
        </div>
    </div>

    <!-- Distribusi Usia -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Distribusi Usia</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="usia_0_5" class="block text-sm font-medium text-gray-700 mb-2">0-5 Tahun</label>
                <input type="number" name="usia_0_5" id="usia_0_5"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('usia_0_5', $demografi->distribusi_usia['0_5'] ?? 0) }}">
            </div>
            <div>
                <label for="usia_6_12" class="block text-sm font-medium text-gray-700 mb-2">6-12 Tahun</label>
                <input type="number" name="usia_6_12" id="usia_6_12"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('usia_6_12', $demografi->distribusi_usia['6_12'] ?? 0) }}">
            </div>
            <div>
                <label for="usia_13_17" class="block text-sm font-medium text-gray-700 mb-2">13-17 Tahun</label>
                <input type="number" name="usia_13_17" id="usia_13_17"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('usia_13_17', $demografi->distribusi_usia['13_17'] ?? 0) }}">
            </div>
            <div>
                <label for="usia_18_25" class="block text-sm font-medium text-gray-700 mb-2">18-25 Tahun</label>
                <input type="number" name="usia_18_25" id="usia_18_25"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('usia_18_25', $demografi->distribusi_usia['18_25'] ?? 0) }}">
            </div>
            <div>
                <label for="usia_26_35" class="block text-sm font-medium text-gray-700 mb-2">26-35 Tahun</label>
                <input type="number" name="usia_26_35" id="usia_26_35"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('usia_26_35', $demografi->distribusi_usia['26_35'] ?? 0) }}">
            </div>
            <div>
                <label for="usia_36_45" class="block text-sm font-medium text-gray-700 mb-2">36-45 Tahun</label>
                <input type="number" name="usia_36_45" id="usia_36_45"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('usia_36_45', $demografi->distribusi_usia['36_45'] ?? 0) }}">
            </div>
            <div>
                <label for="usia_46_55" class="block text-sm font-medium text-gray-700 mb-2">46-55 Tahun</label>
                <input type="number" name="usia_46_55" id="usia_46_55"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('usia_46_55', $demografi->distribusi_usia['46_55'] ?? 0) }}">
            </div>
            <div>
                <label for="usia_56_65" class="block text-sm font-medium text-gray-700 mb-2">56-65 Tahun</label>
                <input type="number" name="usia_56_65" id="usia_56_65"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('usia_56_65', $demografi->distribusi_usia['56_65'] ?? 0) }}">
            </div>
            <div>
                <label for="usia_65_plus" class="block text-sm font-medium text-gray-700 mb-2">65+ Tahun</label>
                <input type="number" name="usia_65_plus" id="usia_65_plus"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('usia_65_plus', $demografi->distribusi_usia['65_plus'] ?? 0) }}">
            </div>
        </div>
    </div>

    <!-- Tingkat Pendidikan -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Tingkat Pendidikan</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="pendidikan_tidak_sekolah" class="block text-sm font-medium text-gray-700 mb-2">Tidak Sekolah</label>
                <input type="number" name="pendidikan_tidak_sekolah" id="pendidikan_tidak_sekolah"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pendidikan_tidak_sekolah', $demografi->tingkat_pendidikan['tidak_sekolah'] ?? 0) }}">
            </div>
            <div>
                <label for="pendidikan_belum_tamat_sd" class="block text-sm font-medium text-gray-700 mb-2">Belum Tamat SD</label>
                <input type="number" name="pendidikan_belum_tamat_sd" id="pendidikan_belum_tamat_sd"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pendidikan_belum_tamat_sd', $demografi->tingkat_pendidikan['belum_tamat_sd'] ?? 0) }}">
            </div>
            <div>
                <label for="pendidikan_sd" class="block text-sm font-medium text-gray-700 mb-2">SD/Sederajat</label>
                <input type="number" name="pendidikan_sd" id="pendidikan_sd"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pendidikan_sd', $demografi->tingkat_pendidikan['sd'] ?? 0) }}">
            </div>
            <div>
                <label for="pendidikan_smp" class="block text-sm font-medium text-gray-700 mb-2">SMP/Sederajat</label>
                <input type="number" name="pendidikan_smp" id="pendidikan_smp"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pendidikan_smp', $demografi->tingkat_pendidikan['smp'] ?? 0) }}">
            </div>
            <div>
                <label for="pendidikan_sma" class="block text-sm font-medium text-gray-700 mb-2">SMA/Sederajat</label>
                <input type="number" name="pendidikan_sma" id="pendidikan_sma"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pendidikan_sma', $demografi->tingkat_pendidikan['sma'] ?? 0) }}">
            </div>
            <div>
                <label for="pendidikan_diploma" class="block text-sm font-medium text-gray-700 mb-2">Diploma</label>
                <input type="number" name="pendidikan_diploma" id="pendidikan_diploma"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pendidikan_diploma', $demografi->tingkat_pendidikan['diploma'] ?? 0) }}">
            </div>
            <div>
                <label for="pendidikan_s1" class="block text-sm font-medium text-gray-700 mb-2">S1</label>
                <input type="number" name="pendidikan_s1" id="pendidikan_s1"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pendidikan_s1', $demografi->tingkat_pendidikan['s1'] ?? 0) }}">
            </div>
            <div>
                <label for="pendidikan_s2" class="block text-sm font-medium text-gray-700 mb-2">S2</label>
                <input type="number" name="pendidikan_s2" id="pendidikan_s2"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pendidikan_s2', $demografi->tingkat_pendidikan['s2'] ?? 0) }}">
            </div>
            <div>
                <label for="pendidikan_s3" class="block text-sm font-medium text-gray-700 mb-2">S3</label>
                <input type="number" name="pendidikan_s3" id="pendidikan_s3"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pendidikan_s3', $demografi->tingkat_pendidikan['s3'] ?? 0) }}">
            </div>
        </div>
    </div>

    <!-- Mata Pencaharian -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Mata Pencaharian</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="pekerjaan_petani" class="block text-sm font-medium text-gray-700 mb-2">Petani</label>
                <input type="number" name="pekerjaan_petani" id="pekerjaan_petani"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pekerjaan_petani', $demografi->mata_pencaharian['petani'] ?? 0) }}">
            </div>
            <div>
                <label for="pekerjaan_buruh_tani" class="block text-sm font-medium text-gray-700 mb-2">Buruh Tani</label>
                <input type="number" name="pekerjaan_buruh_tani" id="pekerjaan_buruh_tani"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pekerjaan_buruh_tani', $demografi->mata_pencaharian['buruh_tani'] ?? 0) }}">
            </div>
            <div>
                <label for="pekerjaan_peternak" class="block text-sm font-medium text-gray-700 mb-2">Peternak</label>
                <input type="number" name="pekerjaan_peternak" id="pekerjaan_peternak"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pekerjaan_peternak', $demografi->mata_pencaharian['peternak'] ?? 0) }}">
            </div>
            <div>
                <label for="pekerjaan_nelayan" class="block text-sm font-medium text-gray-700 mb-2">Nelayan</label>
                <input type="number" name="pekerjaan_nelayan" id="pekerjaan_nelayan"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pekerjaan_nelayan', $demografi->mata_pencaharian['nelayan'] ?? 0) }}">
            </div>
            <div>
                <label for="pekerjaan_pedagang" class="block text-sm font-medium text-gray-700 mb-2">Pedagang</label>
                <input type="number" name="pekerjaan_pedagang" id="pekerjaan_pedagang"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pekerjaan_pedagang', $demografi->mata_pencaharian['pedagang'] ?? 0) }}">
            </div>
            <div>
                <label for="pekerjaan_wiraswasta" class="block text-sm font-medium text-gray-700 mb-2">Wiraswasta</label>
                <input type="number" name="pekerjaan_wiraswasta" id="pekerjaan_wiraswasta"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pekerjaan_wiraswasta', $demografi->mata_pencaharian['wiraswasta'] ?? 0) }}">
            </div>
            <div>
                <label for="pekerjaan_pns" class="block text-sm font-medium text-gray-700 mb-2">PNS</label>
                <input type="number" name="pekerjaan_pns" id="pekerjaan_pns"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pekerjaan_pns', $demografi->mata_pencaharian['pns'] ?? 0) }}">
            </div>
            <div>
                <label for="pekerjaan_tni_polri" class="block text-sm font-medium text-gray-700 mb-2">TNI/POLRI</label>
                <input type="number" name="pekerjaan_tni_polri" id="pekerjaan_tni_polri"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pekerjaan_tni_polri', $demografi->mata_pencaharian['tni_polri'] ?? 0) }}">
            </div>
            <div>
                <label for="pekerjaan_guru" class="block text-sm font-medium text-gray-700 mb-2">Guru</label>
                <input type="number" name="pekerjaan_guru" id="pekerjaan_guru"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pekerjaan_guru', $demografi->mata_pencaharian['guru'] ?? 0) }}">
            </div>
            <div>
                <label for="pekerjaan_bidan_perawat" class="block text-sm font-medium text-gray-700 mb-2">Bidan/Perawat</label>
                <input type="number" name="pekerjaan_bidan_perawat" id="pekerjaan_bidan_perawat"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pekerjaan_bidan_perawat', $demografi->mata_pencaharian['bidan_perawat'] ?? 0) }}">
            </div>
            <div>
                <label for="pekerjaan_pensiunan" class="block text-sm font-medium text-gray-700 mb-2">Pensiunan</label>
                <input type="number" name="pekerjaan_pensiunan" id="pekerjaan_pensiunan"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pekerjaan_pensiunan', $demografi->mata_pencaharian['pensiunan'] ?? 0) }}">
            </div>
            <div>
                <label for="pekerjaan_tidak_bekerja" class="block text-sm font-medium text-gray-700 mb-2">Tidak Bekerja</label>
                <input type="number" name="pekerjaan_tidak_bekerja" id="pekerjaan_tidak_bekerja"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pekerjaan_tidak_bekerja', $demografi->mata_pencaharian['tidak_bekerja'] ?? 0) }}">
            </div>
            <div>
                <label for="pekerjaan_lainnya" class="block text-sm font-medium text-gray-700 mb-2">Lainnya</label>
                <input type="number" name="pekerjaan_lainnya" id="pekerjaan_lainnya"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('pekerjaan_lainnya', $demografi->mata_pencaharian['lainnya'] ?? 0) }}">
            </div>
        </div>
    </div>

    <!-- Agama -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Agama</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="agama_islam" class="block text-sm font-medium text-gray-700 mb-2">Islam</label>
                <input type="number" name="agama_islam" id="agama_islam"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('agama_islam', $demografi->agama['islam'] ?? 0) }}">
            </div>
            <div>
                <label for="agama_kristen" class="block text-sm font-medium text-gray-700 mb-2">Kristen</label>
                <input type="number" name="agama_kristen" id="agama_kristen"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('agama_kristen', $demografi->agama['kristen'] ?? 0) }}">
            </div>
            <div>
                <label for="agama_katolik" class="block text-sm font-medium text-gray-700 mb-2">Katolik</label>
                <input type="number" name="agama_katolik" id="agama_katolik"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('agama_katolik', $demografi->agama['katolik'] ?? 0) }}">
            </div>
            <div>
                <label for="agama_hindu" class="block text-sm font-medium text-gray-700 mb-2">Hindu</label>
                <input type="number" name="agama_hindu" id="agama_hindu"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('agama_hindu', $demografi->agama['hindu'] ?? 0) }}">
            </div>
            <div>
                <label for="agama_buddha" class="block text-sm font-medium text-gray-700 mb-2">Buddha</label>
                <input type="number" name="agama_buddha" id="agama_buddha"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('agama_buddha', $demografi->agama['buddha'] ?? 0) }}">
            </div>
            <div>
                <label for="agama_khonghucu" class="block text-sm font-medium text-gray-700 mb-2">Khonghucu</label>
                <input type="number" name="agama_khonghucu" id="agama_khonghucu"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('agama_khonghucu', $demografi->agama['khonghucu'] ?? 0) }}">
            </div>
            <div>
                <label for="agama_lainnya" class="block text-sm font-medium text-gray-700 mb-2">Lainnya</label>
                <input type="number" name="agama_lainnya" id="agama_lainnya"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('agama_lainnya', $demografi->agama['lainnya'] ?? 0) }}">
            </div>
        </div>
    </div>

    <!-- Status Perkawinan -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Status Perkawinan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label for="status_belum_kawin" class="block text-sm font-medium text-gray-700 mb-2">Belum Kawin</label>
                <input type="number" name="status_belum_kawin" id="status_belum_kawin"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('status_belum_kawin', $demografi->status_perkawinan['belum_kawin'] ?? 0) }}">
            </div>
            <div>
                <label for="status_kawin" class="block text-sm font-medium text-gray-700 mb-2">Kawin</label>
                <input type="number" name="status_kawin" id="status_kawin"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('status_kawin', $demografi->status_perkawinan['kawin'] ?? 0) }}">
            </div>
            <div>
                <label for="status_cerai_hidup" class="block text-sm font-medium text-gray-700 mb-2">Cerai Hidup</label>
                <input type="number" name="status_cerai_hidup" id="status_cerai_hidup"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('status_cerai_hidup', $demografi->status_perkawinan['cerai_hidup'] ?? 0) }}">
            </div>
            <div>
                <label for="status_cerai_mati" class="block text-sm font-medium text-gray-700 mb-2">Cerai Mati</label>
                <input type="number" name="status_cerai_mati" id="status_cerai_mati"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0" value="{{ old('status_cerai_mati', $demografi->status_perkawinan['cerai_mati'] ?? 0) }}">
            </div>
        </div>
    </div>

    <!-- Keterangan dan Status -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Keterangan dan Status</h3>
        <div class="space-y-4">
            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Keterangan tambahan mengenai data demografi...">{{ old('keterangan', $demografi->keterangan) }}</textarea>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                       {{ old('is_active', $demografi->is_active) ? 'checked' : '' }}>
                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                    Aktifkan sebagai data demografi utama
                </label>
            </div>
            <p class="text-sm text-gray-500">Jika dicentang, data demografi ini akan menjadi yang aktif dan menggantikan yang lama</p>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.demografi.index') }}"
           class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Batal
        </a>
        <button type="submit"
                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Update
        </button>
    </div>
</form>

<!-- Auto-calculate script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const totalPendudukInput = document.getElementById('total_penduduk');
    const totalLakiLakiInput = document.getElementById('total_laki_laki');
    const totalPerempuanInput = document.getElementById('total_perempuan');

    function updateTotal() {
        const lakiLaki = parseInt(totalLakiLakiInput.value) || 0;
        const perempuan = parseInt(totalPerempuanInput.value) || 0;
        const total = lakiLaki + perempuan;

        if (total > 0 && totalPendudukInput.value != total) {
            if (confirm('Auto-update total penduduk berdasarkan jumlah laki-laki + perempuan?')) {
                totalPendudukInput.value = total;
            }
        }
    }

    totalLakiLakiInput.addEventListener('blur', updateTotal);
    totalPerempuanInput.addEventListener('blur', updateTotal);

    // Form validation before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const totalPenduduk = parseInt(totalPendudukInput.value) || 0;
        const lakiLaki = parseInt(totalLakiLakiInput.value) || 0;
        const perempuan = parseInt(totalPerempuanInput.value) || 0;

        if (totalPenduduk !== (lakiLaki + perempuan)) {
            e.preventDefault();
            alert('Total penduduk harus sama dengan jumlah laki-laki + perempuan!');
            return false;
        }
    });
});
</script>
@endsection
