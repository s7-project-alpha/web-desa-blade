{{-- resources/views/admin/posyandu/tenaga-kesehatan/edit.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-4 justify-between">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Tenaga Kesehatan</h1>
            <p class="text-gray-600 mt-1">Edit data {{ $tenagaKesehatan->nama }}</p>
        </div>
            <a href="{{ route('admin.posyandu.tenaga-kesehatan') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">Form Edit Tenaga Kesehatan</h2>
    </div>

    <form action="{{ route('admin.posyandu.tenaga-kesehatan.update', $tenagaKesehatan) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <input type="text" name="nama" id="nama" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    value="{{ old('nama', $tenagaKesehatan->nama) }}" placeholder="Contoh: Bidan Ani Suryani">
                @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="gelar" class="block text-sm font-medium text-gray-700 mb-2">Gelar</label>
                <input type="text" name="gelar" id="gelar"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    value="{{ old('gelar', $tenagaKesehatan->gelar) }}" placeholder="Contoh: A.Md.Keb">
                @error('gelar')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    value="{{ old('jabatan', $tenagaKesehatan->jabatan) }}" placeholder="Contoh: Bidan Desa">
                @error('jabatan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="spesialisasi" class="block text-sm font-medium text-gray-700 mb-2">Spesialisasi</label>
                <input type="text" name="spesialisasi" id="spesialisasi" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    value="{{ old('spesialisasi', $tenagaKesehatan->spesialisasi) }}" placeholder="Contoh: Kesehatan Ibu dan Anak">
                @error('spesialisasi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="pengalaman_tahun" class="block text-sm font-medium text-gray-700 mb-2">Pengalaman (Tahun)</label>
                <input type="number" name="pengalaman_tahun" id="pengalaman_tahun" min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    value="{{ old('pengalaman_tahun', $tenagaKesehatan->pengalaman_tahun) }}">
                @error('pengalaman_tahun')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                <input type="text" name="telepon" id="telepon"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    value="{{ old('telepon', $tenagaKesehatan->telepon) }}" placeholder="0812-1234-5678">
                @error('telepon')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    value="{{ old('email', $tenagaKesehatan->email) }}" placeholder="email@example.com">
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                @if($tenagaKesehatan->foto)
                <div class="mb-2">
                    <img src="{{ $tenagaKesehatan->foto_url }}" alt="{{ $tenagaKesehatan->nama }}" class="w-20 h-20 rounded-lg object-cover">
                    <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                </div>
                @endif
                <input type="file" name="foto" id="foto" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max 2MB). Kosongkan jika tidak ingin mengubah foto.</p>
                @error('foto')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="Deskripsi singkat tentang tenaga kesehatan">{{ old('deskripsi', $tenagaKesehatan->deskripsi) }}</textarea>
            @error('deskripsi')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between pt-6 border-t">
            <a href="{{ route('admin.posyandu.tenaga-kesehatan') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200">
                Update Data
            </button>
        </div>
    </form>
</div>
@endsection
