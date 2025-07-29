@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Pengajuan Surat</h1>
            <p class="text-gray-600 mt-2">Kelola pengajuan surat dari masyarakat</p>
        </div>
        <div class="flex items-center space-x-3">
            <button id="bulk-action-btn" class="hidden bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Update Massal (<span id="selected-count">0</span>)
            </button>
        </div>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="mb-6 glass-card rounded-2xl p-4 bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-emerald-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-emerald-800 font-medium">{{ session('success') }}</span>
        </div>
    </div>
@endif

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="glass-card rounded-2xl p-6 card-hover">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total Pengajuan</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $statistics['total'] }}</p>
            </div>
        </div>
    </div>

    <div class="glass-card rounded-2xl p-6 card-hover">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Menunggu</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $statistics['pending'] }}</p>
            </div>
        </div>
    </div>

    <div class="glass-card rounded-2xl p-6 card-hover">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Diproses</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $statistics['diproses'] }}</p>
            </div>
        </div>
    </div>

    <div class="glass-card rounded-2xl p-6 card-hover">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Selesai</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $statistics['selesai'] }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="glass-card rounded-2xl p-6 mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor, nama, atau WhatsApp..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
            <select name="jenis_surat" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Jenis</option>
                @foreach($jenisSuratOptions as $key => $label)
                    <option value="{{ $key }}" {{ request('jenis_surat') == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                Filter
            </button>
        </div>
    </form>
</div>

<!-- Data Table -->
<div class="glass-card rounded-2xl shadow-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left">
                        <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Pengajuan</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Surat</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($pengajuanSurat as $item)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4">
                            <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $item->nomor_pengajuan }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                                <div class="text-sm text-gray-500">{{ $item->nomor_whatsapp }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $item->jenis_surat_label }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->status_badge_class }}">
                                {{ $item->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->tanggal_pengajuan->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.pengajuan-surat.show', $item) }}" class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>

                                <button onclick="openUpdateStatusModal({{ $item->id }}, '{{ $item->status }}')" class="text-amber-600 hover:text-amber-900 p-2 rounded-lg hover:bg-amber-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>

                                <button onclick="confirmDelete({{ $item->id }})" class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada pengajuan surat</h3>
                                <p class="text-gray-500 mb-4">Belum ada pengajuan surat dari masyarakat.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($pengajuanSurat->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $pengajuanSurat->links() }}
        </div>
    @endif
</div>

<!-- Modal Update Status Massal -->
<div id="bulk-update-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Update Status Massal</h3>

            <form id="bulk-update-form" class="mt-4 space-y-4">
                @csrf
                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Baru</label>
                    <select id="bulk-status" name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Status</option>
                        <option value="pending">Menunggu</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea id="bulk-catatan" name="catatan_admin" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tambahkan catatan jika diperlukan"></textarea>
                </div>

                <div class="text-sm text-gray-600">
                    <span id="bulk-selected-count">0</span> pengajuan akan diupdate
                </div>
            </form>

            <div class="items-center px-4 py-3">
                <button id="confirm-bulk-update" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-24 hover:bg-blue-600">
                    Update
                </button>
                <button onclick="closeBulkUpdateModal()" class="ml-2 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-24 hover:bg-gray-400">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Status Individual -->
<div id="update-status-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Update Status</h3>

            <form id="update-status-form" method="POST" class="mt-4 space-y-4">
                @csrf
                @method('PATCH')

                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Baru</label>
                    <select id="single-status" name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="pending">Menunggu</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin</label>
                    <textarea name="catatan_admin" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tambahkan catatan jika diperlukan"></textarea>
                </div>

                <div class="items-center px-4 py-3">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-24 hover:bg-blue-600">
                        Update
                    </button>
                    <button type="button" onclick="closeUpdateStatusModal()" class="ml-2 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-24 hover:bg-gray-400">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="delete-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>

            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Hapus Pengajuan</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin menghapus pengajuan ini? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>

            <div class="items-center px-4 py-3">
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-24 hover:bg-red-600">
                        Hapus
                    </button>
                </form>
                <button onclick="closeDeleteModal()" class="ml-2 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-24 hover:bg-gray-400">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('select-all');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');
    const bulkActionBtn = document.getElementById('bulk-action-btn');
    const selectedCount = document.getElementById('selected-count');

    // Handle select all checkbox
    selectAll.addEventListener('change', function() {
        itemCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkActionButton();
    });

    // Handle individual checkboxes
    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActionButton);
    });

    // Update bulk action button visibility and count
    function updateBulkActionButton() {
        const checkedItems = document.querySelectorAll('.item-checkbox:checked');
        const count = checkedItems.length;

        selectedCount.textContent = count;

        if (count > 0) {
            bulkActionBtn.classList.remove('hidden');
        } else {
            bulkActionBtn.classList.add('hidden');
        }

        // Update select all state
        selectAll.indeterminate = count > 0 && count < itemCheckboxes.length;
        selectAll.checked = count === itemCheckboxes.length;
    }

    // Bulk action button click
    bulkActionBtn.addEventListener('click', function() {
        const checkedItems = document.querySelectorAll('.item-checkbox:checked');
        if (checkedItems.length === 0) {
            alert('Pilih minimal satu pengajuan');
            return;
        }
        openBulkUpdateModal();
    });

    // Bulk update form submission
    document.getElementById('confirm-bulk-update').addEventListener('click', function() {
        const checkedItems = document.querySelectorAll('.item-checkbox:checked');
        const status = document.getElementById('bulk-status').value;
        const catatan = document.getElementById('bulk-catatan').value;

        if (!status) {
            alert('Pilih status terlebih dahulu');
            return;
        }

        if (checkedItems.length === 0) {
            alert('Pilih minimal satu pengajuan');
            return;
        }

        // Prepare form data
        const formData = new FormData();
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
        formData.append('status', status);
        formData.append('catatan_admin', catatan);

        // Add selected IDs
        const ids = [];
        checkedItems.forEach(checkbox => {
            ids.push(checkbox.value);
        });

        ids.forEach(id => {
            formData.append('ids[]', id);
        });

        // Submit request
        fetch('{{ route("admin.pengajuan-surat.bulk-update-status") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memproses permintaan');
        });

        closeBulkUpdateModal();
    });
});

// Modal functions
function openBulkUpdateModal() {
    const checkedItems = document.querySelectorAll('.item-checkbox:checked');
    document.getElementById('bulk-selected-count').textContent = checkedItems.length;
    document.getElementById('bulk-update-modal').classList.remove('hidden');
}

function closeBulkUpdateModal() {
    document.getElementById('bulk-update-modal').classList.add('hidden');
    document.getElementById('bulk-status').value = '';
    document.getElementById('bulk-catatan').value = '';
}

function openUpdateStatusModal(id, currentStatus) {
    const form = document.getElementById('update-status-form');
    form.action = `/admin/pengajuan-surat/${id}/update-status`;
    document.getElementById('single-status').value = currentStatus;
    document.getElementById('update-status-modal').classList.remove('hidden');
}

function closeUpdateStatusModal() {
    document.getElementById('update-status-modal').classList.add('hidden');
}

function confirmDelete(id) {
    const form = document.getElementById('delete-form');
    form.action = `/admin/pengajuan-surat/${id}`;
    document.getElementById('delete-modal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('delete-modal').classList.add('hidden');
}
</script>

@endsection
