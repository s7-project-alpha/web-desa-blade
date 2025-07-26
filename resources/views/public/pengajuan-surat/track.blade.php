@extends('public.layouts.app')

@section('title', 'Lacak Status Pengajuan - Desa Tanjung Selamat')
@section('description', 'Lacak status pengajuan surat Anda')

@section('content')
<!-- Hero Section -->
<div class="py-16 bg-gradient-to-r from-slate-500 to-slate-800 text-white">
    <div class="flex flex-col items-center justify-center min-h-[197px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl w-full">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 animate-fadeInDown">
                Lacak Status Pengajuan
            </h1>
            <p class="text-xl text-white mb-8 animate-fadeInUp">
                Masukkan nomor pengajuan untuk melihat status surat Anda
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Search Form -->
    <div class="bg-white shadow-lg rounded-lg p-8 mb-8">
        <div class="text-center mb-6 animate-fadeIn">
            <svg class="w-16 h-16 text-blue-600 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Lacak Pengajuan Surat</h2>
            <p class="text-gray-600">Masukkan nomor pengajuan untuk melihat status terkini</p>
        </div>

        <form id="trackForm" class="space-y-6">
            <div>
                <label for="nomor_pengajuan" class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor Pengajuan
                </label>
                <div class="relative">
                    <input type="text"
                           id="nomor_pengajuan"
                           name="nomor_pengajuan"
                           required
                           placeholder="Contoh: 20240315001"
                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-center font-mono text-lg">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zM7 10a1 1 0 011-1h.01a1 1 0 110 2H8a1 1 0 01-1-1zm3 0a1 1 0 011-1h.01a1 1 0 110 2H11a1 1 0 01-1-1z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <button type="submit"
                    id="searchBtn"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
                <span id="searchBtnText">Lacak Status</span>
            </button>
        </form>
    </div>

    <!-- Loading State -->
    <div id="loadingState" class="hidden bg-white shadow-lg rounded-lg p-8 text-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
        <p class="text-gray-600">Mencari data pengajuan...</p>
    </div>

    <!-- Not Found State -->
    <div id="notFoundState" class="hidden bg-white shadow-lg rounded-lg p-8 text-center">
        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 48 48">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5l4-4m0 0l4-4m-4 4l4 4m-4-4l-4 4"/>
        </svg>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Pengajuan Tidak Ditemukan</h3>
        <p class="text-gray-600 mb-4">Nomor pengajuan yang Anda masukkan tidak ditemukan dalam sistem.</p>
        <div class="text-sm text-gray-500 space-y-1">
            <p>• Pastikan nomor pengajuan yang dimasukkan benar</p>
            <p>• Periksa kembali nomor yang diberikan saat pengajuan</p>
            <p>• Hubungi kantor desa jika masalah berlanjut</p>
        </div>
    </div>

    <!-- Result State -->
    <div id="resultState" class="hidden bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900">Detail Pengajuan</h3>
        </div>

        <div class="p-6">
            <!-- Basic Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor Pengajuan</label>
                    <div id="result-nomor" class="mt-1 text-lg font-bold text-blue-600 font-mono"></div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Surat</label>
                    <div id="result-jenis" class="mt-1 text-gray-900"></div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Pemohon</label>
                    <div id="result-nama" class="mt-1 text-gray-900"></div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Pengajuan</label>
                    <div id="result-tanggal" class="mt-1 text-gray-900"></div>
                </div>
            </div>

            <!-- Status Progress -->
            <div class="mb-8">
                <h4 class="text-lg font-semibold text-gray-900 mb-6">Status Pengajuan</h4>
                <div class="flex items-center justify-between mb-4">
                    <!-- Step 1: Pending -->
                    <div class="flex flex-col items-center text-center step-indicator" data-step="pending">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2 step-circle">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium step-text">Diterima</span>
                    </div>

                    <!-- Progress Line 1 -->
                    <div class="flex-1 h-1 mx-2 bg-gray-200 progress-line" data-line="1"></div>

                    <!-- Step 2: Diproses -->
                    <div class="flex flex-col items-center text-center step-indicator" data-step="diproses">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2 step-circle">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium step-text">Diproses</span>
                    </div>

                    <!-- Progress Line 2 -->
                    <div class="flex-1 h-1 mx-2 bg-gray-200 progress-line" data-line="2"></div>

                    <!-- Step 3: Selesai -->
                    <div class="flex flex-col items-center text-center step-indicator" data-step="selesai">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2 step-circle">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium step-text">Selesai</span>
                    </div>
                </div>

                <!-- Current Status -->
                <div class="bg-gray-50 rounded-lg p-4 text-center">
                    <div class="text-lg font-semibold" id="current-status-text"></div>
                    <div class="text-sm text-gray-600 mt-1" id="current-status-desc"></div>
                </div>
            </div>

            <!-- Admin Notes -->
            <div id="admin-notes" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <h4 class="font-semibold text-blue-900 mb-2">Catatan Admin</h4>
                <p id="admin-notes-text" class="text-blue-800"></p>
            </div>

            <!-- Completion Info -->
            <div id="completion-info" class="hidden bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-green-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-green-900">Surat Sudah Selesai!</h4>
                        <p class="text-green-800 text-sm mt-1">Surat Anda sudah selesai dan dapat diambil di kantor desa.</p>
                        <p class="text-green-700 text-sm mt-2">
                            <strong>Tanggal Selesai:</strong> <span id="completion-date"></span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="font-semibold text-gray-900 mb-2">Informasi Kontak</h4>
                <div class="text-sm text-gray-700 space-y-1">
                    <p><strong>Alamat:</strong> Kantor Desa Tanjung Selamat</p>
                    <p><strong>Jam Operasional:</strong> Senin-Jumat, 08:00-15:00 WIB</p>
                    <p><strong>Telepon:</strong> (021) 1234-5678</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 text-center">
        <div class="inline-flex flex-col sm:flex-row gap-4">
            <a href="{{ route('public.pengajuan-surat.index') }}"
               class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                Ajukan Surat Baru
            </a>

            <a href="{{ route('public.kontak') }}"
               class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                </svg>
                Hubungi Kami
            </a>
        </div>
    </div>
