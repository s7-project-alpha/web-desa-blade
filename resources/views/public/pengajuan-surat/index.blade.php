@extends('public.layouts.app')

@section('title', 'Pengajuan Surat - Desa Tanjung Selamat')
@section('description', 'Ajukan pembuatan surat secara online di Desa Tanjung Selamat')

@section('content')
<!-- Hero Section -->
<div class="py-14 bg-gradient-to-br from-blue-600 to-blue-900">
    <div class="min-h-[212px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl md:text-5xl font-bold text-white mb-4 animate-fadeInDown">
                Pengajuan Surat Online
            </h1>
            <p class="text-2xl text-white mb-8  animate-fadeInUp">
                Ajukan pembuatan surat secara online dengan mudah dan cepat
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <div class="flex items-center text-yellow-300 text-lg animate-fadeIn">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Proses Cepat
                </div>
                <div class="flex items-center text-yellow-300 animate-fadeIn">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Gratis
                </div>
                <div class="flex items-center text-yellow-300 animate-fadeIn">
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
    <div class="bg-blue-50 shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-blue-300 border-blue-400">
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
           class="inline-flex items-center px-6 py-3 bg-orange-400 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
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

<!-- Custom CSS for Animations -->
<style>
    /* Animations - hanya aktif ketika memiliki kelas 'animated' */
    .animate-fadeInDown {
        opacity: 0;
        transform: translateY(-20px);
    }

    .animate-fadeInUp {
        opacity: 0;
        transform: translateY(20px);
    }

    .animate-fadeIn {
        opacity: 0;
    }

    .animate-slideInLeft {
        opacity: 0;
        transform: translateX(-50px);
    }

    .animate-slideInRight {
        opacity: 0;
        transform: translateX(50px);
    }

    .animate-slideInUp {
        opacity: 0;
        transform: translateY(50px);
    }

    .animate-popIn {
        opacity: 0;
        transform: scale(0.8);
    }

    .animate-bounce {
        animation: bounce 1s infinite;
    }

    /* Animasi saat elemen muncul */
    .animate-fadeInDown.animated {
        animation: fadeInDown 0.8s ease-out forwards;
    }

    .animate-fadeInUp.animated {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-fadeIn.animated {
        animation: fadeIn 1s ease-out forwards;
    }

    .animate-slideInLeft.animated {
        animation: slideInLeft 0.8s ease-out forwards;
    }

    .animate-slideInRight.animated {
        animation: slideInRight 0.8s ease-out forwards;
    }

    .animate-slideInUp.animated {
        animation: slideInUp 0.8s ease-out forwards;
    }

    .animate-popIn.animated {
        animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    /* Efek hover scale */
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-scale:hover {
        transform: scale(1.03);
    }

    /* Keyframes untuk animasi */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes popIn {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        70% {
            opacity: 1;
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-15px);
        }
    }

    /* Animation Delays */
    .delay-50 { animation-delay: 50ms !important; }
    .delay-100 { animation-delay: 100ms !important; }
    .delay-150 { animation-delay: 150ms !important; }
    .delay-200 { animation-delay: 200ms !important; }
    .delay-250 { animation-delay: 250ms !important; }
    .delay-300 { animation-delay: 300ms !important; }
    .delay-350 { animation-delay: 350ms !important; }
    .delay-400 { animation-delay: 400ms !important; }
    .delay-450 { animation-delay: 450ms !important; }
</style>

<!-- JavaScript for Scroll Trigger Animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk animasi counter
    function animateCounters() {
        const counters = document.querySelectorAll('.counter');
        const speed = 200; // Durasi animasi dalam ms
        const options = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = +entry.target.getAttribute('data-target');
                    const prefix = entry.target.getAttribute('data-prefix') || '';
                    const suffix = entry.target.getAttribute('data-suffix') || '';
                    const count = entry.target;
                    const increment = target / speed;

                    let current = 0;

                    const updateCounter = () => {
                        current += increment;
                        if (current < target) {
                            count.textContent = prefix + Math.floor(current).toLocaleString('id-ID') + suffix;
                            setTimeout(updateCounter, 1);
                        } else {
                            count.textContent = prefix + target.toLocaleString('id-ID') + suffix;
                        }
                    };

                    updateCounter();
                    observer.unobserve(entry.target);
                }
            });
        }, options);

        counters.forEach(counter => {
            observer.observe(counter);
        });
    }

    // Fungsi untuk mengatur animasi saat scroll
    function setupScrollAnimations() {
        // Ambil semua elemen yang memiliki kelas animasi
        const animatedElements = document.querySelectorAll(
            '[class*="animate-"]'
        );

        // Buat Intersection Observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Tambahkan kelas 'animated' untuk memicu animasi
                    const element = entry.target;

                    // Handle delay inline style
                    let delay = element.style.animationDelay || '0ms';
                    delay = parseInt(delay) || 0;

                    setTimeout(() => {
                        element.classList.add('animated');

                        // Jika elemen adalah counter, jalankan animasi counter
                        if (element.classList.contains('counter')) {
                            animateCounters();
                        }
                    }, delay);

                    // Stop observing setelah animasi dipicu
                    observer.unobserve(element);
                }
            });
        }, {
            threshold: 0.1, // Trigger ketika 10% elemen terlihat
            rootMargin: '0px 0px -50px 0px' // Adjust untuk trigger lebih awal
        });

        // Observe semua elemen animasi
        animatedElements.forEach(el => {
            observer.observe(el);
        });
    }

    // Panggil fungsi setup
    setupScrollAnimations();
    animateCounters();
});
</script>
@endsection
