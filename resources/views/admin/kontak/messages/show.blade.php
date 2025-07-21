{{-- resources/views/admin/kontak/messages/show.blade.php --}}

@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Pesan Kontak</h1>
            <p class="text-gray-600 mt-1">Pesan dari {{ $kontakMessage->nama }}</p>
        </div>
        <div class="flex gap-3">

            <button onclick="toggleRead({{ $kontakMessage->id }})"
                    class="inline-flex items-center px-4 py-2 {{ $kontakMessage->is_read ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                </svg>
                {{ $kontakMessage->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}
            </button>
             <a href="{{ route('admin.kontak.messages.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
        </svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- Message Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 {{ !$kontakMessage->is_read ? 'bg-blue-50' : 'bg-gray-50' }}">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                        <span class="text-lg font-medium text-gray-600">
                            {{ substr($kontakMessage->nama, 0, 2) }}
                        </span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $kontakMessage->nama }}</h2>
                        <div class="flex items-center gap-2 mt-1">
                            <a href="mailto:{{ $kontakMessage->email }}"
                               class="text-blue-600 hover:text-blue-800 font-medium">
                                {{ $kontakMessage->email }}
                            </a>
                            @if($kontakMessage->telepon)
                            <span class="text-gray-400">•</span>
                            <a href="tel:{{ str_replace(['(', ')', ' ', '-'], '', $kontakMessage->telepon) }}"
                               class="text-green-600 hover:text-green-800 font-medium">
                                {{ $kontakMessage->telepon }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    @if(!$kontakMessage->is_read)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        Belum Dibaca
                    </span>
                    @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        Sudah Dibaca
                    </span>
                    @endif
                    <p class="text-sm text-gray-500 mt-1">{{ $kontakMessage->created_at_formatted }}</p>
                    @if($kontakMessage->read_at)
                    <p class="text-xs text-gray-400">Dibaca: {{ $kontakMessage->read_at->format('d M Y H:i') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Subject -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Subjek</h3>
            <p class="text-gray-700">{{ $kontakMessage->subjek }}</p>
        </div>

        <!-- Message Content -->
        <div class="px-6 py-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Pesan</h3>
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $kontakMessage->pesan }}</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <div class="flex justify-between items-center">
                <div class="flex gap-3">
                    <a href="mailto:{{ $kontakMessage->email }}?subject=Re: {{ urlencode($kontakMessage->subjek) }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        Balas via Email
                    </a>

                    @if($kontakMessage->telepon)
                    <a href="tel:{{ str_replace(['(', ')', ' ', '-'], '', $kontakMessage->telepon) }}"
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                        Telepon
                    </a>
                    @endif
                </div>

                <button onclick="deleteMessage({{ $kontakMessage->id }}, '{{ $kontakMessage->nama }}')"
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    Hapus Pesan
                </button>
            </div>
        </div>
    </div>

    <!-- Technical Information -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Informasi Teknis</h3>
        </div>
        <div class="px-6 py-4 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-medium text-gray-500">IP Address</label>
                    <p class="text-gray-900 font-mono">{{ $kontakMessage->ip_address ?: 'Tidak tersedia' }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Waktu Diterima</label>
                    <p class="text-gray-900">{{ $kontakMessage->created_at->format('d F Y, H:i:s') }} WIB</p>
                </div>
            </div>
            @if($kontakMessage->user_agent)
            <div>
                <label class="text-sm font-medium text-gray-500">User Agent</label>
                <p class="text-gray-900 text-sm break-all">{{ $kontakMessage->user_agent }}</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mt-3">Hapus Pesan</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Yakin ingin menghapus pesan dari <span id="messageName" class="font-medium"></span>?
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="confirmDelete"
                        class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300 mb-2">
                    Hapus
                </button>
                <button id="cancelDelete"
                        class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let deleteId = null;

function toggleRead(id) {
    // Fix: Gunakan URL yang benar dengan parameter
    const url = "{{ url('admin/kontak/messages') }}/" + id + "/toggle-read";

    fetch(url, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Terjadi kesalahan saat mengubah status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengubah status');
    });
}

function deleteMessage(id, name) {
    deleteId = id;
    document.getElementById('messageName').textContent = name;
    document.getElementById('deleteModal').classList.remove('hidden');
}

document.getElementById('confirmDelete').addEventListener('click', function() {
    if (deleteId) {
        // Fix: Gunakan URL yang benar dengan parameter
        const url = "{{ url('admin/kontak/messages') }}/" + deleteId;

        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("admin.kontak.messages.index") }}';
            } else {
                alert(data.message || 'Terjadi kesalahan saat menghapus pesan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus pesan');
        });
    }
    document.getElementById('deleteModal').classList.add('hidden');
});

document.getElementById('cancelDelete').addEventListener('click', function() {
    document.getElementById('deleteModal').classList.add('hidden');
    deleteId = null;
});
</script>
@endsection