</div>

<script>
document.getElementById('trackForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const nomorPengajuan = document.getElementById('nomor_pengajuan').value.trim();

    if (!nomorPengajuan) {
        alert('Mohon masukkan nomor pengajuan');
        return;
    }

    trackStatus(nomorPengajuan);
});

function trackStatus(nomorPengajuan) {
    // Show loading state
    hideAllStates();
    document.getElementById('loadingState').classList.remove('hidden');

    // Update button state
    const searchBtn = document.getElementById('searchBtn');
    const searchBtnText = document.getElementById('searchBtnText');
    searchBtn.disabled = true;
    searchBtnText.textContent = 'Mencari...';

    // Make API request
    fetch('{{ route("public.pengajuan-surat.check-status") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            nomor_pengajuan: nomorPengajuan
        })
    })
    .then(response => response.json())
    .then(data => {
        hideAllStates();

        if (data.found) {
            showResult(data.data);
        } else {
            document.getElementById('notFoundState').classList.remove('hidden');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        hideAllStates();
        alert('Terjadi kesalahan saat mencari data. Silakan coba lagi.');
    })
    .finally(() => {
        // Reset button state
        searchBtn.disabled = false;
        searchBtnText.textContent = 'Lacak Status';
    });
}

function hideAllStates() {
    document.getElementById('loadingState').classList.add('hidden');
    document.getElementById('notFoundState').classList.add('hidden');
    document.getElementById('resultState').classList.add('hidden');
}

