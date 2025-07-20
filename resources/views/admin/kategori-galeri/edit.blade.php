@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
        <a href="{{ route('admin.kategori-galeri.index') }}" class="hover:text-blue-600">Kategori Galeri</a>
        <span>/</span>
        <a href="{{ route('admin.kategori-galeri.show', $kategoriGaleri) }}" class="hover:text-blue-600">{{ Str::limit($kategoriGaleri->nama_kategori, 20) }}</a>
        <span>/</span>
        <span class="text-gray-900">Edit</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-900">Edit Kategori Galeri</h1>
    <p class="text-gray-600">Ubah informasi kategori galeri</p>
</div>

<div class="bg-white rounded-lg shadow">
    <form action="{{ route('admin.kategori-galeri.update', $kategoriGaleri) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

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
                           value="{{ old('nama_kategori', $kategoriGaleri->nama_kategori) }}"
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
                           value="{{ old('slug', $kategoriGaleri->slug) }}"
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
                              placeholder="Deskripsi kategori galeri...">{{ old('deskripsi', $kategoriGaleri->deskripsi) }}</textarea>
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
                               value="{{ old('warna_badge', $kategoriGaleri->warna_badge) }}"
                               class="w-16 h-10 border border-gray-300 rounded-md cursor-pointer @error('warna_badge') border-red-500 @enderror">
                        <div class="flex-1">
                            <input type="text"
                                   id="warna_badge_text"
                                   value="{{ old('warna_badge', $kategoriGaleri->warna_badge) }}"
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
                           value="{{ old('urutan', $kategoriGaleri->urutan) }}"
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
                               {{ old('is_active', $kategoriGaleri->is_active) ? 'checked' : '' }}
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
                        <span id="badge_preview" class="inline-block px-3 py-1 rounded-full text-xs font-medium text-white" style="background-color: {{ $kategoriGaleri->warna_badge }};">
                            {{ $kategoriGaleri->nama_kategori }}
                        </span>
                    </div>
                </div>

                <!-- Current Stats -->
                <div class="p-4 bg-blue-50 rounded-lg">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Statistik Saat Ini</h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Total Galeri:</span>
                            <span class="font-medium text-blue-600">{{ $kategoriGaleri->galeri->count() }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Galeri Aktif:</span>
                            <span class="font-medium text-green-600">{{ $kategoriGaleri->galeri->where('is_active', true)->count() }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Dibuat:</span>
                            <span class="font-medium">{{ $kategoriGaleri->created_at->format('d M Y') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Diupdate:</span>
                            <span class="font-medium">{{ $kategoriGaleri->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
            <div class="flex space-x-3">
                <a href="{{ route('admin.kategori-galeri.show', $kategoriGaleri) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    ← Lihat Detail
                </a>
                <a href="{{ route('public.galeri.index', ['kategori' => $kategoriGaleri->slug]) }}" target="_blank" class="text-green-600 hover:text-green-800 font-medium">
                    Lihat di Website →
                </a>
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('admin.kategori-galeri.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                    Update Kategori
                </button>
            </div>
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

    // Auto generate slug from nama kategori (only if not manually edited)
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
