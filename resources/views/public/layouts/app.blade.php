<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Desa Tanjung Selamat')</title>
    <meta name="description" content="@yield('description', 'Website resmi Desa Tanjung Selamat - Informasi desa, berita, dan layanan masyarakat')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-10 h-10  flex items-center justify-center mr-3">
                            <img src="{{ asset('images/DeliSerdang.png') }}"
                                alt="Logo Desa Tanjung Selamat"
                                class="h-10 md:h-10 w-auto mr- md:mr-3">
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-gray-900">Desa Tanjung Selamat</h1>
                            <p class="text-xs text-gray-600">Kecamatan Sunggal</p>
                        </div>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('public.home') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('public.home') ? 'text-blue-600 font-semibold border-b-2 border-gray-600' : '' }}">
                        Beranda
                    </a>

                    <!-- Dropdown Profil -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium flex items-center {{ request()->routeIs('public.visi-misi') || request()->routeIs('public.demografi') || request()->routeIs('public.perangkat-desa') ? 'text-blue-600 font-semibold border-b-2 border-gray-600' : '' }}">
                            Profil
                            <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white shadow-lg py-1 z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('public.visi-misi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Visi & Misi</a>
                            <a href="{{ route('public.demografi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Demografi</a>
                            <a href="{{ route('public.perangkat-desa') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Perangkat Desa</a>
                            <a href="{{ route('public.sejarah') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sejarah</a>
                        </div>
                    </div>

                    <!-- Dropdown Organisasi -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-blue-600 px-3 py-2  text-sm font-medium flex items-center {{ request()->routeIs('public.bumdes') || request()->routeIs('public.pkk') || request()->routeIs('public.posyandu') ? 'text-blue-600 font-semibold border-b-2 border-gray-600' : '' }}">
                            Organisasi
                            <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white shadow-lg py-1 z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('public.bumdes') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">BUMDes</a>
                            <a href="{{ route('public.pkk') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">PKK</a>
                            <a href="{{ route('public.posyandu') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Posyandu</a>
                        </div>
                    </div>

                        <!-- Dropdown Layanan -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium flex items-center {{ request()->routeIs('public.pengajuan-surat.*') ? 'text-blue-600 font-semibold border-b-2 border-gray-600' : '' }}">
                            Layanan
                            <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-56 bg-white shadow-lg py-1 z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('public.pengajuan-surat.index') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->routeIs('public.pengajuan-surat.index') ? 'bg-blue-50 text-blue-700' : '' }}">
                                Pengajuan Surat
                            </a>
                            <a href="{{ route('public.pengajuan-surat.track') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->routeIs('public.pengajuan-surat.track') ? 'bg-blue-50 text-blue-700' : '' }}">
                                Lacak Status
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('public.berita')}}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('public.berita*') ? 'text-blue-600 font-semibold border-b-2 border-gray-600' : '' }}">
                        Berita
                    </a>
                    <a href="{{ route('public.galeri.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('public.galeri.index') ? 'text-blue-600 font-semibold border-b-2 border-gray-600' : '' }}">
                        Galeri
                    </a>
                    <a href="{{ route('public.kontak') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('public.kontak') ? 'text-blue-600 font-semibold border-b-2 border-gray-600' : '' }}">
                        Kontak
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
                <a href="{{ route('public.home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Beranda</a>

                <!-- Mobile Profil Dropdown -->
                <div class="px-3 py-2">
                    <button id="mobile-profil-button" class="flex items-center justify-between w-full text-base font-medium text-gray-700 hover:text-blue-600">
                        Profil
                        <svg class="ml-1 w-4 h-4 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div id="mobile-profil-menu" class="mt-2 space-y-1 hidden">
                        <a href="{{ route('public.visi-misi') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded">Visi & Misi</a>
                        <a href="{{ route('public.demografi') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded">Demografi</a>
                        <a href="{{ route('public.perangkat-desa') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded">Perangkat Desa</a>
                        <a href="{{ route('public.sejarah') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded">Sejarah</a>
                    </div>
                </div>

                <!-- Mobile Organisasi Dropdown -->
                <div class="px-3 py-2">
                    <button id="mobile-organisasi-button" class="flex items-center justify-between w-full text-base font-medium text-gray-700 hover:text-blue-600">
                        Organisasi
                        <svg class="ml-1 w-4 h-4 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div id="mobile-organisasi-menu" class="mt-2 space-y-1 hidden">
                        <a href="{{ route('public.bumdes') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded">BUMDes</a>
                        <a href="{{ route('public.pkk') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded">PKK</a>
                        <a href="{{ route('public.posyandu') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded">Posyandu</a>
                    </div>
                </div>

                <!-- Mobile Layanan Dropdown -->
                <!-- Mobile Layanan Dropdown -->
                <div class="px-3 py-2">
                    <button id="mobile-layanan-button" class="flex items-center justify-between w-full text-base font-medium text-gray-700 hover:text-blue-600">
                        Layanan
                        <svg class="ml-1 w-4 h-4 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div id="mobile-layanan-menu" class="mt-2 space-y-1 hidden">
                        <a href="{{ route('public.pengajuan-surat.index') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded">Pengajuan Surat</a>
                        <a href="{{ route('public.pengajuan-surat.track') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded">Lacak Status</a>
                    </div>
                </div>

                <a href="{{ route('public.berita') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Berita</a>
                <a href="{{ route('public.galeri.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Galeri</a>
                <a href="{{ route('public.kontak') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Kontak</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo & Description -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10  flex items-center justify-center mr-3">
                            <img src="{{ asset('images/DeliSerdang.png') }}"
                                alt="Logo Desa Tanjung Selamat"
                                class="h-10 md:h-10 w-auto mr- md:mr-3">
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-white">Desa Tanjung Selamat</h1>
                            <p class="text-xs text-white">Kecamatan Sunggal</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">
                        Website resmi Desa Tanjung Selamat yang menyediakan informasi lengkap tentang profil desa, berita, dan layanan masyarakat.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('public.visi-misi') }}" class="text-gray-300 hover:text-white transition duration-200">Visi & Misi</a></li>
                        <li><a href="{{ route('public.perangkat-desa') }}" class="text-gray-300 hover:text-white transition duration-200">Perangkat Desa</a></li>
                        <li><a href="{{ route('public.berita') }}" class="text-gray-300 hover:text-white transition duration-200">Berita</a></li>
                        <li><a href="{{ route('public.galeri.index') }}" class="text-gray-300 hover:text-white transition duration-200">Galeri</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            Jl. Raya Desa No. 123
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                            (021) 1234-5678
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            info@desatanjungselamat.id
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-300">© {{ date('Y') }} Desa Tanjung Selamat. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for mobile menu -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Mobile dropdown toggles
        document.getElementById('mobile-profil-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-profil-menu');
            const icon = this.querySelector('svg');
            menu.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });

        document.getElementById('mobile-organisasi-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-organisasi-menu');
            const icon = this.querySelector('svg');
            menu.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
        document.getElementById('mobile-layanan-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-layanan-menu');
            const icon = this.querySelector('svg');
            menu.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
    </script>
</body>
</html>
