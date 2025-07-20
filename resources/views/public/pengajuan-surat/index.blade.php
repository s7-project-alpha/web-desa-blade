@extends('public.layouts.app')

@section('title', 'Pengajuan Surat - Desa Tanjung Selamat')
@section('description', 'Ajukan pembuatan surat secara online di Desa Tanjung Selamat')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Pengajuan Surat Online
            </h1>
            <p class="text-xl text-gray-600 mb-8">
                Ajukan pembuatan surat secara online dengan mudah dan cepat
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <div class="flex items-center text-green-600">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Proses Cepat
                </div>
                <div class="flex items-center text-green-600">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Gratis
                </div>
                <div class="flex items-center text-green-600">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Notifikasi WhatsApp
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Info Section -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-lg font-medium text-blue-800">Informasi Penting</h3>
                <div class="mt-2 text-sm text-blue-700 space-y-1">
                    <p>• Pastikan data yang diisi sudah benar sebelum mengirim pengajuan</p>
                    <p>• Anda akan mendapat notifikasi WhatsApp ketika surat sudah selesai</p>
                    <p>• Proses pembuatan surat membutuhkan waktu 1-3 hari kerja</p>
                    <p>• Surat dapat diambil di kantor desa pada jam kerja</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Form Pengajuan Surat</h2>
        </div>

        <form action="{{ route('public.pengajuan-surat.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Pilih Jenis Surat -->
            <div>
                <label for="jenis_surat" class="block text-sm font-medium text-gray-700 mb-2">
                    Jenis Surat <span class="text-red-500">*</span>
                </label>
                <select name="jenis_surat" id="jenis_surat" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Pilih Jenis Surat</option>
                    @foreach($jenisSuratOptions as $key => $label)
                        <option value="{{ $key }}" {{ old('jenis_surat') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('jenis_surat')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Informasi Pemohon -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pemohon</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Masukkan nama lengkap Anda">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nomor_whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nomor_whatsapp" id="nomor_whatsapp" value="{{ old('nomor_whatsapp') }}" required
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Contoh: 08123456789">
                        @error('nomor_whatsapp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Nomor ini akan digunakan untuk notifikasi status surat</p>
                    </div>
                </div>
            </div>

            <!-- Dynamic Form Fields -->
            <div id="dynamic-fields" class="border-t pt-6 hidden">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Data Surat</h3>
                <div id="dynamic-fields-container" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Dynamic fields will be loaded here -->
                </div>
            </div>

            <!-- Submit Button -->
            <div class="border-t pt-6">
                <button type="submit" id="submit-btn" disabled
                        class="w-full bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>

    <!-- Track Status -->
    <div class="mt-12 text-center">
        <p class="text-gray-600 mb-4">Sudah mengajukan surat sebelumnya?</p>
        <a href="{{ route('public.pengajuan-surat.track') }}"
           class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
            Lacak Status Pengajuan
        </a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisSuratSelect = document.getElementById('jenis_surat');
    const dynamicFields = document.getElementById('dynamic-fields');
    const dynamicFieldsContainer = document.getElementById('dynamic-fields-container');
    const submitBtn = document.getElementById('submit-btn');

    jenisSuratSelect.addEventListener('change', function() {
        const selectedJenis = this.value;

        if (selectedJenis) {
            // Show loading
            dynamicFieldsContainer.innerHTML = '<div class="col-span-2 text-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto"></div><p class="mt-2 text-gray-600">Memuat form...</p></div>';
            dynamicFields.classList.remove('hidden');

            // Fetch required fields
            fetch(`{{ route('public.pengajuan-surat.required-fields') }}?jenis_surat=${selectedJenis}`)
                .then(response => response.json())
                .then(data => {
                    generateDynamicFields(data.fields);
                    submitBtn.disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    dynamicFieldsContainer.innerHTML = '<div class="col-span-2 text-center py-8 text-red-600">Terjadi kesalahan saat memuat form</div>';
                });
        } else {
            dynamicFields.classList.add('hidden');
            submitBtn.disabled = true;
        }
    });

    function generateDynamicFields(fields) {
        let html = '';

        Object.entries(fields).forEach(([key, label]) => {
            const isFullWidth = ['alamat', 'keperluan', 'pengikut', 'tempat_tinggal'].includes(key);
            const colSpan = isFullWidth ? 'md:col-span-2' : '';

            if (key === 'jenis_kelamin') {
                html += `
                    <div class="${colSpan}">
                        <label for="data_surat_${key}" class="block text-sm font-medium text-gray-700 mb-2">
                            ${label} <span class="text-red-500">*</span>
                        </label>
                        <select name="data_surat[${key}]" id="data_surat_${key}" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" ${getOldValue(key) === 'Laki-laki' ? 'selected' : ''}>Laki-laki</option>
                            <option value="Perempuan" ${getOldValue(key) === 'Perempuan' ? 'selected' : ''}>Perempuan</option>
                        </select>
                    </div>
                `;
            } else if (key === 'agama') {
                html += `
                    <div class="${colSpan}">
                        <label for="data_surat_${key}" class="block text-sm font-medium text-gray-700 mb-2">
                            ${label} <span class="text-red-500">*</span>
                        </label>
                        <select name="data_surat[${key}]" id="data_surat_${key}" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Pilih Agama</option>
                            <option value="Islam" ${getOldValue(key) === 'Islam' ? 'selected' : ''}>Islam</option>
                            <option value="Kristen" ${getOldValue(key) === 'Kristen' ? 'selected' : ''}>Kristen</option>
                            <option value="Katolik" ${getOldValue(key) === 'Katolik' ? 'selected' : ''}>Katolik</option>
                            <option value="Hindu" ${getOldValue(key) === 'Hindu' ? 'selected' : ''}>Hindu</option>
                            <option value="Buddha" ${getOldValue(key) === 'Buddha' ? 'selected' : ''}>Buddha</option>
                            <option value="Konghucu" ${getOldValue(key) === 'Konghucu' ? 'selected' : ''}>Konghucu</option>
                        </select>
                    </div>
                `;
            } else if (key === 'status_perkawinan') {
                html += `
                    <div class="${colSpan}">
                        <label for="data_surat_${key}" class="block text-sm font-medium text-gray-700 mb-2">
                            ${label} <span class="text-red-500">*</span>
                        </label>
                        <select name="data_surat[${key}]" id="data_surat_${key}" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Pilih Status</option>
                            <option value="Belum Kawin" ${getOldValue(key) === 'Belum Kawin' ? 'selected' : ''}>Belum Kawin</option>
                            <option value="Kawin" ${getOldValue(key) === 'Kawin' ? 'selected' : ''}>Kawin</option>
                            <option value="Cerai Hidup" ${getOldValue(key) === 'Cerai Hidup' ? 'selected' : ''}>Cerai Hidup</option>
                            <option value="Cerai Mati" ${getOldValue(key) === 'Cerai Mati' ? 'selected' : ''}>Cerai Mati</option>
                        </select>
                    </div>
                `;
            } else if (key === 'tanggal_lahir') {
                html += `
                    <div class="${colSpan}">
                        <label for="data_surat_${key}" class="block text-sm font-medium text-gray-700 mb-2">
                            ${label} <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="data_surat[${key}]" id="data_surat_${key}" required
                               value="${getOldValue(key)}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                `;
            } else if (key === 'umur') {
                html += `
                    <div class="${colSpan}">
                        <label for="data_surat_${key}" class="block text-sm font-medium text-gray-700 mb-2">
                            ${label} <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="data_surat[${key}]" id="data_surat_${key}" required
                               value="${getOldValue(key)}" min="1" max="150"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Masukkan umur">
                    </div>
                `;
            } else if (isFullWidth) {
                html += `
                    <div class="${colSpan}">
                        <label for="data_surat_${key}" class="block text-sm font-medium text-gray-700 mb-2">
                            ${label} <span class="text-red-500">*</span>
                        </label>
                        <textarea name="data_surat[${key}]" id="data_surat_${key}" required rows="3"
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Masukkan ${label.toLowerCase()}">${getOldValue(key)}</textarea>
                    </div>
                `;
            } else {
                html += `
                    <div class="${colSpan}">
                        <label for="data_surat_${key}" class="block text-sm font-medium text-gray-700 mb-2">
                            ${label} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="data_surat[${key}]" id="data_surat_${key}" required
                               value="${getOldValue(key)}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Masukkan ${label.toLowerCase()}">
                    </div>
                `;
            }
        });

        dynamicFieldsContainer.innerHTML = html;
    }

    function getOldValue(key) {
        // Get old form values in case of validation errors
        @if(old('data_surat'))
            const oldData = @json(old('data_surat'));
            return oldData[key] || '';
        @endif
        return '';
    }

    // Auto-format WhatsApp number
    document.getElementById('nomor_whatsapp').addEventListener('input', function() {
        let value = this.value.replace(/\D/g, ''); // Remove non-digits
        if (value.startsWith('0')) {
            value = '62' + value.substring(1);
        }
        this.value = value;
    });
});
</script>
@endsection
