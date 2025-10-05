{{-- resources/views/admin/posyandu/layanan/create.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-4 justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Tambah Layanan Posyandu</h1>
            <p class="text-gray-600 mt-1">Tambah layanan posyandu baru</p>
        </div>
         <a href="{{ route('admin.posyandu.layanan') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">Form Layanan Posyandu</h2>
    </div>

    <form action="{{ route('admin.posyandu.layanan.store') }}" method="POST" class="p-6 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama_layanan" class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan</label>
                <input type="text" name="nama_layanan" id="nama_layanan" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    value="{{ old('nama_layanan') }}" placeholder="Contoh: Pemantauan Pertumbuhan">
                @error('nama_layanan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon (Emoji/Unicode)</label>
                <input type="text" name="icon" id="icon"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    value="{{ old('icon') }}" placeholder="Contoh: 📊 🩺 💉 🥗">
                @error('icon')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">Opsional: Emoji untuk menampilkan icon layanan</p>
            </div>
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Layanan</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                placeholder="Deskripsi lengkap tentang layanan yang diberikan">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="jadwal" class="block text-sm font-medium text-gray-700 mb-2">Jadwal Layanan</label>
                <select name="jadwal" id="jadwal" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Pilih Jadwal</option>
                    <option value="Bulanan" {{ old('jadwal') == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="Mingguan" {{ old('jadwal') == 'Mingguan' ? 'selected' : '' }}>Mingguan</option>
                    <option value="Sesuai jadwal" {{ old('jadwal') == 'Sesuai jadwal' ? 'selected' : '' }}>Sesuai jadwal</option>
                    <option value="Setiap kunjungan" {{ old('jadwal') == 'Setiap kunjungan' ? 'selected' : '' }}>Setiap kunjungan</option>
                    <option value="Sewaktu-waktu" {{ old('jadwal') == 'Sewaktu-waktu' ? 'selected' : '' }}>Sewaktu-waktu</option>
                </select>
                @error('jadwal')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="target_usia" class="block text-sm font-medium text-gray-700 mb-2">Target Usia</label>
                <select name="target_usia" id="target_usia" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Pilih Target Usia</option>
                    <option value="0-5 tahun" {{ old('target_usia') == '0-5 tahun' ? 'selected' : '' }}>0-5 tahun</option>
                    <option value="0-2 tahun" {{ old('target_usia') == '0-2 tahun' ? 'selected' : '' }}>0-2 tahun</option>
                    <option value="1-5 tahun" {{ old('target_usia') == '1-5 tahun' ? 'selected' : '' }}>1-5 tahun</option>
                    <option value="Ibu & Balita" {{ old('target_usia') == 'Ibu & Balita' ? 'selected' : '' }}>Ibu & Balita</option>
                    <option value="Ibu Hamil" {{ old('target_usia') == 'Ibu Hamil' ? 'selected' : '' }}>Ibu Hamil</option>
                    <option value="Semua usia" {{ old('target_usia') == 'Semua usia' ? 'selected' : '' }}>Semua usia</option>
                </select>
                @error('target_usia')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Preview Layanan -->
        <div class="border-t pt-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Preview Layanan</h3>
            <div class="bg-gray-50 rounded-xl p-6 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <div id="preview-icon" class="text-2xl">📋</div>
                </div>
                <h3 id="preview-nama" class="text-lg font-bold text-gray-900 mb-2">Nama Layanan</h3>
                <p id="preview-deskripsi" class="text-sm text-gray-600 mb-3">Deskripsi layanan akan muncul di sini</p>
                <div class="space-y-2">
                    <div class="flex items-center justify-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        <span id="preview-jadwal">Jadwal</span>
                    </div>
                    <div class="flex items-center justify-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        <span id="preview-target">Target Usia</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between pt-6 border-t">
            <a href="{{ route('admin.posyandu.layanan') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                Simpan Data
            </button>
        </div>
    </form>
</div>

<script>
// Live preview update
document.addEventListener('DOMContentLoaded', function() {
    const namaInput = document.getElementById('nama_layanan');
    const deskripsiInput = document.getElementById('deskripsi');
    const jadwalInput = document.getElementById('jadwal');
    const targetInput = document.getElementById('target_usia');
    const iconInput = document.getElementById('icon');

    function updatePreview() {
        document.getElementById('preview-nama').textContent = namaInput.value || 'Nama Layanan';
        document.getElementById('preview-deskripsi').textContent = deskripsiInput.value || 'Deskripsi layanan akan muncul di sini';
        document.getElementById('preview-jadwal').textContent = jadwalInput.value || 'Jadwal';
        document.getElementById('preview-target').textContent = targetInput.value || 'Target Usia';
        document.getElementById('preview-icon').textContent = iconInput.value || '📋';
    }

    namaInput.addEventListener('input', updatePreview);
    deskripsiInput.addEventListener('input', updatePreview);
    jadwalInput.addEventListener('change', updatePreview);
    targetInput.addEventListener('change', updatePreview);
    iconInput.addEventListener('input', updatePreview);
});
</script>
@endsection
