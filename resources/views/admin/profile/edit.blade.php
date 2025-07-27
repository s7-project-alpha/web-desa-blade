@extends('admin.layouts.app')

@section('title', 'Pengaturan Profil')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-800">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Pengaturan Profil</h1>
            <p class="text-gray-600 mt-1">Kelola informasi profil dan keamanan akun Anda</p>
        </div>
    </div>
</div>

<!-- Profile Header -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
    <div class="flex items-center space-x-6">
        <div class="relative">
            <img src="{{ $user->avatar_url }}"
                 alt="{{ $user->name }}"
                 class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg">
            <div class="absolute -bottom-1 -right-1">
                @if($user->is_active)
                    <div class="w-6 h-6 bg-green-500 rounded-full border-2 border-white"></div>
                @else
                    <div class="w-6 h-6 bg-gray-400 rounded-full border-2 border-white"></div>
                @endif
            </div>
        </div>
        <div class="flex-1">
            <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
            <p class="text-gray-600">{{ $user->email }}</p>
            <div class="flex items-center space-x-4 mt-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    {{ $user->isSuperAdmin() ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                    {{ $user->isSuperAdmin() ? 'Super Admin' : 'Admin' }}
                </span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
                <span class="text-sm text-gray-500">
                    Bergabung {{ $user->created_at->format('M Y') }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Profile Form -->
    <div class="lg:col-span-2 space-y-6">

        <!-- Profile Information -->
        <div class="bg-white rounded-2xl shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    Informasi Profil
                </h3>
                <p class="text-sm text-gray-600 mt-1">Perbarui informasi profil dan alamat email Anda</p>
            </div>

            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('name') border-red-500 @enderror"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 @enderror"
                               required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon
                        </label>
                        <input type="tel"
                               id="phone"
                               name="phone"
                               value="{{ old('phone', $user->phone) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('phone') border-red-500 @enderror"
                               placeholder="08xxxxxxxxxx">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Avatar Upload -->
                    <div>
                        <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Profil
                        </label>
                        <div class="flex items-center space-x-4">
                            <input type="file"
                                   id="avatar"
                                   name="avatar"
                                   accept="image/*"
                                   class="hidden"
                                   onchange="previewAvatar(this)">
                            <label for="avatar" class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Pilih Foto
                            </label>
                            @if($user->avatar)
                                <form method="POST" action="{{ route('admin.profile.delete-avatar') }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 text-sm"
                                            onclick="return confirm('Yakin ingin menghapus foto profil?')">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Maks. 2MB)</p>
                        @error('avatar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat
                    </label>
                    <textarea id="address"
                              name="address"
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('address') border-red-500 @enderror"
                              placeholder="Masukkan alamat lengkap">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl transition-colors duration-200 shadow-lg hover:shadow-xl">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Update Password -->
        <div class="bg-white rounded-2xl shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                    </svg>
                    Ganti Password
                </h3>
                <p class="text-sm text-gray-600 mt-1">Pastikan akun Anda menggunakan password yang kuat dan unik</p>
            </div>

            <form method="POST" action="{{ route('admin.profile.update-password') }}" class="p-6 space-y-6">
                @csrf
                @method('PATCH')

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password Saat Ini <span class="text-red-500">*</span>
                    </label>
                    <input type="password"
                           id="current_password"
                           name="current_password"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 @error('current_password') border-red-500 @enderror"
                           required>
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password Baru <span class="text-red-500">*</span>
                        </label>
                        <input type="password"
                               id="password"
                               name="password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 @error('password') border-red-500 @enderror"
                               required>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                               required>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-xl transition-colors duration-200 shadow-lg hover:shadow-xl">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">

        <!-- Account Status -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                </svg>
                Status Akun
            </h3>

            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-sm font-medium text-gray-700">Status</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-sm font-medium text-gray-700">Role</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $user->isSuperAdmin() ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ $user->isSuperAdmin() ? 'Super Admin' : 'Admin' }}
                    </span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-sm font-medium text-gray-700">Email Verified</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Aksi Cepat
            </h3>

            <div class="space-y-3">
                <!-- Download Data -->
                <a href="{{ route('admin.profile.download-data') }}"
                   class="flex items-center justify-between w-full p-3 text-left bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm font-medium text-blue-700">Download Data</span>
                    </div>
                </a>

                <!-- Toggle Active Status -->
                <form method="POST" action="{{ route('admin.profile.toggle-active') }}" class="w-full">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                            class="flex items-center justify-between w-full p-3 text-left {{ $user->is_active ? 'bg-yellow-50 hover:bg-yellow-100' : 'bg-green-50 hover:bg-green-100' }} rounded-lg transition-colors duration-200"
                            onclick="return confirm('{{ $user->is_active ? 'Yakin ingin menonaktifkan akun? Anda akan keluar dari sistem.' : 'Yakin ingin mengaktifkan akun?' }}')">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-3 {{ $user->is_active ? 'text-yellow-600' : 'text-green-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                @if($user->is_active)
                                    <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"></path>
                                @else
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                @endif
                            </svg>
                            <span class="text-sm font-medium {{ $user->is_active ? 'text-yellow-700' : 'text-green-700' }}">
                                {{ $user->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}
                            </span>
                        </div>
                    </button>
                </form>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="bg-white rounded-2xl shadow-lg border-2 border-red-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-red-900 mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    Zona Berbahaya
                </h3>
                <p class="text-sm text-red-600 mb-4">Tindakan ini tidak dapat dibatalkan</p>

                <form method="POST" action="{{ route('admin.profile.destroy') }}" onsubmit="return confirmDelete()">
                    @csrf
                    @method('DELETE')

                    <div class="mb-4">
                        <label for="delete_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi dengan password Anda:
                        </label>
                        <input type="password"
                               id="delete_password"
                               name="password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                               required>
                    </div>

                    <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-xl transition-colors duration-200">
                        Hapus Akun Permanen
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Image Preview and Form Interactions -->
<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Update main profile image
            const profileImg = document.querySelector('img[alt="{{ $user->name }}"]');
            if (profileImg) {
                profileImg.src = e.target.result;
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function confirmDelete() {
    const confirmation = prompt('Ketik "HAPUS AKUN" untuk konfirmasi:');
    if (confirmation !== 'HAPUS AKUN') {
        alert('Konfirmasi tidak sesuai. Penghapusan akun dibatalkan.');
        return false;
    }

    return confirm('Apakah Anda yakin ingin menghapus akun secara permanen? Tindakan ini tidak dapat dibatalkan.');
}

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});
</script>
@endsection
