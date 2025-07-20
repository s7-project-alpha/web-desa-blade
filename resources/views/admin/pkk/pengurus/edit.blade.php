@extends('admin.layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Edit Pengurus PKK</h1>
        <p class="text-gray-600">Perbarui data pengurus {{ $pengurus->nama }}</p>
    </div>
    <a href="{{ route('admin.pkk.pengurus') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
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

<form action="{{ route('admin.pkk.pengurus.update', $pengurus) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Informasi Pengurus</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="nama"
                       id="nama"
                       value="{{ old('nama', $pengurus->nama) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Nama lengkap pengurus"
                       required>
            </div>

            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                    Jabatan <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="jabatan"
                       id="jabatan"
                       value="{{ old('jabatan', $pengurus->jabatan) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Contoh: Ketua Tim Penggerak PKK"
                       required>
            </div>
        </div>

        <div class="mt-6">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                Deskripsi
            </label>
            <textarea name="deskripsi"
                      id="deskripsi"
                      rows="3"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Deskripsi singkat tentang pengurus...">{{ old('deskripsi', $pengurus->deskripsi) }}</textarea>
        </div>

        <div class="mt-6">
            <label for="tugas" class="block text-sm font-medium text-gray-700 mb-2">
                Tugas dan Tanggung Jawab
            </label>
            <textarea name="tugas"
                      id="tugas"
                      rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Tugas dan tanggung jawab pengurus...">{{ old('tugas', $pengurus->tugas) }}</textarea>
        </div>

        <div class="mt-6">
            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                Foto Pengurus
            </label>

            @if($pengurus->foto)
                <div class="mb-4">
                    <img src="{{ $pengurus->foto_url }}" alt="{{ $pengurus->nama }}" class="w-32 h-32 object-cover rounded-lg">
                    <p class="text-sm text-gray-500 mt-2">Foto saat ini</p>
                </div>
            @endif

            <input type="file"
                   name="foto"
                   id="foto"
                   accept="image/*"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <p class="mt-2 text-sm text-gray-500">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Informasi Kontak</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor Telepon
                </label>
                <input type="text"
                       name="telepon"
                       id="telepon"
                       value="{{ old('telepon', $pengurus->telepon) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Contoh: 0812-3456-7890">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>
                <input type="email"
                       name="email"
                       id="email"
                       value="{{ old('email', $pengurus->email) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="email@example.com">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Periode Jabatan</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="periode_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                    Periode Mulai
                </label>
                <input type="text"
                       name="periode_mulai"
                       id="periode_mulai"
                       value="{{ old('periode_mulai', $pengurus->periode_mulai) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Contoh: 2023"
                       maxlength="4">
            </div>

            <div>
                <label for="periode_selesai" class="block text-sm font-medium text-gray-700 mb-2">
                    Periode Selesai
                </label>
                <input type="text"
                       name="periode_selesai"
                       id="periode_selesai"
                       value="{{ old('periode_selesai', $pengurus->periode_selesai) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Contoh: 2028"
                       maxlength="4">
            </div>

            <div>
                <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                    Urutan <span class="text-red-500">*</span>
                </label>
                <input type="number"
                       name="urutan"
                       id="urutan"
                       value="{{ old('urutan', $pengurus->urutan) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       min="1"
                       required>
            </div>
        </div>

        <div class="mt-6">
            <label class="flex items-center">
                <input type="checkbox"
                       name="is_active"
                       value="1"
                       {{ old('is_active', $pengurus->is_active) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-600">Pengurus aktif</span>
            </label>
        </div>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.pkk.pengurus') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            Batal
        </a>
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            Perbarui
        </button>
    </div>
</form>
@endsection
