@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">{{ $bumdes ? 'Edit' : 'Buat' }} Data BUMDes</h1>
        <p class="text-gray-600">{{ $bumdes ? 'Perbarui informasi BUMDes' : 'Buat data BUMDes baru' }}</p>
    </div>
    <a href="{{ route('admin.bumdes.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
        </svg>
        Kembali
    </a>
</div>

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.bumdes.store-or-update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <!-- Informasi Dasar -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Informasi Dasar</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama BUMDes <span class="text-red-500">*</span></label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $bumdes->nama ?? '') }}" required
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: BUMDes Sukamaju Mandiri">
            </div>

            <div class="md:col-span-2">
                <label for="tagline" class="block text-sm font-medium text-gray-700 mb-2">Tagline</label>
                <input type="text" name="tagline" id="tagline" value="{{ old('tagline', $bumdes->tagline ?? '') }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: BUMDes Sukamaju Membangun Ekonomi Desa">
            </div>

            <div class="md:col-span-2">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Deskripsi singkat tentang BUMDes">{{ old('deskripsi', $bumdes->deskripsi ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Header Image & Text -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Header Website</h2>

        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="header_title" class="block text-sm font-medium text-gray-700 mb-2">Judul Header</label>
                    <input type="text" name="header_title" id="header_title" value="{{ old('header_title', $bumdes->header_title ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: BUMDes Sukamaju">
                </div>

                <div>
                    <label for="header_subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle Header</label>
                    <input type="text" name="header_subtitle" id="header_subtitle" value="{{ old('header_subtitle', $bumdes->header_subtitle ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Membangun Ekonomi Desa">
                </div>
            </div>

            <div>
                <label for="header_image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Header</label>
                @if($bumdes && $bumdes->header_image)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                        <div class="w-full h-48 rounded-lg overflow-hidden bg-gray-200">
                            <img src="{{ $bumdes->header_image_url }}" alt="Header BUMDes" class="w-full h-full object-cover">
                        </div>
                    </div>
                @endif
                <input type="file" name="header_image" id="header_image" accept="image/*"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB. Gambar ini akan ditampilkan sebagai header dengan text overlay.</p>
            </div>
        </div>
    </div>

    <!-- Visi & Misi -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Visi & Misi</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="visi" class="block text-sm font-medium text-gray-700 mb-2">Visi</label>
                <textarea name="visi" id="visi" rows="4"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Visi BUMDes">{{ old('visi', $bumdes->visi ?? '') }}</textarea>
            </div>

            <div>
                <label for="misi" class="block text-sm font-medium text-gray-700 mb-2">Misi</label>
                <textarea name="misi" id="misi" rows="4"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Misi BUMDes">{{ old('misi', $bumdes->misi ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Statistik Keuangan -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Statistik Keuangan</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="total_aset" class="block text-sm font-medium text-gray-700 mb-2">Total Aset (Rupiah) <span class="text-red-500">*</span></label>
                <input type="number" name="total_aset" id="total_aset" value="{{ old('total_aset', $bumdes->total_aset ?? '') }}" required
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="285000000">
                <p class="text-sm text-gray-500 mt-1">Contoh: 285000000 untuk Rp 285 juta</p>
            </div>

            <div>
                <label for="aset_growth" class="block text-sm font-medium text-gray-700 mb-2">Pertumbuhan Aset (%)</label>
                <input type="number" step="0.01" name="aset_growth" id="aset_growth" value="{{ old('aset_growth', $bumdes->aset_growth ?? '') }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="12">
                <p class="text-sm text-gray-500 mt-1">Contoh: 12 untuk +12%</p>
            </div>

            <div>
                <label for="omzet_tahunan" class="block text-sm font-medium text-gray-700 mb-2">Omzet Tahunan (Rupiah) <span class="text-red-500">*</span></label>
                <input type="number" name="omzet_tahunan" id="omzet_tahunan" value="{{ old('omzet_tahunan', $bumdes->omzet_tahunan ?? '') }}" required
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="320000000">
                <p class="text-sm text-gray-500 mt-1">Contoh: 320000000 untuk Rp 320 juta</p>
            </div>

            <div>
                <label for="omzet_growth" class="block text-sm font-medium text-gray-700 mb-2">Pertumbuhan Omzet (%)</label>
                <input type="number" step="0.01" name="omzet_growth" id="omzet_growth" value="{{ old('omzet_growth', $bumdes->omzet_growth ?? '') }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="18">
            </div>

            <div>
                <label for="laba_bersih" class="block text-sm font-medium text-gray-700 mb-2">Laba Bersih (Rupiah) <span class="text-red-500">*</span></label>
                <input type="number" name="laba_bersih" id="laba_bersih" value="{{ old('laba_bersih', $bumdes->laba_bersih ?? '') }}" required
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="45000000">
                <p class="text-sm text-gray-500 mt-1">Contoh: 45000000 untuk Rp 45 juta</p>
            </div>

            <div>
                <label for="laba_growth" class="block text-sm font-medium text-gray-700 mb-2">Pertumbuhan Laba (%)</label>
                <input type="number" step="0.01" name="laba_growth" id="laba_growth" value="{{ old('laba_growth', $bumdes->laba_growth ?? '') }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="25">
            </div>

            <div>
                <label for="anggota_aktif" class="block text-sm font-medium text-gray-700 mb-2">Anggota Aktif <span class="text-red-500">*</span></label>
                <input type="number" name="anggota_aktif" id="anggota_aktif" value="{{ old('anggota_aktif', $bumdes->anggota_aktif ?? '') }}" required
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="502">
            </div>

            <div>
                <label for="anggota_growth" class="block text-sm font-medium text-gray-700 mb-2">Pertumbuhan Anggota (%)</label>
                <input type="number" step="0.01" name="anggota_growth" id="anggota_growth" value="{{ old('anggota_growth', $bumdes->anggota_growth ?? '') }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="8">
            </div>
        </div>
    </div>

    <!-- Status -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Status</h2>

        <div class="flex items-center">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $bumdes->is_active ?? true) ? 'checked' : '' }}
                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                Aktif
            </label>
        </div>
    </div>

    <!-- Submit Buttons -->
    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.bumdes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-medium">
            Batal
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
            {{ $bumdes ? 'Update' : 'Simpan' }}
        </button>
    </div>
</form>

<script>
// Auto-format currency inputs
document.addEventListener('DOMContentLoaded', function() {
    const currencyInputs = ['total_aset', 'omzet_tahunan', 'laba_bersih'];

    currencyInputs.forEach(inputId => {
        const input = document.getElementById(inputId);
        if (input) {
            input.addEventListener('input', function(e) {
                // Remove non-numeric characters
                let value = e.target.value.replace(/[^0-9]/g, '');
                e.target.value = value;
            });
        }
    });
});
</script>
@endsection
