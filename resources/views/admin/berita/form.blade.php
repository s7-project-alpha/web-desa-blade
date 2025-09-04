{{-- resources/views/admin/berita/form.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-4 justify-between">
       <div>
            <h1 class="text-3xl font-bold text-gray-900">
                {{ isset($berita) ? 'Edit Berita' : 'Tulis Berita Baru' }}
            </h1>
            <p class="text-gray-600 mt-2">
                {{ isset($berita) ? 'Perbarui informasi berita' : 'Buat berita atau pengumuman baru' }}
            </p>
        </div>
        <a href="{{ route('admin.berita.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
        </svg>
        Kembali
    </a>
    </div>
</div>

<form action="{{ isset($berita) ? route('admin.berita.update', $berita) : route('admin.berita.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    @csrf
    @if(isset($berita))
        @method('PUT')
    @endif

    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Judul -->
        <div class="glass-card rounded-2xl p-6">
            <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                Judul <span class="text-red-500">*</span>
            </label>
            <input type="text"
                   id="judul"
                   name="judul"
                   value="{{ old('judul', $berita->judul ?? '') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('judul') border-red-500 @enderror"
                   placeholder="Masukkan judul berita yang menarik"
                   required>
            @error('judul')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Slug -->
        <div class="glass-card rounded-2xl p-6">
            <label for="slug" class="block text-sm font-semibold text-gray-700 mb-2">
                Slug <span class="text-gray-500 text-xs font-normal">(Otomatis dihasilkan)</span>
            </label>
            <input type="text"
                   id="slug"
                   name="slug"
                   value="{{ old('slug', $berita->slug ?? '') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('slug') border-red-500 @enderror"
                   placeholder="url-friendly-slug">
            @error('slug')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Ringkasan -->
        <div class="glass-card rounded-2xl p-6">
            <label for="ringkasan" class="block text-sm font-semibold text-gray-700 mb-2">
                Ringkasan <span class="text-red-500">*</span>
            </label>
            <textarea id="ringkasan"
                      name="ringkasan"
                      rows="3"
                      maxlength="500"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('ringkasan') border-red-500 @enderror"
                      placeholder="Tulis ringkasan singkat yang menarik (maksimal 500 karakter)"
                      required>{{ old('ringkasan', $berita->ringkasan ?? '') }}</textarea>
            <div class="flex justify-between items-center mt-2">
                @error('ringkasan')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @else
                    <span></span>
                @enderror
                <span id="ringkasan-count" class="text-sm text-gray-500">0/500</span>
            </div>
        </div>

        <!-- Konten -->
        <div class="glass-card rounded-2xl p-6">
            <label for="konten" class="block text-sm font-semibold text-gray-700 mb-2">
                Konten <span class="text-red-500">*</span>
            </label>
            <textarea id="konten"
                      name="konten"
                      rows="15"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('konten') border-red-500 @enderror"
                      placeholder="Tulis konten lengkap berita di sini..."
                      required>{{ old('konten', $berita->konten ?? '') }}</textarea>
            @error('konten')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tags -->
        <div class="glass-card rounded-2xl p-6">
            <label for="tags" class="block text-sm font-semibold text-gray-700 mb-2">
                Tags <span class="text-gray-500 text-xs font-normal">(Pisahkan dengan koma)</span>
            </label>
            <input type="text"
                   id="tags"
                   name="tags"
                   value="{{ old('tags', isset($berita->tags) ? implode(', ', $berita->tags ?? []) : '') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('tags') border-red-500 @enderror"
                   placeholder="pembangunan, infrastruktur, desa">
            @error('tags')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Publish Settings -->
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengaturan Publikasi</h3>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status"
                        name="status"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                    <option value="draft" {{ old('status', isset($berita) ? $berita->status : 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', isset($berita) ? $berita->status : '') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ old('status', isset($berita) ? $berita->status : '') === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Publikasi -->
            <div class="mb-4">
                <label for="tanggal_publikasi" class="block text-sm font-semibold text-gray-700 mb-2">
                    Tanggal Publikasi
                </label>
                <input type="date"
                       id="tanggal_publikasi"
                       name="tanggal_publikasi"
                       value="{{ old('tanggal_publikasi', isset($berita) && $berita->tanggal_publikasi ? $berita->tanggal_publikasi->format('Y-m-d') : now()->format('Y-m-d')) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_publikasi') border-red-500 @enderror">
                @error('tanggal_publikasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Berakhir (untuk pengumuman) -->
            <div class="mb-4" id="tanggal-berakhir-container" style="display: none;">
                <label for="tanggal_berakhir" class="block text-sm font-semibold text-gray-700 mb-2">
                    Tanggal Berakhir
                </label>
                <input type="date"
                       id="tanggal_berakhir"
                       name="tanggal_berakhir"
                       value="{{ old('tanggal_berakhir', isset($berita) && $berita->tanggal_berakhir ? $berita->tanggal_berakhir->format('Y-m-d') : '') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_berakhir') border-red-500 @enderror">
                @error('tanggal_berakhir')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Featured & Urgent -->
            <div class="space-y-4">
                <div class="flex items-center">
                    <input type="checkbox"
                           id="is_featured"
                           name="is_featured"
                           value="1"
                           {{ old('is_featured', isset($berita) ? $berita->is_featured : false) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="is_featured" class="ml-2 text-sm text-gray-700">Jadikan berita utama</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox"
                           id="is_urgent"
                           name="is_urgent"
                           value="1"
                           {{ old('is_urgent', isset($berita) ? $berita->is_urgent : false) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                    <label for="is_urgent" class="ml-2 text-sm text-gray-700">Pengumuman penting</label>
                </div>

                {{-- <div class="flex items-center">
                    <input type="checkbox"
                           id="allow_comments"
                           name="allow_comments"
                           value="1"
                           {{ old('allow_comments', isset($berita) ? $berita->allow_comments : true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="allow_comments" class="ml-2 text-sm text-gray-700">Izinkan komentar</label>
                </div> --}}
            </div>
        </div>

        <!-- Category & Type -->
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Kategori & Jenis</h3>

            <!-- Jenis -->
            <div class="mb-4">
                <label for="jenis" class="block text-sm font-semibold text-gray-700 mb-2">
                    Jenis <span class="text-red-500">*</span>
                </label>
                <select id="jenis"
                        name="jenis"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jenis') border-red-500 @enderror">
                    <option value="berita" {{ old('jenis', isset($berita) ? $berita->jenis : 'berita') === 'berita' ? 'selected' : '' }}>Berita</option>
                    <option value="pengumuman" {{ old('jenis', isset($berita) ? $berita->jenis : '') === 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                </select>
                @error('jenis')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label for="kategori_berita_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select id="kategori_berita_id"
                        name="kategori_berita_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kategori_berita_id') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $id => $nama)
                        <option value="{{ $id }}" {{ old('kategori_berita_id', isset($berita) ? $berita->kategori_berita_id : '') == $id ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_berita_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Gambar Utama -->
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Gambar Utama</h3>

            @if(isset($berita) && $berita->gambar_utama)
                <div class="mb-4">
                    <img src="{{ $berita->getGambarUtamaUrl() }}"
                         alt="Current image"
                         class="w-full h-48 object-cover rounded-lg">
                </div>
            @endif

            <input type="file"
                   id="gambar_utama"
                   name="gambar_utama"
                   accept="image/*"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('gambar_utama') border-red-500 @enderror">
            <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF. Maksimal 2MB</p>
            @error('gambar_utama')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Author Info -->
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Penulis</h3>

            <div class="mb-4">
                <label for="penulis" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Penulis <span class="text-gray-500 text-xs font-normal">(Opsional)</span>
                </label>
                <input type="text"
                       id="penulis"
                       name="penulis"
                       value="{{ old('penulis', isset($berita) ? $berita->penulis : '') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('penulis') border-red-500 @enderror"
                       placeholder="Kosongkan untuk menggunakan nama akun">
                @error('penulis')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sumber" class="block text-sm font-semibold text-gray-700 mb-2">
                    Sumber <span class="text-gray-500 text-xs font-normal">(Opsional)</span>
                </label>
                <input type="text"
                       id="sumber"
                       name="sumber"
                       value="{{ old('sumber', isset($berita) ? $berita->sumber : '') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('sumber') border-red-500 @enderror"
                       placeholder="Sumber berita">
                @error('sumber')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="glass-card rounded-2xl p-6">
            <div class="space-y-3">
                <button type="submit"
                        class="w-full btn-modern px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                    {{ isset($berita) ? 'Perbarui' : 'Simpan' }} Berita
                </button>

                <a href="{{ route('admin.berita.index') }}"
                   class="w-full inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const judulInput = document.getElementById('judul');
    const slugInput = document.getElementById('slug');
    const ringkasanInput = document.getElementById('ringkasan');
    const ringkasanCount = document.getElementById('ringkasan-count');
    const jenisSelect = document.getElementById('jenis');
    const tanggalBerakhirContainer = document.getElementById('tanggal-berakhir-container');

    // Auto generate slug
    judulInput.addEventListener('input', function() {
        if (!slugInput.value || slugInput.dataset.autoGenerated) {
            const slug = this.value.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            slugInput.value = slug;
            slugInput.dataset.autoGenerated = 'true';
        }
    });

    // Manual slug edit
    slugInput.addEventListener('input', function() {
        if (this.value) {
            slugInput.dataset.autoGenerated = 'false';
        }
    });

    // Character count for ringkasan
    function updateRingkasanCount() {
        const count = ringkasanInput.value.length;
        ringkasanCount.textContent = `${count}/500`;

        if (count > 500) {
            ringkasanCount.classList.add('text-red-500');
            ringkasanCount.classList.remove('text-gray-500');
        } else {
            ringkasanCount.classList.remove('text-red-500');
            ringkasanCount.classList.add('text-gray-500');
        }
    }

    ringkasanInput.addEventListener('input', updateRingkasanCount);
    updateRingkasanCount(); // Initial count

    // Show/hide tanggal berakhir based on jenis
    function toggleTanggalBerakhir() {
        if (jenisSelect.value === 'pengumuman') {
            tanggalBerakhirContainer.style.display = 'block';
        } else {
            tanggalBerakhirContainer.style.display = 'none';
        }
    }

    jenisSelect.addEventListener('change', toggleTanggalBerakhir);
    toggleTanggalBerakhir(); // Initial state

    // Image preview
    const gambarInput = document.getElementById('gambar_utama');
    if (gambarInput) {
        gambarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Remove existing preview if any
                    const existingPreview = document.getElementById('image-preview');
                    if (existingPreview) {
                        existingPreview.remove();
                    }

                    // Create new preview
                    const preview = document.createElement('div');
                    preview.id = 'image-preview';
                    preview.className = 'mb-4';
                    preview.innerHTML = `
                        <img src="${e.target.result}"
                             alt="Preview"
                             class="w-full h-48 object-cover rounded-lg">
                        <p class="text-xs text-gray-500 mt-2">Preview gambar baru</p>
                    `;

                    gambarInput.parentNode.insertBefore(preview, gambarInput);
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endsection
