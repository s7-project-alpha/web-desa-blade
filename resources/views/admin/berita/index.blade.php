{{-- resources/views/admin/berita/index.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Berita & Pengumuman</h1>
            <p class="text-gray-600 mt-2">Kelola berita dan pengumuman untuk masyarakat</p>
        </div>
        <a href="{{ route('admin.berita.create') }}"
           class="btn-modern inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Tulis Berita
        </a>
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
<div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
    <div class="glass-card rounded-2xl p-6 card-hover">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $statistics['total'] }}</p>
            </div>
        </div>
    </div>

    <div class="glass-card rounded-2xl p-6 card-hover">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Published</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $statistics['published'] }}</p>
            </div>
        </div>
    </div>

    <div class="glass-card rounded-2xl p-6 card-hover">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1V8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Draft</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $statistics['draft'] }}</p>
            </div>
        </div>
    </div>

    <div class="glass-card rounded-2xl p-6 card-hover">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Featured</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $statistics['featured'] }}</p>
            </div>
        </div>
    </div>

    <div class="glass-card rounded-2xl p-6 card-hover">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Views</h3>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($statistics['total_views']) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="glass-card rounded-2xl p-6 mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari judul, konten..."
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Status</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
            <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $id => $nama)
                    <option value="{{ $id }}" {{ request('kategori') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis</label>
            <select name="jenis" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Jenis</option>
                <option value="berita" {{ request('jenis') == 'berita' ? 'selected' : '' }}>Berita</option>
                <option value="pengumuman" {{ request('jenis') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
            </select>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                Filter
            </button>
            <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Bulk Actions -->
<div class="glass-card rounded-2xl p-4 mb-6 hidden" id="bulk-actions">
    <div class="flex items-center justify-between">
        <span class="text-sm text-gray-600">
            <span id="selected-count">0</span> item dipilih
        </span>
        <div class="flex space-x-2">
            <button onclick="bulkAction('publish')" class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                Publish
            </button>
            <button onclick="bulkAction('unpublish')" class="px-3 py-1 bg-orange-600 text-white text-sm rounded hover:bg-orange-700">
                Unpublish
            </button>
            <button onclick="bulkAction('toggle_featured')" class="px-3 py-1 bg-purple-600 text-white text-sm rounded hover:bg-purple-700">
                Toggle Featured
            </button>
            <button onclick="bulkAction('delete')" class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                Hapus
            </button>
        </div>
    </div>
</div>

<!-- Berita Table -->
<div class="glass-card rounded-2xl shadow-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left">
                        <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berita</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stats</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($beritas as $berita)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4">
                            <input type="checkbox" name="selected_items[]" value="{{ $berita->id }}" class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-16 h-16">
                                    <img src="{{ $berita->getGambarUtamaUrl() }}"
                                         alt="{{ $berita->judul }}"
                                         class="w-16 h-16 object-cover rounded-lg">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">
                                        {{ $berita->judul }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                                        {{ $berita->ringkasan }}
                                    </p>
                                    <div class="flex items-center space-x-2 mt-2">
                                        {!! $berita->jenis_badge !!}
                                        @if($berita->is_featured)
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">
                                                ⭐ Featured
                                            </span>
                                        @endif
                                        @if($berita->is_urgent)
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                                🚨 Urgent
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3" style="background-color: {{ $berita->kategori->warna }}20; color: {{ $berita->kategori->warna }};">
                                    @if($berita->kategori->icon)
                                        <i class="{{ $berita->kategori->icon }} text-xs"></i>
                                    @else
                                        <div class="w-3 h-3 rounded-full" style="background-color: {{ $berita->kategori->warna }};"></div>
                                    @endif
                                </div>
                                <span class="text-sm text-gray-900">{{ $berita->kategori->nama }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {!! $berita->status_badge !!}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex items-center space-x-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $berita->views }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>
                                <div>{{ $berita->formatted_date }}</div>
                                <div class="text-xs text-gray-400">{{ $berita->author_name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <!-- View Button -->
                                <a href="{{ route('admin.berita.show', $berita) }}"
                                class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50 transition-colors duration-200"
                                title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>

                                <!-- Edit Button -->
                                <a href="{{ route('admin.berita.edit', $berita) }}"
                                class="text-amber-600 hover:text-amber-900 p-2 rounded-lg hover:bg-amber-50 transition-colors duration-200"
                                title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>

                                <!-- Publish/Unpublish Button -->
                                @if($berita->status === 'draft')
                                    <form action="{{ route('admin.berita.publish', $berita) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin mempublikasikan berita ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="text-green-600 hover:text-green-900 p-2 rounded-lg hover:bg-green-50 transition-colors duration-200"
                                                title="Publish">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @elseif($berita->status === 'published')
                                    <form action="{{ route('admin.berita.unpublish', $berita) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan publikasi berita ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="text-orange-600 hover:text-orange-900 p-2 rounded-lg hover:bg-orange-50 transition-colors duration-200"
                                                title="Unpublish">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9V6a4 4 0 118 0v3M6 9h12a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2v-9a2 2 0 012-2z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @endif

                                <!-- Toggle Featured Button -->
                                <form action="{{ route('admin.berita.toggle-featured', $berita) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin mengubah status featured berita ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="p-2 rounded-lg transition-colors duration-200 {{ $berita->is_featured ? 'text-yellow-600 hover:text-yellow-900 hover:bg-yellow-50' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50' }}"
                                            title="{{ $berita->is_featured ? 'Hapus dari Featured' : 'Jadikan Featured' }}">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </button>
                                </form>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini? Tindakan ini tidak dapat dibatalkan!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 transition-colors duration-200"
                                            title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada berita</h3>
                                <p class="text-gray-500 mb-4">Mulai dengan menulis berita atau pengumuman pertama</p>
                                <a href="{{ route('admin.berita.create') }}"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Tulis Berita
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($beritas->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $beritas->links() }}
        </div>
    @endif
</div>

<!-- Bulk Action Form -->
<form id="bulk-action-form" action="{{ route('admin.berita.bulk-action') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="action" id="bulk-action-input">
    <div id="bulk-selected-items"></div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('select-all');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');
    const bulkActions = document.getElementById('bulk-actions');
    const selectedCount = document.getElementById('selected-count');

    function updateBulkActions() {
        const checkedItems = document.querySelectorAll('.item-checkbox:checked');
        const count = checkedItems.length;

        selectedCount.textContent = count;

        if (count > 0) {
            bulkActions.classList.remove('hidden');
        } else {
            bulkActions.classList.add('hidden');
        }
    }

    selectAll.addEventListener('change', function() {
        itemCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkActions();
    });

    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });
});

function bulkAction(action) {
    const checkedItems = document.querySelectorAll('.item-checkbox:checked');

    if (checkedItems.length === 0) {
        alert('Pilih minimal satu item');
        return;
    }

    if (action === 'delete' && !confirm('Apakah Anda yakin ingin menghapus item yang dipilih?')) {
        return;
    }

    const form = document.getElementById('bulk-action-form');
    const actionInput = document.getElementById('bulk-action-input');
    const selectedItemsContainer = document.getElementById('bulk-selected-items');

    actionInput.value = action;
    selectedItemsContainer.innerHTML = '';

    checkedItems.forEach(checkbox => {
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'selected_items[]';
        hiddenInput.value = checkbox.value;
        selectedItemsContainer.appendChild(hiddenInput);
    });

    form.submit();
}
</script>
@endsection
