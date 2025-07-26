@extends('admin.layouts.app')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Program Kerja PKK</h1>
        <p class="text-gray-600">Menambahkan program kerja baru PKK Desa Tanjung Selamat</p>
    </div>
    <div>
        <a href="{{ route('admin.pkk.program-kerja') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
            </svg>
            Kembali
        </a>
    </div>
</div>

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <form action="{{ route('admin.pkk.program-kerja.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Program -->
            <div class="md:col-span-2">
                <label for="nama_program" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Program <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       id="nama_program"
                       name="nama_program"
                       value="{{ old('nama_program') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Masukkan nama program kerja"
                       required>
            </div>

            <!-- Deskripsi -->
            <div class="md:col-span-2">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea id="deskripsi"
                          name="deskripsi"
                          rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                          placeholder="Masukkan deskripsi program kerja"
                          required>{{ old('deskripsi') }}</textarea>
            </div>

            <!-- Kegiatan -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Daftar Kegiatan <span class="text-red-500">*</span>
                </label>
                <div id="kegiatan-container">
                    @if(old('kegiatan'))
                        @foreach(old('kegiatan') as $index => $kegiatan)
                            <div class="kegiatan-item flex items-center gap-2 mb-2">
                                <input type="text"
                                       name="kegiatan[]"
                                       value="{{ $kegiatan }}"
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Nama kegiatan"
                                       required>
                                <button type="button" onclick="removeKegiatan(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <div class="kegiatan-item flex items-center gap-2 mb-2">
                            <input type="text"
                                   name="kegiatan[]"
                                   class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Nama kegiatan"
                                   required>
                            <button type="button" onclick="removeKegiatan(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
                <button type="button" onclick="addKegiatan()" class="mt-2 px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Tambah Kegiatan
                </button>
            </div>

            <!-- Peserta Aktif -->
            <div>
                <label for="peserta_aktif" class="block text-sm font-medium text-gray-700 mb-2">
                    Jumlah Peserta Aktif <span class="text-red-500">*</span>
                </label>
                <input type="number"
                       id="peserta_aktif"
                       name="peserta_aktif"
                       value="{{ old('peserta_aktif', 0) }}"
                       min="0"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required>
            </div>

            <!-- Urutan -->
            <div>
                <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                    Urutan <span class="text-red-500">*</span>
                </label>
                <input type="number"
                       id="urutan"
                       name="urutan"
                       value="{{ old('urutan', 1) }}"
                       min="1"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required>
            </div>

            <!-- Icon -->
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                <select id="icon"
                        name="icon"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih Icon</option>
                    <option value="users" {{ old('icon') == 'users' ? 'selected' : '' }}>Users</option>
                    <option value="heart" {{ old('icon') == 'heart' ? 'selected' : '' }}>Heart</option>
                    <option value="home" {{ old('icon') == 'home' ? 'selected' : '' }}>Home</option>
                    <option value="star" {{ old('icon') == 'star' ? 'selected' : '' }}>Star</option>
                    <option value="book" {{ old('icon') == 'book' ? 'selected' : '' }}>Book</option>
                    <option value="briefcase" {{ old('icon') == 'briefcase' ? 'selected' : '' }}>Briefcase</option>
                </select>
            </div>

            <!-- Color -->
            <div>
                <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Warna</label>
                <select id="color"
                        name="color"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih Warna</option>
                    <option value="blue" {{ old('color') == 'blue' ? 'selected' : '' }}>Biru</option>
                    <option value="green" {{ old('color') == 'green' ? 'selected' : '' }}>Hijau</option>
                    <option value="yellow" {{ old('color') == 'yellow' ? 'selected' : '' }}>Kuning</option>
                    <option value="red" {{ old('color') == 'red' ? 'selected' : '' }}>Merah</option>
                    <option value="purple" {{ old('color') == 'purple' ? 'selected' : '' }}>Ungu</option>
                    <option value="pink" {{ old('color') == 'pink' ? 'selected' : '' }}>Pink</option>
                    <option value="indigo" {{ old('color') == 'indigo' ? 'selected' : '' }}>Indigo</option>
                    <option value="teal" {{ old('color') == 'teal' ? 'selected' : '' }}>Teal</option>
                </select>
            </div>

            <!-- Status Aktif -->
            <div class="md:col-span-2">
                <div class="flex items-center">
                    <input type="checkbox"
                           id="is_active"
                           name="is_active"
                           value="1"
                           {{ old('is_active') ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">
                        Status Aktif
                    </label>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.pkk.program-kerja') }}"
               class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                Simpan Program Kerja
            </button>
        </div>
    </form>
</div>

<script>
function addKegiatan() {
    const container = document.getElementById('kegiatan-container');
    const div = document.createElement('div');
    div.className = 'kegiatan-item flex items-center gap-2 mb-2';
    div.innerHTML = `
        <input type="text"
               name="kegiatan[]"
               class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
               placeholder="Nama kegiatan"
               required>
        <button type="button" onclick="removeKegiatan(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    `;
    container.appendChild(div);
}

function removeKegiatan(button) {
    const container = document.getElementById('kegiatan-container');
    if (container.children.length > 1) {
        button.parentElement.remove();
    } else {
        alert('Minimal harus ada satu kegiatan');
    }
}
</script>
@endsection
