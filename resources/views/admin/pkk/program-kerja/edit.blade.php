@extends('admin.layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Edit Program Kerja PKK</h1>
        <p class="text-gray-600">Perbarui program kerja {{ $programKerja->nama_program }}</p>
    </div>
    <a href="{{ route('admin.pkk.program-kerja') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
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

<form action="{{ route('admin.pkk.program-kerja.update', $programKerja) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Informasi Program Kerja</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama_program" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Program <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="nama_program"
                       id="nama_program"
                       value="{{ old('nama_program', $programKerja->nama_program) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Contoh: Penghayatan dan Pengamalan Pancasila"
                       required>
            </div>

            <div>
                <label for="peserta_aktif" class="block text-sm font-medium text-gray-700 mb-2">
                    Peserta Aktif <span class="text-red-500">*</span>
                </label>
                <input type="number"
                       name="peserta_aktif"
                       id="peserta_aktif"
                       value="{{ old('peserta_aktif', $programKerja->peserta_aktif) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       min="0"
                       required>
            </div>
        </div>

        <div class="mt-6">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                Deskripsi Program <span class="text-red-500">*</span>
            </label>
            <textarea name="deskripsi"
                      id="deskripsi"
                      rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Deskripsi singkat tentang program kerja..."
                      required>{{ old('deskripsi', $programKerja->deskripsi) }}</textarea>
        </div>

        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Kegiatan Program <span class="text-red-500">*</span>
            </label>
            <div id="kegiatan-container">
                @php
                    $kegiatan = old('kegiatan', $programKerja->kegiatan ?? []);
                    $kegiatan = is_array($kegiatan) ? $kegiatan : [];
                @endphp

                @if(count($kegiatan) > 0)
                    @foreach($kegiatan as $item)
                        <div class="kegiatan-item flex items-center space-x-3 mb-3">
                            <input type="text"
                                   name="kegiatan[]"
                                   value="{{ $item }}"
                                   class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Nama kegiatan"
                                   required>
                            <button type="button"
                                    onclick="removeKegiatan(this)"
                                    class="p-2 text-red-600 hover:text-red-800 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="kegiatan-item flex items-center space-x-3 mb-3">
                        <input type="text"
                               name="kegiatan[]"
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nama kegiatan"
                               required>
                        <button type="button"
                                onclick="removeKegiatan(this)"
                                class="p-2 text-red-600 hover:text-red-800 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
            <button type="button"
                    onclick="addKegiatan()"
                    class="inline-flex items-center px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                Tambah Kegiatan
            </button>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                    Icon
                </label>
                <select name="icon"
                        id="icon"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="users" {{ old('icon', $programKerja->icon) == 'users' ? 'selected' : '' }}>Users</option>
                    <option value="heart" {{ old('icon', $programKerja->icon) == 'heart' ? 'selected' : '' }}>Heart</option>
                    <option value="home" {{ old('icon', $programKerja->icon) == 'home' ? 'selected' : '' }}>Home</option>
                    <option value="star" {{ old('icon', $programKerja->icon) == 'star' ? 'selected' : '' }}>Star</option>
                    <option value="book" {{ old('icon', $programKerja->icon) == 'book' ? 'selected' : '' }}>Book</option>
                    <option value="briefcase" {{ old('icon', $programKerja->icon) == 'briefcase' ? 'selected' : '' }}>Briefcase</option>
                    <option value="camera" {{ old('icon', $programKerja->icon) == 'camera' ? 'selected' : '' }}>Camera</option>
                    <option value="music" {{ old('icon', $programKerja->icon) == 'music' ? 'selected' : '' }}>Music</option>
                </select>
            </div>

            <div>
                <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
                    Warna
                </label>
                <select name="color"
                        id="color"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="blue" {{ old('color', $programKerja->color) == 'blue' ? 'selected' : '' }}>Blue</option>
                    <option value="green" {{ old('color', $programKerja->color) == 'green' ? 'selected' : '' }}>Green</option>
                    <option value="yellow" {{ old('color', $programKerja->color) == 'yellow' ? 'selected' : '' }}>Yellow</option>
                    <option value="red" {{ old('color', $programKerja->color) == 'red' ? 'selected' : '' }}>Red</option>
                    <option value="purple" {{ old('color', $programKerja->color) == 'purple' ? 'selected' : '' }}>Purple</option>
                    <option value="pink" {{ old('color', $programKerja->color) == 'pink' ? 'selected' : '' }}>Pink</option>
                    <option value="indigo" {{ old('color', $programKerja->color) == 'indigo' ? 'selected' : '' }}>Indigo</option>
                    <option value="teal" {{ old('color', $programKerja->color) == 'teal' ? 'selected' : '' }}>Teal</option>
                </select>
            </div>

            <div>
                <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                    Urutan <span class="text-red-500">*</span>
                </label>
                <input type="number"
                       name="urutan"
                       id="urutan"
                       value="{{ old('urutan', $programKerja->urutan) }}"
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
                       {{ old('is_active', $programKerja->is_active) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-600">Program kerja aktif</span>
            </label>
        </div>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.pkk.program-kerja') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
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

<script>
function addKegiatan() {
    const container = document.getElementById('kegiatan-container');
    const div = document.createElement('div');
    div.className = 'kegiatan-item flex items-center space-x-3 mb-3';
    div.innerHTML = `
        <input type="text"
               name="kegiatan[]"
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
               placeholder="Nama kegiatan"
               required>
        <button type="button"
                onclick="removeKegiatan(this)"
                class="p-2 text-red-600 hover:text-red-800 transition-colors duration-200">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    `;
    container.appendChild(div);
}

function removeKegiatan(button) {
    const container = document.getElementById('kegiatan-container');
    if (container.children.length > 1) {
        button.closest('.kegiatan-item').remove();
    }
}
</script>
@endsection
