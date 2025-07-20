@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Tim Manajemen</h1>
        <p class="text-gray-600">Tambah anggota tim manajemen untuk {{ $bumdes->nama }}</p>
    </div>
    <a href="{{ route('admin.bumdes.tim-manajemen') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium flex items-center">
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

<form action="{{ route('admin.bumdes.tim-manajemen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Informasi Dasar</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: Budi Hartono, S.E.">
            </div>

            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">Jabatan <span class="text-red-500">*</span></label>
                <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}" required
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: Direktur Utama">
            </div>

            <div>
                <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampil</label>
                <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 0) }}" min="0"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="0">
                <p class="text-sm text-gray-500 mt-1">Semakin kecil angka, semakin awal ditampilkan</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Kontak</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: 0812-3456-7890">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="email@example.com">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Pengalaman & Foto</h2>

        <div class="space-y-6">
            <div>
                <label for="pengalaman" class="block text-sm font-medium text-gray-700 mb-2">Pengalaman</label>
                <textarea name="pengalaman" id="pengalaman" rows="3"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: 5 tahun di bidang koperasi">{{ old('pengalaman') }}</textarea>
            </div>

            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto</label>
                <input type="file" name="foto" id="foto" accept="image/*"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Status</h2>

        <div class="flex items-center">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                Aktif (tampilkan di website)
            </label>
        </div>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.bumdes.tim-manajemen') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-medium">
            Batal
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
            Simpan
        </button>
    </div>
</form>
@endsection
