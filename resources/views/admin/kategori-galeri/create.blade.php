@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Kategori Galeri</h1>
        <p class="text-gray-600">Buat kategori baru untuk mengorganisir galeri desa</p>
    </div>
    <a href="{{ route('admin.kategori-galeri.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
        </svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <form action="{{ route('admin.kategori-galeri.store') }}" method="POST" class="p-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Nama Kategori -->
                <div>
                    <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Kategori *
                    </label>
                    <input type="text"
                           id="nama_kategori"
                           name="nama_kategori"
                           value="{{ old('nama_kategori') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_kategori') border-red-500 @enderror"
                           placeholder="Contoh: Kegiatan Desa"
                           required>
                    @error('nama_kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                        Slug
                        <span class="text-gray-500 text-xs">(Opsional, akan otomatis dibuat jika kosong)</span>
                    </label>
                    <input type="text"
                           id="slug"
                           name="slug"
                           value="{{ old('slug') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-500 @enderror"
                           placeholder="kegiatan-desa">
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea id="deskripsi"
                              name="deskripsi"
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('deskripsi') border-red-500 @enderror"
                              placeholder="Deskripsi kategori galeri...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Warna Badge -->
                <div>
                    <label for="warna_badge" class="block text-sm font-medium text-gray-700 mb-2">
                        Warna Badge *
                    </label>
                    <div class="flex items-center space-x-3">
                        <input type="color"
                               id="warna_badge"
                               name="warna_badge"
                               value="{{ old('warna_badge', '#3B82F6') }}"
                               class="w-16 h-10 border border-gray-300 rounded-md cursor-pointer @error('warna_badge') border-red-500 @enderror">
                        <div class="flex-1">
                            <input type="text"
                                   id="warna_badge_text"
                                   value="{{ old('warna_badge', '#3B82F6') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="#3B82F6"
                                   readonly>
                        </div>
                    </div>
                    @error('warna_badge')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Urutan -->
                <div>
                    <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                        Urutan *
                    </label>
                    <input type="number"
                           id="urutan"
                           name="urutan"
                           value="{{ old('urutan', $nextUrutan) }}"
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('urutan') border-red-500 @enderror"
                           required>
                    <p class="mt-1 text-sm text-gray-500">Urutan tampil kategori (angka kecil tampil duluan)</p>
                    @error('urutan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Aktif -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox"
                               id="is_active"
                               name="is_active"
                               value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Kategori aktif</span>
                    </label>
                    <p class="mt-1 text-sm text-gray-500">Kategori yang tidak aktif tidak akan tampil di website publik</p>
                </div>

                <!-- Preview Badge -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Preview Badge
                    </label>
                    <div class="border border-gray-200 rounded-md p-4 bg-gray-50">
                        <span id="badge_preview" class="inline-block px-3 py-1 rounded-full text-xs font-medium text-white" style="background-color: #3B82F6;">
                            Preview Kategori
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.kategori-galeri.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                Simpan Kategori
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const namaKategoriInput = document.getElementById('nama_kategori');
    const slugInput = document.getElementById('slug');
    const warnaBadgeInput = document.getElementById('warna_badge');
    const warnaBadgeTextInput = document.getElementById('warna_badge_text');
    const badgePreview = document.getElementById('badge_preview');

    // Auto generate slug from nama kategori
    namaKategoriInput.addEventListener('input', function() {
        if (!slugInput.dataset.manual) {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            slugInput.value = slug;
        }

        // Update badge preview text
        badgePreview.textContent = this.value || 'Preview Kategori';
    });

    // Mark slug as manually edited
    slugInput.addEventListener('input', function() {
        slugInput.dataset.manual = 'true';
    });

    // Update color preview
    warnaBadgeInput.addEventListener('input', function() {
        warnaBadgeTextInput.value = this.value;
        badgePreview.style.backgroundColor = this.value;
    });

    warnaBadgeTextInput.addEventListener('input', function() {
        if (/^#[0-9A-F]{6}$/i.test(this.value)) {
            warnaBadgeInput.value = this.value;
            badgePreview.style.backgroundColor = this.value;
        }
    });
});
</script>
@endsection
