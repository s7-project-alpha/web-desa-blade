{{-- resources/views/admin/kontak/edit-kontak.blade.php --}}

@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Informasi Kontak</h1>
            <p class="text-gray-600 mt-1">Perbarui informasi kontak kantor desa</p>
        </div>
        <a href="{{ route('admin.kontak.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
        </svg>
        Kembali
    </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <form action="{{ route('admin.kontak.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Informasi Kantor Desa</h2>
            </div>

            <div class="px-6 pb-6 space-y-6">
                <!-- Nama Kantor -->
                <div>
                    <label for="nama_kantor" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Kantor <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_kantor" name="nama_kantor" required
                           value="{{ old('nama_kantor', $kontak->nama_kantor) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                           placeholder="Nama kantor desa">
                    @error('nama_kantor')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Alamat -->
                    <div class="lg:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat" name="alamat" rows="3" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 resize-none"
                                  placeholder="Alamat lengkap kantor desa">{{ old('alamat', $kontak->alamat) }}</textarea>
                        @error('alamat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kecamatan -->
                    <div>
                        <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-2">
                            Kecamatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kecamatan" name="kecamatan" required
                               value="{{ old('kecamatan', $kontak->kecamatan) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                               placeholder="Nama kecamatan">
                        @error('kecamatan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kabupaten -->
                    <div>
                        <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-2">
                            Kabupaten <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kabupaten" name="kabupaten" required
                               value="{{ old('kabupaten', $kontak->kabupaten) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                               placeholder="Nama kabupaten">
                        @error('kabupaten')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Provinsi -->
                    <div>
                        <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Provinsi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="provinsi" name="provinsi" required
                               value="{{ old('provinsi', $kontak->provinsi) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                               placeholder="Nama provinsi">
                        @error('provinsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kode Pos -->
                    <div>
                        <label for="kode_pos" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Pos
                        </label>
                        <input type="text" id="kode_pos" name="kode_pos"
                               value="{{ old('kode_pos', $kontak->kode_pos) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                               placeholder="Kode pos">
                        @error('kode_pos')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Kontak Komunikasi</h3>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" required
                                   value="{{ old('email', $kontak->email) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                                   placeholder="email@desatanjungselamat.id">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">
                                Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="telepon" name="telepon" required
                                   value="{{ old('telepon', $kontak->telepon) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                                   placeholder="(061) 123-4567">
                            @error('telepon')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fax -->
                        <div>
                            <label for="fax" class="block text-sm font-medium text-gray-700 mb-2">
                                Fax
                            </label>
                            <input type="text" id="fax" name="fax"
                                   value="{{ old('fax', $kontak->fax) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                                   placeholder="(061) 123-4568">
                            @error('fax')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div>
                    <label for="jam_operasional" class="block text-sm font-medium text-gray-700 mb-2">
                        Jam Operasional <span class="text-red-500">*</span>
                    </label>
                    <textarea id="jam_operasional" name="jam_operasional" rows="4" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 resize-none"
                              placeholder="Senin - Jumat: 08:00 - 16:00 WIB">{{ old('jam_operasional', $kontak->jam_operasional) }}</textarea>
                    @error('jam_operasional')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Koordinat Lokasi (Opsional)</h3>
                    <p class="text-sm text-gray-600 mb-4">Koordinat akan digunakan untuk menampilkan lokasi pada peta</p>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Latitude -->
                        <div>
                            <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">
                                Latitude
                            </label>
                            <input type="number" id="latitude" name="latitude" step="any"
                                   value="{{ old('latitude', $kontak->latitude) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                                   placeholder="3.6485">
                            @error('latitude')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Longitude -->
                        <div>
                            <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">
                                Longitude
                            </label>
                            <input type="number" id="longitude" name="longitude" step="any"
                                   value="{{ old('longitude', $kontak->longitude) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                                   placeholder="98.6975">
                            @error('longitude')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 resize-none"
                              placeholder="Deskripsi tambahan tentang kantor desa">{{ old('deskripsi', $kontak->deskripsi) }}</textarea>
                    @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $kontak->is_active) ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-700">Aktif</span>
                    </label>
                    @error('is_active')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.kontak.index') }}"
                       class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
