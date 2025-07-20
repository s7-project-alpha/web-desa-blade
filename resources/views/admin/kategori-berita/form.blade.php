{{-- resources/views/admin/kategori-berita/form.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.kategori-berita.index') }}"
           class="p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                {{ isset($kategoriBerita) ? 'Edit Kategori Berita' : 'Tambah Kategori Berita' }}
            </h1>
            <p class="text-gray-600 mt-2">
                {{ isset($kategoriBerita) ? 'Perbarui informasi kategori berita' : 'Buat kategori baru untuk mengorganisir berita' }}
            </p>
        </div>
    </div>
</div>

<div class="glass-card rounded-2xl shadow-xl p-8">
    <form action="{{ isset($kategoriBerita) ? route('admin.kategori-berita.update', $kategoriBerita) : route('admin.kategori-berita.store') }}"
          method="POST" class="space-y-6">
        @csrf
        @if(isset($kategoriBerita))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Nama Kategori -->
            <div class="lg:col-span-1">
                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       id="nama"
                       name="nama"
                       value="{{ old('nama', $kategoriBerita->nama ?? '') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nama') border-red-500 @enderror"
                       placeholder="Masukkan nama kategori"
                       required>
                @error('nama')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug -->
            <div class="lg:col-span-1">
                <label for="slug" class="block text-sm font-semibold text-gray-700 mb-2">
                    Slug
                    <span class="text-gray-500 text-xs font-normal">(Otomatis dihasilkan jika kosong)</span>
                </label>
                <input type="text"
                       id="slug"
                       name="slug"
                       value="{{ old('slug', $kategoriBerita->slug ?? '') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('slug') border-red-500 @enderror"
                       placeholder="kategori-slug">
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                Deskripsi
            </label>
            <textarea id="deskripsi"
                      name="deskripsi"
                      rows="3"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('deskripsi') border-red-500 @enderror"
                      placeholder="Deskripsi singkat tentang kategori ini">{{ old('deskripsi', $kategoriBerita->deskripsi ?? '') }}</textarea>
            @error('deskripsi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Warna -->
            <div>
                <label for="warna" class="block text-sm font-semibold text-gray-700 mb-2">
                    Warna Kategori <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center space-x-3">
                    <input type="color"
                           id="warna"
                           name="warna"
                           value="{{ old('warna', $kategoriBerita->warna ?? '#3B82F6') }}"
                           class="w-12 h-12 border-2 border-gray-300 rounded-lg cursor-pointer @error('warna') border-red-500 @enderror">
                    <input type="text"
                           id="warna_text"
                           value="{{ old('warna', $kategoriBerita->warna ?? '#3B82F6') }}"
                           class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 font-mono text-sm"
                           placeholder="#3B82F6"
                           readonly>
                </div>
                @error('warna')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Icon -->
            <div>
                <label for="icon" class="block text-sm font-semibold text-gray-700 mb-2">
                    Icon CSS Class
                    <span class="text-gray-500 text-xs font-normal">(Opsional)</span>
                </label>
                <input type="text"
                       id="icon"
                       name="icon"
                       value="{{ old('icon', $kategoriBerita->icon ?? '') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('icon') border-red-500 @enderror"
                       placeholder="fas fa-newspaper">
                @error('icon')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Urutan -->
            <div>
                <label for="urutan" class="block text-sm font-semibold text-gray-700 mb-2">
                    Urutan
                </label>
                <input type="number"
                       id="urutan"
                       name="urutan"
                       value="{{ old('urutan', $kategoriBerita->urutan ?? 0) }}"
                       min="0"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('urutan') border-red-500 @enderror"
                       placeholder="0">
                @error('urutan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Preview -->
        <div class="bg-gray-50 rounded-xl p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Preview Kategori</h3>
            <div id="preview" class="flex items-center space-x-3 p-4 bg-white rounded-lg border">
                <div id="preview-icon" class="w-10 h-10 rounded-xl flex items-center justify-center text-white" style="background-color: {{ old('warna', $kategoriBerita->warna ?? '#3B82F6') }};">
                    @if(old('icon', $kategoriBerita->icon ?? ''))
                        <i class="{{ old('icon', $kategoriBerita->icon ?? '') }}"></i>
                    @else
                        <div class="w-4 h-4 rounded-full bg-white"></div>
                    @endif
                </div>
                <div>
                    <div id="preview-nama" class="font-medium text-gray-900">
                        {{ old('nama', $kategoriBerita->nama ?? 'Nama Kategori') }}
                    </div>
                    <div id="preview-deskripsi" class="text-sm text-gray-500">
                        {{ old('deskripsi', $kategoriBerita->deskripsi ?? 'Deskripsi kategori akan muncul di sini') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4 pt-6">
            <a href="{{ route('admin.kategori-berita.index') }}"
               class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors duration-200">
                Batal
            </a>
            <button type="submit"
                    class="btn-modern px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                {{ isset($kategoriBerita) ? 'Perbarui' : 'Simpan' }} Kategori
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const namaInput = document.getElementById('nama');
    const slugInput = document.getElementById('slug');
    const deskripsiInput = document.getElementById('deskripsi');
    const warnaInput = document.getElementById('warna');
    const warnaTextInput = document.getElementById('warna_text');
    const iconInput = document.getElementById('icon');

    const previewNama = document.getElementById('preview-nama');
    const previewDeskripsi = document.getElementById('preview-deskripsi');
    const previewIcon = document.getElementById('preview-icon');

    // Auto generate slug
    namaInput.addEventListener('input', function() {
        if (!slugInput.value || slugInput.dataset.autoGenerated) {
            const slug = this.value.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            slugInput.value = slug;
            slugInput.dataset.autoGenerated = 'true';
        }
        previewNama.textContent = this.value || 'Nama Kategori';
    });

    // Manual slug edit
    slugInput.addEventListener('input', function() {
        if (this.value) {
            slugInput.dataset.autoGenerated = 'false';
        }
    });

    // Update preview description
    deskripsiInput.addEventListener('input', function() {
        previewDeskripsi.textContent = this.value || 'Deskripsi kategori akan muncul di sini';
    });

    // Color picker sync
    warnaInput.addEventListener('input', function() {
        warnaTextInput.value = this.value;
        previewIcon.style.backgroundColor = this.value;
    });

    // Icon preview
    iconInput.addEventListener('input', function() {
        const iconElement = previewIcon.querySelector('i, div');
        if (this.value) {
            previewIcon.innerHTML = `<i class="${this.value}"></i>`;
        } else {
            previewIcon.innerHTML = '<div class="w-4 h-4 rounded-full bg-white"></div>';
        }
    });
});
</script>
@endsection
