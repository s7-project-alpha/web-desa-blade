@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
        <a href="{{ route('admin.galeri.index') }}" class="hover:text-blue-600">Galeri</a>
        <span>/</span>
        <span class="text-gray-900">Tambah Galeri</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-900">Tambah Galeri</h1>
    <p class="text-gray-600">Upload foto baru ke galeri desa</p>
</div>

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-lg shadow">
    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column - Image Upload -->
            <div class="space-y-6">
                <!-- Photo Upload -->
                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                        Foto *
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition duration-200">
                        <div id="upload-area" class="cursor-pointer">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">
                                <span class="font-medium text-blue-600 hover:text-blue-500">Klik untuk upload</span> atau drag & drop
                            </p>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG, WEBP hingga 5MB</p>
                        </div>
                        <input type="file"
                               id="foto"
                               name="foto"
                               accept="image/*"
                               class="hidden @error('foto') border-red-500 @enderror"
                               required>
                    </div>
                    @error('foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Image Preview -->
                    <div id="image-preview" class="hidden mt-4">
                        <img id="preview-img" class="w-full h-64 object-cover rounded-lg border">
                        <button type="button" id="remove-image" class="mt-2 text-sm text-red-600 hover:text-red-800">
                            Hapus gambar
                        </button>
                    </div>
                </div>

                <!-- Photo Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Photographer -->
                    <div>
                        <label for="photographer" class="block text-sm font-medium text-gray-700 mb-2">
                            Fotografer
                        </label>
                        <input type="text"
                               id="photographer"
                               name="photographer"
                               value="{{ old('photographer') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('photographer') border-red-500 @enderror"
                               placeholder="Nama fotografer">
                        @error('photographer')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Foto -->
                    <div>
                        <label for="tanggal_foto" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Foto
                        </label>
                        <input type="date"
                               id="tanggal_foto"
                               name="tanggal_foto"
                               value="{{ old('tanggal_foto') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_foto') border-red-500 @enderror">
                        @error('tanggal_foto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Lokasi -->
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">
                        Lokasi
                    </label>
                    <input type="text"
                           id="lokasi"
                           name="lokasi"
                           value="{{ old('lokasi') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('lokasi') border-red-500 @enderror"
                           placeholder="Lokasi pengambilan foto">
                    @error('lokasi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Right Column - Form Fields -->
            <div class="space-y-6">
                <!-- Kategori -->
                <div>
                    <label for="kategori_galeri_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori *
                    </label>
                    <select id="kategori_galeri_id"
                            name="kategori_galeri_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kategori_galeri_id') border-red-500 @enderror"
                            required>
                        <option value="">Pilih Kategori</option>
                        @if(isset($kategoris) && $kategoris->count() > 0)
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_galeri_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        @else
                            <option value="" disabled>Belum ada kategori - <a href="{{ route('admin.kategori-galeri.create') }}">Buat kategori dulu</a></option>
                        @endif
                    </select>
                    @error('kategori_galeri_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @if(!isset($kategoris) || $kategoris->count() == 0)
                        <p class="mt-1 text-sm text-amber-600">
                            Belum ada kategori galeri.
                            <a href="{{ route('admin.kategori-galeri.create') }}" class="text-blue-600 hover:text-blue-800 underline">Buat kategori terlebih dahulu</a>
                        </p>
                    @endif
                </div>

                <!-- Judul -->
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul *
                    </label>
                    <input type="text"
                           id="judul"
                           name="judul"
                           value="{{ old('judul') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('judul') border-red-500 @enderror"
                           placeholder="Judul foto galeri"
                           required>
                    @error('judul')
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
                           placeholder="url-friendly-title">
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
                              placeholder="Deskripsi tentang foto ini...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alt Text -->
                <div>
                    <label for="alt_text" class="block text-sm font-medium text-gray-700 mb-2">
                        Alt Text
                        <span class="text-gray-500 text-xs">(Untuk SEO dan aksesibilitas)</span>
                    </label>
                    <input type="text"
                           id="alt_text"
                           name="alt_text"
                           value="{{ old('alt_text') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('alt_text') border-red-500 @enderror"
                           placeholder="Deskripsi singkat untuk screen reader">
                    @error('alt_text')
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
                           value="{{ old('urutan', isset($nextUrutan) ? $nextUrutan : 0) }}"
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('urutan') border-red-500 @enderror"
                           required>
                    <p class="mt-1 text-sm text-gray-500">Urutan tampil galeri (angka kecil tampil duluan)</p>
                    @error('urutan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Checkboxes -->
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="checkbox"
                               id="is_featured"
                               name="is_featured"
                               value="1"
                               {{ old('is_featured') ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Jadikan foto unggulan</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox"
                               id="is_active"
                               name="is_active"
                               value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Galeri aktif</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                Simpan Galeri
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const judulInput = document.getElementById('judul');
    const slugInput = document.getElementById('slug');
    const altTextInput = document.getElementById('alt_text');
    const fotoInput = document.getElementById('foto');
    const uploadArea = document.getElementById('upload-area');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const removeImageBtn = document.getElementById('remove-image');

    // Auto generate slug and alt text from judul
    if (judulInput && slugInput && altTextInput) {
        judulInput.addEventListener('input', function() {
            if (!slugInput.dataset.manual) {
                const slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
                slugInput.value = slug;
            }

            if (!altTextInput.dataset.manual) {
                altTextInput.value = this.value;
            }
        });

        // Mark fields as manually edited
        slugInput.addEventListener('input', function() {
            slugInput.dataset.manual = 'true';
        });

        altTextInput.addEventListener('input', function() {
            altTextInput.dataset.manual = 'true';
        });
    }

    // Handle file upload
    if (uploadArea && fotoInput && imagePreview && previewImg && removeImageBtn) {
        uploadArea.addEventListener('click', function() {
            fotoInput.click();
        });

        fotoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    uploadArea.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });

        removeImageBtn.addEventListener('click', function() {
            fotoInput.value = '';
            imagePreview.classList.add('hidden');
            uploadArea.style.display = 'block';
        });

        // Drag and drop functionality
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('border-blue-400', 'bg-blue-50');
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('border-blue-400', 'bg-blue-50');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('border-blue-400', 'bg-blue-50');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fotoInput.files = files;
                fotoInput.dispatchEvent(new Event('change'));
            }
        });
    }
});
</script>
@endsection
