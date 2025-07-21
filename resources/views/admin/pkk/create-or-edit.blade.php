@extends('admin.layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">{{ $pkk ? 'Edit' : 'Tambah' }} Data PKK</h1>
        <p class="text-gray-600">{{ $pkk ? 'Perbarui' : 'Tambahkan' }} informasi PKK Desa Tanjung Selamat</p>
    </div>
    <a href="{{ route('admin.pkk.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
        </svg>
        Kembali
    </a>
</div>

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.pkk.store-or-update') }}" method="POST" class="space-y-6">
    @csrf

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Informasi Umum</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                    Judul PKK <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="judul"
                       id="judul"
                       value="{{ old('judul', $pkk->judul ?? 'PKK Desa Tanjung Selamat') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <div>
                <label for="slogan" class="block text-sm font-medium text-gray-700 mb-2">
                    Slogan
                </label>
                <input type="text"
                       name="slogan"
                       id="slogan"
                       value="{{ old('slogan', $pkk->slogan ?? '') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Contoh: Wanita Hebat, Keluarga Sejahtera">
            </div>
        </div>

        <div class="mt-6">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                Deskripsi
            </label>
            <textarea name="deskripsi"
                      id="deskripsi"
                      rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Deskripsi singkat tentang PKK...">{{ old('deskripsi', $pkk->deskripsi ?? '') }}</textarea>
        </div>

        <div class="mt-6">
            <label for="visi" class="block text-sm font-medium text-gray-700 mb-2">
                Visi PKK
            </label>
            <textarea name="visi"
                      id="visi"
                      rows="3"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Visi PKK Desa Tanjung Selamat...">{{ old('visi', $pkk->visi ?? '') }}</textarea>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Statistik PKK</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <label for="anggota_aktif" class="block text-sm font-medium text-gray-700 mb-2">
                    Anggota Aktif <span class="text-red-500">*</span>
                </label>
                <input type="number"
                       name="anggota_aktif"
                       id="anggota_aktif"
                       value="{{ old('anggota_aktif', $pkk->anggota_aktif ?? 0) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       min="0"
                       required>
            </div>

            <div>
                <label for="program_aktif" class="block text-sm font-medium text-gray-700 mb-2">
                    Program Aktif <span class="text-red-500">*</span>
                </label>
                <input type="number"
                       name="program_aktif"
                       id="program_aktif"
                       value="{{ old('program_aktif', $pkk->program_aktif ?? 0) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       min="0"
                       required>
            </div>

            <div>
                <label for="kegiatan_per_tahun" class="block text-sm font-medium text-gray-700 mb-2">
                    Kegiatan per Tahun <span class="text-red-500">*</span>
                </label>
                <input type="number"
                       name="kegiatan_per_tahun"
                       id="kegiatan_per_tahun"
                       value="{{ old('kegiatan_per_tahun', $pkk->kegiatan_per_tahun ?? 0) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       min="0"
                       required>
            </div>

            <div>
                <label for="pokja_aktif" class="block text-sm font-medium text-gray-700 mb-2">
                    Pokja Aktif <span class="text-red-500">*</span>
                </label>
                <input type="number"
                       name="pokja_aktif"
                       id="pokja_aktif"
                       value="{{ old('pokja_aktif', $pkk->pokja_aktif ?? 0) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       min="0"
                       required>
            </div>
        </div>

        <div class="mt-6">
            <label class="flex items-center">
                <input type="checkbox"
                       name="is_active"
                       value="1"
                       {{ old('is_active', $pkk->is_active ?? true) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-600">Data PKK aktif</span>
            </label>
        </div>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.pkk.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            Batal
        </a>
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            {{ $pkk ? 'Perbarui' : 'Simpan' }}
        </button>
    </div>
</form>
@endsection
