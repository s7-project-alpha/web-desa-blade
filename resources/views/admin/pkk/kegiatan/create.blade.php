@extends('admin.layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Kegiatan PKK</h1>
        <p class="text-gray-600">Tambahkan kegiatan baru untuk PKK Desa Tanjung Selamat</p>
    </div>
    <a href="{{ route('admin.pkk.kegiatan') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
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

<form action="{{ route('admin.pkk.kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Informasi Kegiatan</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kegiatan <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="nama_kegiatan"
                       id="nama_kegiatan"
                       value="{{ old('nama_kegiatan') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Nama kegiatan PKK"
                       required>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status"
                        id="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required>
                    <option value="akan_datang" {{ old('status') == 'akan_datang' ? 'selected' : '' }}>Akan Datang</option>
                    <option value="sedang_berlangsung" {{ old('status') == 'sedang_berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
        </div>

        <div class="mt-6">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                Deskripsi <span class="text-red-500">*</span>
            </label>
            <textarea name="deskripsi"
                      id="deskripsi"
                      rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Deskripsi lengkap kegiatan..."
                      required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mt-6">
            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                Foto Kegiatan
            </label>
            <input type="file"
                   name="foto"
                   id="foto"
                   accept="image/*"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <p class="mt-2 text-sm text-gray-500">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Jadwal & Lokasi</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal <span class="text-red-500">*</span>
                </label>
                <input type="date"
                       name="tanggal"
                       id="tanggal"
                       value="{{ old('tanggal') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <div>
                <label for="waktu" class="block text-sm font-medium text-gray-700 mb-2">
                    Waktu
                </label>
                <input type="time"
                       name="waktu"
                       id="waktu"
                       value="{{ old('waktu') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div class="mt-6">
            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">
                Lokasi
            </label>
            <input type="text"
                   name="lokasi"
                   id="lokasi"
                   value="{{ old('lokasi') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Lokasi kegiatan">
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Penanggung Jawab & Peserta</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">
                    Penanggung Jawab
                </label>
                <input type="text"
                       name="penanggung_jawab"
                       id="penanggung_jawab"
                       value="{{ old('penanggung_jawab') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Nama penanggung jawab">
            </div>

            <div>
                <label for="jumlah_peserta" class="block text-sm font-medium text-gray-700 mb-2">
                    Jumlah Peserta <span class="text-red-500">*</span>
                </label>
                <input type="number"
                       name="jumlah_peserta"
                       id="jumlah_peserta"
                       value="{{ old('jumlah_peserta', 0) }}"
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
                       {{ old('is_active', true) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-600">Kegiatan aktif</span>
            </label>
        </div>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.pkk.kegiatan') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            Batal
        </a>
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            Simpan
        </button>
    </div>
</form>
@endsection
