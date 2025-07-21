{{-- resources/views/admin/posyandu/edit.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-4 justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Posyandu</h1>
            <p class="text-gray-600 mt-1">Edit data posyandu {{ $posyandu->nama }}</p>
        </div>
        <a href="{{ route('admin.posyandu.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
            </svg>
            Kembali
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">Form Edit Data Posyandu</h2>
    </div>

    <form action="{{ route('admin.posyandu.update', $posyandu) }}" method="POST" class="p-6 space-y-6">
        @csrf
        @method('PUT')

        <!-- Informasi Dasar -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Posyandu</label>
                <input type="text" name="nama" id="nama" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    value="{{ old('nama', $posyandu->nama) }}" placeholder="Contoh: Posyandu Mawar">
                @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    value="{{ old('lokasi', $posyandu->lokasi) }}" placeholder="Contoh: Balai Desa">
                @error('lokasi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="dusun" class="block text-sm font-medium text-gray-700 mb-2">Dusun</label>
                <input type="text" name="dusun" id="dusun" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    value="{{ old('dusun', $posyandu->dusun) }}" placeholder="Contoh: Dusun Mawar">
                @error('dusun')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="rt_rw" class="block text-sm font-medium text-gray-700 mb-2">RT/RW</label>
                <input type="text" name="rt_rw" id="rt_rw" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    value="{{ old('rt_rw', $posyandu->rt_rw) }}" placeholder="Contoh: RT 01-02">
                @error('rt_rw')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                placeholder="Deskripsi singkat tentang posyandu">{{ old('deskripsi', $posyandu->deskripsi) }}</textarea>
            @error('deskripsi')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Jadwal -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="jadwal" class="block text-sm font-medium text-gray-700 mb-2">Jadwal</label>
                <input type="text" name="jadwal" id="jadwal" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    value="{{ old('jadwal', $posyandu->jadwal) }}" placeholder="Contoh: Minggu ke-1 setiap bulan">
                @error('jadwal')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
                <input type="time" name="jam_mulai" id="jam_mulai" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    value="{{ old('jam_mulai', $posyandu->jam_mulai->format('H:i')) }}">
                @error('jam_mulai')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
                <input type="time" name="jam_selesai" id="jam_selesai" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    value="{{ old('jam_selesai', $posyandu->jam_selesai->format('H:i')) }}">
                @error('jam_selesai')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Penanggung Jawab -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">Penanggung Jawab</label>
                <input type="text" name="penanggung_jawab" id="penanggung_jawab" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    value="{{ old('penanggung_jawab', $posyandu->penanggung_jawab) }}" placeholder="Contoh: Ibu Siti Aminah">
                @error('penanggung_jawab')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="telepon_penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">Telepon Penanggung Jawab</label>
                <input type="text" name="telepon_penanggung_jawab" id="telepon_penanggung_jawab" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    value="{{ old('telepon_penanggung_jawab', $posyandu->telepon_penanggung_jawab) }}" placeholder="0812-3456-7890">
                @error('telepon_penanggung_jawab')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Layanan -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Layanan yang Tersedia</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                @php
                    $layananOptions = [
                        'Pemeriksaan Balita',
                        'Imunisasi',
                        'Konseling Gizi',
                        'Pemeriksaan Kesehatan',
                        'Penimbangan',
                        'Vitamin A',
                        'KB',
                        'Penyuluhan Kesehatan'
                    ];
                    $currentLayanan = old('layanan', $posyandu->layanan ?? []);
                @endphp
                @foreach($layananOptions as $layanan)
                <label class="flex items-center">
                    <input type="checkbox" name="layanan[]" value="{{ $layanan }}"
                        class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50"
                        {{ in_array($layanan, $currentLayanan) ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-700">{{ $layanan }}</span>
                </label>
                @endforeach
            </div>
            @error('layanan')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Statistik -->
        <div class="border-t pt-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Statistik Posyandu</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <label for="anggota_aktif" class="block text-sm font-medium text-gray-700 mb-2">Anggota Aktif</label>
                    <input type="number" name="anggota_aktif" id="anggota_aktif" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        value="{{ old('anggota_aktif', $posyandu->anggota_aktif) }}">
                    @error('anggota_aktif')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="total_balita" class="block text-sm font-medium text-gray-700 mb-2">Total Balita</label>
                    <input type="number" name="total_balita" id="total_balita" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        value="{{ old('total_balita', $posyandu->total_balita) }}">
                    @error('total_balita')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="balita_gizi_baik" class="block text-sm font-medium text-gray-700 mb-2">Balita Gizi Baik</label>
                    <input type="number" name="balita_gizi_baik" id="balita_gizi_baik" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        value="{{ old('balita_gizi_baik', $posyandu->balita_gizi_baik) }}">
                    @error('balita_gizi_baik')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cakupan_imunisasi" class="block text-sm font-medium text-gray-700 mb-2">Cakupan Imunisasi (%)</label>
                    <input type="number" name="cakupan_imunisasi" id="cakupan_imunisasi" min="0" max="100" step="0.01"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        value="{{ old('cakupan_imunisasi', $posyandu->cakupan_imunisasi) }}">
                    @error('cakupan_imunisasi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="ibu_hamil_aktif" class="block text-sm font-medium text-gray-700 mb-2">Ibu Hamil Aktif</label>
                    <input type="number" name="ibu_hamil_aktif" id="ibu_hamil_aktif" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        value="{{ old('ibu_hamil_aktif', $posyandu->ibu_hamil_aktif) }}">
                    @error('ibu_hamil_aktif')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between pt-6 border-t">
            <a href="{{ route('admin.posyandu.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                Update Data
            </button>
        </div>
    </form>
</div>
@endsection
