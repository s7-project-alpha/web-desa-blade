@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Edit Unit Usaha</h1>
        <p class="text-gray-600">Edit unit usaha {{ $unitUsaha->nama }}</p>
    </div>
    <a href="{{ route('admin.bumdes.unit-usaha') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium flex items-center">
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

<form action="{{ route('admin.bumdes.unit-usaha.update', $unitUsaha) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Informasi Unit Usaha</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Unit Usaha <span class="text-red-500">*</span></label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $unitUsaha->nama) }}" required
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: Simpan Pinjam">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                <select name="status" id="status" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Pilih status</option>
                    @foreach($statusOptions as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $unitUsaha->status) === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="jumlah_anggota" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Anggota <span class="text-red-500">*</span></label>
                <input type="number" name="jumlah_anggota" id="jumlah_anggota" value="{{ old('jumlah_anggota', $unitUsaha->jumlah_anggota) }}" required min="0"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="156">
            </div>

            <div>
                <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampil</label>
                <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $unitUsaha->urutan) }}" min="0"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="0">
                <p class="text-sm text-gray-500 mt-1">Semakin kecil angka, semakin awal ditampilkan</p>
            </div>

            <div class="md:col-span-2">
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon (Opsional)</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon', $unitUsaha->icon) }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: fas fa-coins">
                <p class="text-sm text-gray-500 mt-1">Gunakan Font Awesome class, contoh: fas fa-store</p>
            </div>

            <div class="md:col-span-2">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Layanan kredit mikro untuk modal usaha warga dengan bunga rendah">{{ old('deskripsi', $unitUsaha->deskripsi) }}</textarea>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Status Publikasi</h2>
        <div class="flex items-center">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                {{ old('is_active', $unitUsaha->is_active) ? 'checked' : '' }}
                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                Aktif (tampilkan di website)
            </label>
        </div>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.bumdes.unit-usaha') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-medium">
            Batal
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
            Perbarui
        </button>
    </div>
</form>
@endsection
