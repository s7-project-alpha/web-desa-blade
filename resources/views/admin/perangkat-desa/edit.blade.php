@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Edit Perangkat Desa</h1>
        <p class="text-gray-600">Edit data {{ $perangkatDesa->nama }}</p>
    </div>
    <a href="{{ route('admin.perangkat-desa.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium flex items-center">
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

<form action="{{ route('admin.perangkat-desa.update', $perangkatDesa) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Informasi Dasar</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $perangkatDesa->nama) }}" required
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Masukkan nama lengkap">
            </div>

            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">Jabatan <span class="text-red-500">*</span></label>
                <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $perangkatDesa->jabatan) }}" required
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Masukkan jabatan">
            </div>

            <div>
                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                <select name="kategori" id="kategori" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Pilih kategori</option>
                    @foreach($kategoriOptions as $key => $label)
                        <option value="{{ $key }}" {{ old('kategori', $perangkatDesa->kategori) === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="periode" class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                <input type="text" name="periode" id="periode" value="{{ old('periode', $perangkatDesa->periode) }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: 2019 - 2025">
            </div>

            <div id="dusun-field" class="hidden">
                <label for="dusun" class="block text-sm font-medium text-gray-700 mb-2">Nama Dusun</label>
                <input type="text" name="dusun" id="dusun" value="{{ old('dusun', $perangkatDesa->dusun) }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Masukkan nama dusun">
            </div>

            <div id="rt-rw-field" class="hidden">
                <label for="rt_rw" class="block text-sm font-medium text-gray-700 mb-2">RT/RW</label>
                <input type="text" name="rt_rw" id="rt_rw" value="{{ old('rt_rw', $perangkatDesa->rt_rw) }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: 4 RT, 2 RW">
            </div>

            <div>
                <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampil</label>
                <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $perangkatDesa->urutan) }}" min="0"
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
                <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $perangkatDesa->telepon) }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: 0812-3456-7890">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $perangkatDesa->email) }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="email@example.com">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Informasi Tambahan</h2>

        <div class="space-y-6">
            <div>
                <label for="pendidikan" class="block text-sm font-medium text-gray-700 mb-2">Pendidikan</label>
                <textarea name="pendidikan" id="pendidikan" rows="3"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: S1 Ilmu Sosial - Universitas Negeri Jakarta">{{ old('pendidikan', $perangkatDesa->pendidikan) }}</textarea>
            </div>

            <div id="visi-field" class="hidden">
                <label for="visi" class="block text-sm font-medium text-gray-700 mb-2">Visi</label>
                <textarea name="visi" id="visi" rows="3"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Masukkan visi kepala desa">{{ old('visi', $perangkatDesa->visi) }}</textarea>
            </div>

            <div>
                <label for="tugas_tanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">Tugas & Tanggung Jawab</label>
                <textarea name="tugas_tanggung_jawab" id="tugas_tanggung_jawab" rows="5"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Masukkan tugas dan tanggung jawab, pisahkan dengan enter untuk tiap poin">{{ old('tugas_tanggung_jawab', $perangkatDesa->tugas_tanggung_jawab) }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Pisahkan setiap tugas dengan baris baru (Enter)</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Foto</h2>

        <div class="space-y-4">
            @if($perangkatDesa->foto)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                    <div class="w-32 h-32 rounded-lg overflow-hidden bg-gray-200">
                        <img src="{{ $perangkatDesa->foto_url }}" alt="{{ $perangkatDesa->nama }}" class="w-full h-full object-cover">
                    </div>
                </div>
            @endif

            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Baru</label>
                <input type="file" name="foto" id="foto" accept="image/*"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Status</h2>

        <div class="flex items-center">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $perangkatDesa->is_active) ? 'checked' : '' }}
                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                Aktif
            </label>
        </div>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.perangkat-desa.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-medium">
            Batal
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
            Update
        </button>
    </div>
</form>

<script>
document.getElementById('kategori').addEventListener('change', function() {
    const kategori = this.value;
    const dusunField = document.getElementById('dusun-field');
    const rtRwField = document.getElementById('rt-rw-field');
    const visiField = document.getElementById('visi-field');

    // Hide all conditional fields
    dusunField.classList.add('hidden');
    rtRwField.classList.add('hidden');
    visiField.classList.add('hidden');

    // Show relevant fields based on kategori
    if (kategori === 'kepala_dusun') {
        dusunField.classList.remove('hidden');
        rtRwField.classList.remove('hidden');
    } else if (kategori === 'kepala_desa') {
        visiField.classList.remove('hidden');
    }
});

// Trigger change event on page load to show/hide fields based on current value
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('kategori').dispatchEvent(new Event('change'));
});
</script>
@endsection
