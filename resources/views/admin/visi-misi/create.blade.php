@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center">
        <a href="{{ route('admin.visi-misi.index') }}" class="text-blue-600 hover:text-blue-800 mr-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Visi, Misi & Nilai Dasar</h1>
            <p class="text-gray-600">Tambahkan visi, misi, dan nilai dasar baru untuk desa</p>
        </div>
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

<form action="{{ route('admin.visi-misi.store') }}" method="POST" class="space-y-6">
    @csrf

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Periode -->
            <div class="lg:col-span-2">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Periode</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="periode_awal" class="block text-sm font-medium text-gray-700 mb-2">Tahun Awal</label>
                        <input type="text" name="periode_awal" id="periode_awal"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="2024" value="{{ old('periode_awal') }}" maxlength="4" required>
                    </div>
                    <div>
                        <label for="periode_akhir" class="block text-sm font-medium text-gray-700 mb-2">Tahun Akhir</label>
                        <input type="text" name="periode_akhir" id="periode_akhir"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="2030" value="{{ old('periode_akhir') }}" maxlength="4" required>
                    </div>
                </div>
            </div>

            <!-- Visi -->
            <div class="lg:col-span-2">
                <label for="visi" class="block text-sm font-medium text-gray-700 mb-2">Visi</label>
                <textarea name="visi" id="visi" rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Masukkan visi desa..." required>{{ old('visi') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Tuliskan visi desa dengan jelas dan inspiratif</p>
            </div>

            <!-- Misi -->
            <div class="lg:col-span-2">
                <label for="misi" class="block text-sm font-medium text-gray-700 mb-2">Misi</label>
                <textarea name="misi" id="misi" rows="8"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="1. Misi pertama&#10;2. Misi kedua&#10;3. Misi ketiga" required>{{ old('misi') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Tuliskan setiap misi dalam baris baru (Enter untuk baris baru)</p>
            </div>

            <!-- Nilai Dasar -->
            <div class="lg:col-span-2">
                <label for="nilai_dasar" class="block text-sm font-medium text-gray-700 mb-2">Nilai Dasar</label>
                <textarea name="nilai_dasar" id="nilai_dasar" rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="1. Nilai dasar pertama&#10;2. Nilai dasar kedua&#10;3. Nilai dasar ketiga">{{ old('nilai_dasar') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Nilai-nilai dasar yang dipegang teguh oleh desa (opsional)</p>
            </div>

            <!-- Tujuan -->
            <div>
                <label for="tujuan" class="block text-sm font-medium text-gray-700 mb-2">Tujuan</label>
                <textarea name="tujuan" id="tujuan" rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="1. Tujuan pertama&#10;2. Tujuan kedua">{{ old('tujuan') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Tujuan yang ingin dicapai (opsional)</p>
            </div>

            <!-- Sasaran -->
            <div>
                <label for="sasaran" class="block text-sm font-medium text-gray-700 mb-2">Sasaran</label>
                <textarea name="sasaran" id="sasaran" rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="1. Sasaran pertama&#10;2. Sasaran kedua">{{ old('sasaran') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Sasaran yang ditargetkan (opsional)</p>
            </div>

            <!-- Status -->
            <div class="lg:col-span-2">
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                           {{ old('is_active') ? 'checked' : '' }}>
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Aktifkan sebagai visi misi utama
                    </label>
                </div>
                <p class="mt-1 text-sm text-gray-500">Jika dicentang, visi misi ini akan menjadi yang aktif dan menggantikan yang lama</p>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.visi-misi.index') }}"
           class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Batal
        </a>
        <button type="submit"
                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Simpan
        </button>
    </div>
</form>
@endsection
