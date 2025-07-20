@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">BUMDes Management</h1>
        <p class="text-gray-600">Kelola data Badan Usaha Milik Desa</p>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<!-- BUMDes Overview -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Main BUMDes Info -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-start mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Informasi BUMDes</h2>
                <a href="{{ route('admin.bumdes.create-or-edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                    {{ $bumdes ? 'Edit' : 'Buat' }} Data BUMDes
                </a>
            </div>

            @if($bumdes)
                <div class="space-y-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $bumdes->nama }}</h3>
                        @if($bumdes->tagline)
                            <p class="text-blue-600 font-medium">{{ $bumdes->tagline }}</p>
                        @endif
                        @if($bumdes->deskripsi)
                            <p class="text-gray-600 mt-2">{{ $bumdes->deskripsi }}</p>
                        @endif
                    </div>

                    <!-- Header Image Preview -->
                    @if($bumdes->header_image)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Header Image</label>
                            <div class="w-full h-32 rounded-lg overflow-hidden bg-gray-200 relative">
                                <img src="{{ $bumdes->header_image_url }}" alt="Header BUMDes" class="w-full h-full object-cover">
                                <!-- Overlay Preview -->
                                @if($bumdes->header_title || $bumdes->header_subtitle)
                                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                        <div class="text-center text-white">
                                            @if($bumdes->header_title)
                                                <p class="text-lg font-bold">{{ $bumdes->header_title }}</p>
                                            @endif
                                            @if($bumdes->header_subtitle)
                                                <p class="text-sm">{{ $bumdes->header_subtitle }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if($bumdes->header_title || $bumdes->header_subtitle)
                                <p class="text-xs text-gray-500 mt-1">Preview dengan text overlay</p>
                            @endif
                        </div>
                    @endif

                    <!-- Statistics -->
                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm text-blue-600">Total Aset</p>
                            <p class="text-lg font-bold text-blue-900">{{ $bumdes->formatted_total_aset }}</p>
                            @if($bumdes->aset_growth != 0)
                                <p class="text-sm text-green-600">+{{ $bumdes->aset_growth }}%</p>
                            @endif
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <p class="text-sm text-green-600">Omzet Tahunan</p>
                            <p class="text-lg font-bold text-green-900">{{ $bumdes->formatted_omzet_tahunan }}</p>
                            @if($bumdes->omzet_growth != 0)
                                <p class="text-sm text-green-600">+{{ $bumdes->omzet_growth }}%</p>
                            @endif
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <p class="text-sm text-purple-600">Laba Bersih</p>
                            <p class="text-lg font-bold text-purple-900">{{ $bumdes->formatted_laba_bersih }}</p>
                            @if($bumdes->laba_growth != 0)
                                <p class="text-sm text-green-600">+{{ $bumdes->laba_growth }}%</p>
                            @endif
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <p class="text-sm text-yellow-600">Anggota Aktif</p>
                            <p class="text-lg font-bold text-yellow-900">{{ number_format($bumdes->anggota_aktif) }} orang</p>
                            @if($bumdes->anggota_growth != 0)
                                <p class="text-sm text-green-600">+{{ $bumdes->anggota_growth }}%</p>
                            @endif
                        </div>
                    </div>

                    <!-- Header Text Info -->
                    @if($bumdes->header_title || $bumdes->header_subtitle)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-2">Text Overlay Header:</h4>
                            @if($bumdes->header_title)
                                <p class="text-sm text-gray-700"><strong>Judul:</strong> {{ $bumdes->header_title }}</p>
                            @endif
                            @if($bumdes->header_subtitle)
                                <p class="text-sm text-gray-700"><strong>Subtitle:</strong> {{ $bumdes->header_subtitle }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H7m5 0v-5a2 2 0 00-2-2H8a2 2 0 00-2 2v5m5 0V9a2 2 0 012-2h2a2 2 0 012 2v12"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Data BUMDes</h3>
                    <p class="text-gray-600 mb-4">Buat data BUMDes utama terlebih dahulu</p>
                    <a href="{{ route('admin.bumdes.create-or-edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                        Buat Data BUMDes
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Stats</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">Unit Usaha</p>
                            <p class="text-sm text-gray-500">Total unit usaha aktif</p>
                        </div>
                    </div>
                    <span class="text-2xl font-bold text-blue-600">{{ $unitUsahaCount }}</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">Tim Manajemen</p>
                            <p class="text-sm text-gray-500">Pengurus BUMDes</p>
                        </div>
                    </div>
                    <span class="text-2xl font-bold text-green-600">{{ $timManajemenCount }}</span>
                </div>

                @if($bumdes)
                    <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-8 h-8 text-purple-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="font-medium text-gray-900">Status BUMDes</p>
                                <p class="text-sm text-gray-500">Kondisi operasional</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $bumdes->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $bumdes->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.bumdes.create-or-edit') }}" class="w-full flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                    <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <div class="text-left">
                        <p class="font-medium text-gray-900">{{ $bumdes ? 'Edit' : 'Buat' }} BUMDes</p>
                        <p class="text-sm text-gray-500">{{ $bumdes ? 'Update informasi utama' : 'Buat data BUMDes baru' }}</p>
                    </div>
                </a>

                @if($bumdes)
                    <a href="{{ route('public.bumdes') }}" target="_blank" class="w-full flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                        <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <div class="text-left">
                            <p class="font-medium text-gray-900">Preview Website</p>
                            <p class="text-sm text-gray-500">Lihat tampilan public</p>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Management Sections -->
@if($bumdes)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Unit Usaha Management -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Unit Usaha</h3>
                <a href="{{ route('admin.bumdes.unit-usaha') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                    Kelola Unit Usaha
                </a>
            </div>

            @if($unitUsahaCount > 0)
                <p class="text-gray-600 mb-4">Manage {{ $unitUsahaCount }} unit usaha BUMDes</p>
                <div class="space-y-2">
                    @foreach($bumdes->unitUsaha()->take(3)->get() as $unit)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-900">{{ $unit->nama }}</p>
                                <p class="text-sm text-gray-500">{{ $unit->jumlah_anggota }} anggota</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $unit->status_badge_class }}">
                                {{ ucfirst($unit->status) }}
                            </span>
                        </div>
                    @endforeach
                    @if($unitUsahaCount > 3)
                        <p class="text-sm text-gray-500 text-center">dan {{ $unitUsahaCount - 3 }} unit usaha lainnya...</p>
                    @endif
                </div>
            @else
                <div class="text-center py-6">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H7m5 0v-5a2 2 0 00-2-2H8a2 2 0 00-2 2v5m5 0V9a2 2 0 012-2h2a2 2 0 012 2v12"></path>
                    </svg>
                    <p class="text-gray-500 mb-2">Belum ada unit usaha</p>
                    <a href="{{ route('admin.bumdes.unit-usaha.create') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Tambah Unit Usaha →</a>
                </div>
            @endif
        </div>

        <!-- Tim Manajemen Management -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Tim Manajemen</h3>
                <a href="{{ route('admin.bumdes.tim-manajemen') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                    Kelola Tim
                </a>
            </div>

            @if($timManajemenCount > 0)
                <p class="text-gray-600 mb-4">Manage {{ $timManajemenCount }} anggota tim manajemen</p>
                <div class="space-y-2">
                    @foreach($bumdes->timManajemen()->take(3)->get() as $tim)
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 mr-3">
                                <img src="{{ $tim->foto_url }}" alt="{{ $tim->nama }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $tim->nama }}</p>
                                <p class="text-sm text-gray-500">{{ $tim->jabatan }}</p>
                            </div>
                        </div>
                    @endforeach
                    @if($timManajemenCount > 3)
                        <p class="text-sm text-gray-500 text-center">dan {{ $timManajemenCount - 3 }} anggota tim lainnya...</p>
                    @endif
                </div>
            @else
                <div class="text-center py-6">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <p class="text-gray-500 mb-2">Belum ada tim manajemen</p>
                    <a href="{{ route('admin.bumdes.tim-manajemen.create') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">Tambah Tim Manajemen →</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Complete Actions Grid -->
    <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Kelola BUMDes</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.bumdes.create-or-edit') }}" class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                <svg class="w-8 h-8 text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <p class="font-medium text-gray-900 text-center">{{ $bumdes ? 'Edit' : 'Buat' }} Data Utama</p>
                <p class="text-sm text-gray-500 text-center">Informasi & statistik BUMDes</p>
            </a>

            <a href="{{ route('admin.bumdes.unit-usaha.create') }}" class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                <svg class="w-8 h-8 text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <p class="font-medium text-gray-900 text-center">Tambah Unit Usaha</p>
                <p class="text-sm text-gray-500 text-center">Buat unit usaha baru</p>
            </a>

            <a href="{{ route('admin.bumdes.tim-manajemen.create') }}" class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                <svg class="w-8 h-8 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                <p class="font-medium text-gray-900 text-center">Tambah Tim</p>
                <p class="text-sm text-gray-500 text-center">Anggota tim manajemen</p>
            </a>

            <a href="{{ route('public.bumdes') }}" target="_blank" class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                <svg class="w-8 h-8 text-orange-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                <p class="font-medium text-gray-900 text-center">Preview Public</p>
                <p class="text-sm text-gray-500 text-center">Lihat halaman website</p>
            </a>
        </div>
    </div>
@endif
@endsection
