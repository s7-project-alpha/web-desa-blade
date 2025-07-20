@extends('public.layouts.app')

@section('title', 'Pengajuan Berhasil - Desa Tanjung Selamat')
@section('description', 'Pengajuan surat Anda berhasil dikirim')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Success Header -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-8 text-center">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Pengajuan Berhasil!</h1>
                <p class="text-green-100 text-lg">Pengajuan surat Anda telah berhasil dikirim</p>
            </div>

            <!-- Content -->
            <div class="p-8">
                <!-- Pengajuan Details -->
                <div class="bg-gray-50 rounded-xl p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Detail Pengajuan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Pengajuan</label>
                            <div class="mt-1 text-lg font-bold text-blue-600 font-mono">{{ $pengajuan->nomor_pengajuan }}</div>
                            <p class="text-xs text-gray-500 mt-1">Simpan nomor ini untuk melacak status pengajuan</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Surat</label>
                            <div class="mt-1 text-gray-900">{{ $pengajuan->jenis_surat_label }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Pemohon</label>
                            <div class="mt-1 text-gray-900">{{ $pengajuan->nama }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                            <div class="mt-1 text-gray-900">{{ $pengajuan->nomor_whatsapp }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Pengajuan</label>
                            <div class="mt-1 text-gray-900">{{ $pengajuan->tanggal_pengajuan->format('d F Y, H:i') }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <div class="mt-1">
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $pengajuan->status_badge_class }}">
                                    {{ $pengajuan->status_label }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
                    <h3 class="text-lg font-semibold text-blue-900 mb-4">Langkah Selanjutnya</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">1</div>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-medium text-blue-900">Pengajuan Diproses</h4>
                                <p class="text-blue-700 text-sm">Tim admin akan memproses pengajuan Anda dalam 1-3 hari kerja</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">2</div>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-medium text-blue-900">Notifikasi WhatsApp</h4>
                                <p class="text-blue-700 text-sm">Anda akan mendapat notifikasi via WhatsApp ketika surat sudah selesai</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">3</div>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-medium text-blue-900">Ambil Surat</h4>
                                <p class="text-blue-700 text-sm">Datang ke kantor desa untuk mengambil surat dengan membawa identitas diri</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Important Info -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-yellow-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-yellow-800">Informasi Penting</h3>
                            <div class="mt-2 text-sm text-yellow-700 space-y-1">
                                <p>• <strong>Simpan nomor pengajuan</strong> untuk melacak status surat Anda</p>
                                <p>• <strong>Pastikan nomor WhatsApp aktif</strong> untuk menerima notifikasi</p>
                                <p>• <strong>Bawa identitas diri</strong> saat mengambil surat di kantor desa</p>
                                <p>• <strong>Jam operasional:</strong> Senin-Jumat, 08:00-15:00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button onclick="copyNomorPengajuan()"
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"></path>
                            <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"></path>
                        </svg>
                        Salin Nomor Pengajuan
                    </button>

                    <a href="{{ route('public.pengajuan-surat.track') }}"
                       class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                        Lacak Status
                    </a>

                    <a href="{{ route('public.pengajuan-surat.index') }}"
                       class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Ajukan Surat Lain
                    </a>
                </div>

                <!-- Back to Home -->
                <div class="text-center mt-8">
                    <a href="{{ route('public.home') }}"
                       class="text-gray-600 hover:text-gray-800 text-sm">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="fixed top-4 right-4 z-50 hidden">
    <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            <span>Nomor pengajuan berhasil disalin!</span>
        </div>
    </div>
</div>

<script>
function copyNomorPengajuan() {
    const nomorPengajuan = '{{ $pengajuan->nomor_pengajuan }}';

    // Try to use modern clipboard API
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(nomorPengajuan).then(function() {
            showToast();
        }).catch(function() {
            fallbackCopyTextToClipboard(nomorPengajuan);
        });
    } else {
        fallbackCopyTextToClipboard(nomorPengajuan);
    }
}

function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;

    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        const successful = document.execCommand('copy');
        if (successful) {
            showToast();
        }
    } catch (err) {
        console.error('Fallback: Oops, unable to copy', err);
    }

    document.body.removeChild(textArea);
}

function showToast() {
    const toast = document.getElementById('toast');
    toast.classList.remove('hidden');

    setTimeout(function() {
        toast.classList.add('hidden');
    }, 3000);
}

// Auto-copy nomor pengajuan on page load (optional)
document.addEventListener('DOMContentLoaded', function() {
    // You can uncomment the line below to auto-copy on page load
    // copyNomorPengajuan();
});
</script>
@endsection
