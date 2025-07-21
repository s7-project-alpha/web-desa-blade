{{-- resources/views/admin/posyandu/kegiatan/edit.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-4 justify-between">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Kegiatan Posyandu</h1>
            <p class="text-gray-600 mt-1">Edit kegiatan {{ $kegiatan->nama_kegiatan }}</p>
        </div>
          <a href="{{ route('admin.posyandu.kegiatan') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">Form Edit Kegiatan Posyandu</h2>
    </div>

    <form action="{{ route('admin.posyandu.kegiatan.update', $kegiatan) }}" method="POST" class="p-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700 mb-2">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" placeholder="Contoh: Penimbangan Balita dan Imunisasi">
                @error('nama_kegiatan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="posyandu_id" class="block text-sm font-medium text-gray-700 mb-2">Posyandu</label>
                <select name="posyandu_id" id="posyandu_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">Pilih Posyandu</option>
                    @foreach($posyandu as $item)
                    <option value="{{ $item->id }}" {{ old('posyandu_id', $kegiatan->posyandu_id) == $item->id ? 'selected' : '' }}>
                        {{ $item->nama }} - {{ $item->dusun }}
                    </option>
                    @endforeach
                </select>
                @error('posyandu_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                placeholder="Deskripsi kegiatan">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
            @error('deskripsi')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    value="{{ old('tanggal', $kegiatan->tanggal->format('Y-m-d')) }}">
                @error('tanggal')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
                <input type="time" name="jam_mulai" id="jam_mulai" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    value="{{ old('jam_mulai', $kegiatan->jam_mulai->format('H:i')) }}">
                @error('jam_mulai')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
                <input type="time" name="jam_selesai" id="jam_selesai" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    value="{{ old('jam_selesai', $kegiatan->jam_selesai->format('H:i')) }}">
                @error('jam_selesai')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" id="status" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                <option value="terjadwal" {{ old('status', $kegiatan->status) == 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                <option value="berlangsung" {{ old('status', $kegiatan->status) == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                <option value="selesai" {{ old('status', $kegiatan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ old('status', $kegiatan->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            @error('status')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Agenda Kegiatan</label>
            <div id="agenda-container">
                @php
                    $currentAgenda = old('agenda', $kegiatan->agenda ?? []);
                @endphp
                @if(count($currentAgenda) > 0)
                    @foreach($currentAgenda as $agenda)
                    <div class="agenda-item flex items-center mb-2">
                        <input type="text" name="agenda[]"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent mr-2"
                            value="{{ $agenda }}" placeholder="Agenda kegiatan">
                        <button type="button" onclick="removeAgenda(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                @else
                <div class="agenda-item flex items-center mb-2">
                    <input type="text" name="agenda[]"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent mr-2"
                        placeholder="Agenda kegiatan">
                    <button type="button" onclick="removeAgenda(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                @endif
            </div>
            <button type="button" onclick="addAgenda()" class="mt-2 px-4 py-2 bg-orange-100 text-orange-700 rounded-lg hover:bg-orange-200 transition-colors duration-200">
                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                Tambah Agenda
            </button>
            @error('agenda')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
            <textarea name="catatan" id="catatan" rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                placeholder="Catatan tambahan">{{ old('catatan', $kegiatan->catatan) }}</textarea>
            @error('catatan')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between pt-6 border-t">
            <a href="{{ route('admin.posyandu.kegiatan') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors duration-200">
                Update Kegiatan
            </button>
        </div>
    </form>
</div>

<script>
function addAgenda() {
    const container = document.getElementById('agenda-container');
    const newItem = document.createElement('div');
    newItem.className = 'agenda-item flex items-center mb-2';
    newItem.innerHTML = `
        <input type="text" name="agenda[]"
            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent mr-2"
            placeholder="Agenda kegiatan">
        <button type="button" onclick="removeAgenda(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    `;
    container.appendChild(newItem);
}

function removeAgenda(button) {
    const container = document.getElementById('agenda-container');
    if (container.children.length > 1) {
        button.parentElement.remove();
    }
}
</script>
@endsection