function showResult(data) {
    // Populate basic info
    document.getElementById('result-nomor').textContent = data.nomor_pengajuan;
    document.getElementById('result-jenis').textContent = data.jenis_surat;
    document.getElementById('result-nama').textContent = data.nama;
    document.getElementById('result-tanggal').textContent = data.tanggal_pengajuan;

    // Update progress indicators
    updateProgressIndicators(data.status);

    // Show admin notes if available
    const adminNotes = document.getElementById('admin-notes');
    if (data.catatan_admin) {
        document.getElementById('admin-notes-text').textContent = data.catatan_admin;
        adminNotes.classList.remove('hidden');
    } else {
        adminNotes.classList.add('hidden');
    }

    // Show completion info if finished
    const completionInfo = document.getElementById('completion-info');
    if (data.status === 'selesai' && data.tanggal_selesai) {
        document.getElementById('completion-date').textContent = data.tanggal_selesai;
        completionInfo.classList.remove('hidden');
    } else {
        completionInfo.classList.add('hidden');
    }

    // Show result state
    document.getElementById('resultState').classList.remove('hidden');
}

function updateProgressIndicators(status) {
    // Reset all indicators
    document.querySelectorAll('.step-indicator').forEach(step => {
        const circle = step.querySelector('.step-circle');
        const text = step.querySelector('.step-text');
        circle.className = 'w-10 h-10 rounded-full flex items-center justify-center mb-2 step-circle bg-gray-200 text-gray-400';
        text.className = 'text-xs font-medium step-text text-gray-400';
    });

    document.querySelectorAll('.progress-line').forEach(line => {
        line.className = 'flex-1 h-1 mx-2 progress-line bg-gray-200';
    });

    // Current status text
    const statusText = document.getElementById('current-status-text');
    const statusDesc = document.getElementById('current-status-desc');

    // Update based on current status
    const steps = ['pending', 'diproses', 'selesai'];
    const currentStepIndex = steps.indexOf(status);

    // Mark completed steps
    for (let i = 0; i <= currentStepIndex; i++) {
        const step = document.querySelector(`[data-step="${steps[i]}"]`);
        if (step) {
            const circle = step.querySelector('.step-circle');
            const text = step.querySelector('.step-text');

            if (i === currentStepIndex) {
                // Current step
                circle.className = 'w-10 h-10 rounded-full flex items-center justify-center mb-2 step-circle bg-blue-500 text-white';
                text.className = 'text-xs font-medium step-text text-blue-600';
            } else {
                // Completed step
                circle.className = 'w-10 h-10 rounded-full flex items-center justify-center mb-2 step-circle bg-green-500 text-white';
                text.className = 'text-xs font-medium step-text text-green-600';
            }
        }

        // Mark completed progress lines
        if (i < currentStepIndex) {
            const line = document.querySelector(`[data-line="${i + 1}"]`);
            if (line) {
                line.className = 'flex-1 h-1 mx-2 progress-line bg-green-500';
            }
        }
    }

    // Set status text
    switch (status) {
        case 'pending':
            statusText.textContent = 'Menunggu Diproses';
            statusDesc.textContent = 'Pengajuan Anda sedang menunggu untuk diproses oleh admin';
            statusText.className = 'text-lg font-semibold text-yellow-600';
            break;
        case 'diproses':
            statusText.textContent = 'Sedang Diproses';
            statusDesc.textContent = 'Surat Anda sedang dalam tahap pembuatan';
            statusText.className = 'text-lg font-semibold text-blue-600';
            break;
        case 'selesai':
            statusText.textContent = 'Selesai - Siap Diambil';
            statusDesc.textContent = 'Surat sudah selesai dan dapat diambil di kantor desa';
            statusText.className = 'text-lg font-semibold text-green-600';
            break;
        case 'ditolak':
            statusText.textContent = 'Pengajuan Ditolak';
            statusDesc.textContent = 'Pengajuan tidak dapat diproses. Lihat catatan admin untuk detail';
            statusText.className = 'text-lg font-semibold text-red-600';
            break;
        default:
            statusText.textContent = 'Status Tidak Dikenal';
            statusDesc.textContent = 'Hubungi kantor desa untuk informasi lebih lanjut';
            statusText.className = 'text-lg font-semibold text-gray-600';
    }
}

// Auto-format nomor pengajuan input
document.getElementById('nomor_pengajuan').addEventListener('input', function() {
    // Remove any non-numeric characters and limit length
    this.value = this.value.replace(/\D/g, '').substring(0, 11);
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
