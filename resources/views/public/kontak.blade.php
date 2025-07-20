{{-- resources/views/public/kontak.blade.php --}}

@extends('public.layouts.app')

@section('title', 'Kontak Kami - Desa Tanjung Selamat')
@section('description', 'Hubungi Desa Tanjung Selamat melalui berbagai cara. Alamat kantor, email, telepon, dan kontak pejabat desa.')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    Hubungi Kami
                </h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    Kami siap membantu Anda. Hubungi kami melalui berbagai cara di bawah ini atau kunjungi kantor desa.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($kontak)
        <!-- Informasi Kontak -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Alamat Kantor Desa -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Alamat Kantor Desa</h3>
                </div>
                <div class="text-gray-600 space-y-1">
                    <p class="font-medium">{{ $kontak->nama_kantor }}</p>
                    <p>{{ $kontak->alamat }}</p>
                    <p>{{ $kontak->kecamatan }}</p>
                    <p>{{ $kontak->kabupaten }}, {{ $kontak->provinsi }}</p>
                    @if($kontak->kode_pos)
                    <p>{{ $kontak->kode_pos }}</p>
                    @endif
                </div>
            </div>

            <!-- Email -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Email</h3>
                </div>
                <div class="text-gray-600">
                    <a href="mailto:{{ $kontak->email }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        {{ $kontak->email }}
                    </a>
                </div>
            </div>

            <!-- Telepon -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Telepon</h3>
                </div>
                <div class="text-gray-600">
                    <a href="tel:{{ str_replace(['(', ')', ' ', '-'], '', $kontak->telepon) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        {{ $kontak->telepon }}
                    </a>
                    @if($kontak->fax)
                    <p class="text-sm mt-1">Fax: {{ $kontak->fax }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Jam Operasional -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-12">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">Jam Operasional</h3>
            </div>
            <div class="text-gray-600 whitespace-pre-line text-lg leading-relaxed">
                {{ $kontak->jam_operasional }}
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Google Maps -->
            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-gray-900">Lokasi Kantor Desa</h2>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="aspect-w-16 aspect-h-12">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31725.84686616448!2d98.67750842089844!3d3.6485000000000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303131cc1c3eb2fd%3A0x23d431c8a8308c87!2sTanjung%20Selamat%2C%20Sunggal%2C%20Deli%20Serdang%20Regency%2C%20North%20Sumatra!5e0!3m2!1sen!2sid!4v1703123456789!5m2!1sen!2sid"
                            width="100%"
                            height="400"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="rounded-2xl">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Form Kontak -->
            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-gray-900">Kirim Pesan</h2>
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <form id="kontakForm" class="space-y-6">
                        @csrf
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                                   placeholder="Masukkan nama lengkap">
                            <div class="text-red-500 text-sm mt-1 hidden" id="nama-error"></div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                                   placeholder="email@example.com">
                            <div class="text-red-500 text-sm mt-1 hidden" id="email-error"></div>
                        </div>

                        <div>
                            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Telepon
                            </label>
                            <input type="tel" id="telepon" name="telepon"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                                   placeholder="08xxxxxxxxxx">
                            <div class="text-red-500 text-sm mt-1 hidden" id="telepon-error"></div>
                        </div>

                        <div>
                            <label for="subjek" class="block text-sm font-medium text-gray-700 mb-2">
                                Subjek <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="subjek" name="subjek" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                                   placeholder="Subjek pesan">
                            <div class="text-red-500 text-sm mt-1 hidden" id="subjek-error"></div>
                        </div>

                        <div>
                            <label for="pesan" class="block text-sm font-medium text-gray-700 mb-2">
                                Pesan <span class="text-red-500">*</span>
                            </label>
                            <textarea id="pesan" name="pesan" rows="5" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 resize-none"
                                      placeholder="Tulis pesan Anda di sini..."></textarea>
                            <div class="text-red-500 text-sm mt-1 hidden" id="pesan-error"></div>
                        </div>

                        <button type="submit" id="submitBtn"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-6 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span id="submitText">Kirim Pesan</span>
                            <span id="loadingText" class="hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Mengirim...
                            </span>
                        </button>
                    </form>

                    <!-- Alert Messages -->
                    <div id="alert-success" class="hidden mt-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span id="alert-success-message"></span>
                        </div>
                    </div>

                    <div id="alert-error" class="hidden mt-4 p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span id="alert-error-message"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($kontakPejabat && $kontakPejabat->count() > 0)
        <!-- Kontak Pejabat Desa -->
        <div class="mt-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Kontak Pejabat Desa</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Hubungi langsung pejabat desa untuk keperluan spesifik Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($kontakPejabat as $pejabat)
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="relative inline-block mb-6">
                        <img src="{{ $pejabat->foto_url }}"
                             alt="{{ $pejabat->nama }}"
                             class="w-24 h-24 rounded-full object-cover mx-auto shadow-lg">
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                            {{ $pejabat->initials }}
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $pejabat->nama }}</h3>
                    <p class="text-blue-600 font-medium mb-4">{{ $pejabat->jabatan }}</p>

                    @if($pejabat->deskripsi)
                    <p class="text-gray-600 text-sm mb-6">{{ $pejabat->deskripsi }}</p>
                    @endif

                    <div class="space-y-3">
                        <a href="tel:{{ str_replace(['(', ')', ' ', '-'], '', $pejabat->telepon) }}"
                           class="flex items-center justify-center w-full px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                            {{ $pejabat->telepon }}
                        </a>

                        <a href="mailto:{{ $pejabat->email }}"
                           class="flex items-center justify-center w-full px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            {{ $pejabat->email }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('kontakForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loadingText = document.getElementById('loadingText');
    const alertSuccess = document.getElementById('alert-success');
    const alertError = document.getElementById('alert-error');

    // Hide all error messages
    function hideErrors() {
        document.querySelectorAll('[id$="-error"]').forEach(error => {
            error.classList.add('hidden');
        });
    }

    // Show error for specific field
    function showError(field, message) {
        const errorElement = document.getElementById(field + '-error');
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
        }
    }

    // Show alert
    function showAlert(type, message) {
        hideAlerts();
        const alert = type === 'success' ? alertSuccess : alertError;
        const messageElement = document.getElementById(`alert-${type}-message`);
        messageElement.textContent = message;
        alert.classList.remove('hidden');

        // Auto hide after 5 seconds
        setTimeout(() => {
            alert.classList.add('hidden');
        }, 5000);
    }

    // Hide alerts
    function hideAlerts() {
        alertSuccess.classList.add('hidden');
        alertError.classList.add('hidden');
    }

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        hideErrors();
        hideAlerts();

        // Show loading state
        submitBtn.disabled = true;
        submitText.classList.add('hidden');
        loadingText.classList.remove('hidden');

        try {
            const formData = new FormData(form);

            const response = await fetch('{{ route("kontak.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const data = await response.json();

            if (data.success) {
                showAlert('success', data.message);
                form.reset();
            } else {
                if (data.errors) {
                    // Show validation errors
                    Object.keys(data.errors).forEach(field => {
                        showError(field, data.errors[field][0]);
                    });
                } else {
                    showAlert('error', data.message || 'Terjadi kesalahan saat mengirim pesan');
                }
            }
        } catch (error) {
            console.error('Error:', error);
            showAlert('error', 'Terjadi kesalahan jaringan. Silakan coba lagi.');
        } finally {
            // Hide loading state
            submitBtn.disabled = false;
            submitText.classList.remove('hidden');
            loadingText.classList.add('hidden');
        }
    });
});
</script>
@endsection
