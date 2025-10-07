<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom scrollbar - White Theme */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.3);
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(156, 163, 175, 0.5);
        }

        /* White theme glassmorphism effects */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(229, 231, 235, 0.3);
        }

        .glass-sidebar {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(229, 231, 235, 0.3);
        }

        /* White theme animations */
        .nav-item {
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(243, 244, 246, 0.5), transparent);
            transition: left 0.5s;
        }

        .nav-item:hover::before {
            left: 100%;
        }

        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(2deg); }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        /* White theme pulse ring animation */
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 1; }
            100% { transform: scale(2.4); opacity: 0; }
        }

        .pulse-ring {
            position: relative;
        }

        .pulse-ring::before {
            content: '';
            position: absolute;
            inset: -4px;
            border: 2px solid rgba(156, 163, 175, 0.3);
            border-radius: inherit;
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
            opacity: 0.7;
        }

        /* White theme hover effects */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        }

        /* Menu collapse animation */
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .submenu.open {
            max-height: 500px;
        }

        /* White theme button styles */
        .btn-modern {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-modern::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(243, 244, 246, 0.5);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-modern:hover::after {
            width: 300px;
            height: 300px;
        }

        /* Loading skeleton */
        @keyframes shimmer {
            0% { background-position: -200px 0; }
            100% { background-position: calc(200px + 100%) 0; }
        }

        .skeleton {
            background: linear-gradient(90deg, #f9fafb 25%, #f3f4f6 50%, #f9fafb 75%);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
        }

        /* Status indicators - keep red for visibility */
        .status-indicator {
            position: relative;
        }

        .status-indicator::after {
            content: '';
            position: absolute;
            top: -2px;
            right: -2px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid white;
            animation: pulse 2s infinite;
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .mobile-optimized {
                padding: 1rem;
            }

            .card-hover:hover {
                transform: none;
                box-shadow: none;
            }
        }
    </style>
</head>

<body class="font-sans antialiased bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen">
    <!-- Background Pattern -->
    <div class="fixed inset-0 opacity-30">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
    </div>

    <div class="min-h-screen relative">
        <!-- Enhanced Navigation -->
        <nav class="fixed w-full z-50 top-0">
            <div class="glass-card shadow-lg border-b border-white/20">
                <div class="px-4 py-4 lg:px-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <!-- Mobile Menu Button -->
                            <button id="mobile-menu-btn" class="lg:hidden btn-modern p-2 rounded-xl text-gray-600 hover:text-gray-900 hover:bg-white/50 transition-all duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>

                            <!-- Logo Section -->
                            <div class="flex items-center space-x-3">
                                <!-- Logo Kabupaten Deliserdang -->
                                <div class="w-10 h-10">
                                    <img src="{{ asset('images/DeliSerdang.png') }}"
                                        alt="Logo Kabupaten Deliserdang"
                                        class="w-full h-full object-contain">
                                </div>

                                <!-- Teks Admin Desa -->
                                <div class="hidden sm:block">
                                    <h1 class="text-xl lg:text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                                        Admin Desa Tanjung Selamat
                                    </h1>
                                    <p class="text-sm text-gray-500 font-medium">Kabupaten Deliserdang</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Section -->
                        <div class="flex items-center space-x-3">




                            <!-- User Menu -->
                            <div class="relative">
                                <button id="user-menu-btn" class="btn-modern flex items-center space-x-3 p-2 rounded-xl hover:bg-white/50 transition-all duration-300">
                                    <img class="w-10 h-10 rounded-xl object-cover border-2 border-white shadow-md"
                                         src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=059669&color=fff' }}"
                                         alt="{{ Auth::user()->name }}">
                                    <div class="hidden sm:block text-left">
                                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500">Administrator</p>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-600 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div id="user-dropdown" class="hidden absolute right-0 mt-3 w-56 glass-card rounded-2xl shadow-2xl border border-white/20 z-50">
                                    <div class="p-4 border-b border-gray-100/50">
                                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                    </div>
                                    <div class="p-2">
                                        <a href="{{ route('admin.profile.edit') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 rounded-xl hover:bg-white/50 transition-all duration-200">
                                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                            Profile Settings
                                        </a>

                                        <div class="border-t border-gray-100/50 my-2"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-red-600 rounded-xl hover:bg-red-50 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                                                </svg>
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Enhanced Sidebar -->
        <aside id="sidebar" class="fixed top-0 left-0 z-40 w-72 h-screen pt-24 transition-transform -translate-x-full sm:translate-x-0">
            <div class="h-full px-4 pb-4 overflow-y-auto glass-sidebar">
                <ul class="space-y-2 font-medium">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center p-4 text-gray-900 rounded-2xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 group transition-all duration-300 card-hover {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-emerald-50 to-teal-50 shadow-lg border border-emerald-200' : '' }}">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                </svg>
                            </div>
                            <span class="ml-4 font-semibold">Dashboard</span>
                        </a>
                    </li>

                    <!-- Visi & Misi -->
                    <li>
                        <a href="{{ route('admin.visi-misi.index') }}" class="nav-item flex items-center p-4 text-gray-900 rounded-2xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 group transition-all duration-300 card-hover {{ request()->routeIs('admin.visi-misi.*') ? 'bg-gradient-to-r from-blue-50 to-indigo-50 shadow-lg border border-blue-200' : '' }}">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-4 font-semibold">Visi & Misi</span>
                        </a>
                    </li>

                    <!-- Demografi -->
                    <li>
                        <a href="{{ route('admin.demografi.index') }}" class="nav-item flex items-center p-4 text-gray-900 rounded-2xl hover:bg-gradient-to-r hover:from-purple-50 hover:to-violet-50 group transition-all duration-300 card-hover {{ request()->routeIs('admin.demografi.*') ? 'bg-gradient-to-r from-purple-50 to-violet-50 shadow-lg border border-purple-200' : '' }}">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-violet-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-4 font-semibold">Demografi</span>
                        </a>
                    </li>

                    <!-- Perangkat Desa -->
                    <li>
                        <a href="{{ route('admin.perangkat-desa.index') }}" class="nav-item flex items-center p-4 text-gray-900 rounded-2xl hover:bg-gradient-to-r hover:from-orange-50 hover:to-amber-50 group transition-all duration-300 card-hover {{ request()->routeIs('admin.perangkat-desa.*') ? 'bg-gradient-to-r from-orange-50 to-amber-50 shadow-lg border border-orange-200' : '' }}">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-orange-500 to-amber-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-4 font-semibold">Perangkat Desa</span>
                        </a>
                    </li>

                    <!-- BUMDes -->
                    <li>
                        <a href="{{ route('admin.bumdes.index') }}" class="nav-item flex items-center p-4 text-gray-900 rounded-2xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 group transition-all duration-300 card-hover {{ request()->routeIs('admin.bumdes.*') ? 'bg-gradient-to-r from-emerald-50 to-green-50 shadow-lg border border-emerald-200' : '' }}">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-4 font-semibold">BUMDes</span>
                        </a>
                    </li>

                    <!-- PKK -->
                    <li>
                        <a href="{{ route('admin.pkk.index') }}" class="nav-item flex items-center p-4 text-gray-900 rounded-2xl hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 group transition-all duration-300 card-hover {{ request()->routeIs('admin.pkk.*') ? 'bg-gradient-to-r from-pink-50 to-rose-50 shadow-lg border border-pink-200' : '' }}">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-pink-500 to-rose-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                </svg>
                            </div>
                            <span class="ml-4 font-semibold">PKK</span>
                        </a>
                    </li>

                    <!-- Posyandu -->
                    <li>
                        <a href="{{ route('admin.posyandu.index') }}" class="nav-item flex items-center p-4 text-gray-900 rounded-2xl hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 group transition-all duration-300 card-hover {{ request()->routeIs('admin.posyandu.*') ? 'bg-gradient-to-r from-red-50 to-pink-50 shadow-lg border border-red-200' : '' }}">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-red-500 to-pink-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-4 font-semibold">Posyandu</span>
                        </a>
                    </li>

                    <!-- Pengajuan Surat -->
                    <li>
                        <a href="{{ route('admin.pengajuan-surat.index') }}" class="nav-item flex items-center p-4 text-gray-900 rounded-2xl hover:bg-gradient-to-r hover:from-violet-50 hover:to-purple-50 group transition-all duration-300 card-hover {{ request()->routeIs('admin.pengajuan-surat.*') ? 'bg-gradient-to-r from-violet-50 to-purple-50 shadow-lg border border-violet-200' : '' }}">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-4 font-semibold">Pengajuan Surat</span>
                            @php
                                $pendingPengajuan = \App\Models\PengajuanSurat::byStatus('pending')->count();
                            @endphp
                            @if($pendingPengajuan > 0)
                            <span class="ml-auto bg-gradient-to-r from-red-500 to-red-600 text-white text-xs px-3 py-1 rounded-full font-bold shadow-lg">{{ $pendingPengajuan }}</span>
                            @endif
                        </a>
                    </li>

                    <!-- Menu Berita dengan Dropdown -->
                    <li>
                        <button type="button" class="nav-item flex items-center w-full p-4 text-gray-900 rounded-2xl hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 group transition-all duration-300 {{ request()->routeIs('admin.berita.*') || request()->routeIs('admin.kategori-berita.*') ? 'bg-gradient-to-r from-indigo-50 to-blue-50 shadow-lg border border-indigo-200' : '' }}" data-collapse-toggle="berita-menu">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-blue-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                                    <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V9a1 1 0 00-1-1h-1v-1z"></path>
                                </svg>
                            </div>
                            <span class="flex-1 ml-4 text-left font-semibold">Berita</span>
                            <svg class="w-5 h-5 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="berita-menu" class="submenu {{ request()->routeIs('admin.berita.*') || request()->routeIs('admin.kategori-berita.*') ? 'open' : '' }} py-2 space-y-1 ml-14">
                            <li>
                                <a href="{{ route('admin.berita.index') }}" class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-gradient-to-r hover:from-gray-50 hover:to-slate-50 transition-all duration-200 {{ request()->routeIs('admin.berita.*') ? 'bg-gradient-to-r from-gray-50 to-slate-50 text-gray-900 font-semibold' : '' }}">
                                    <span class="w-2 h-2 rounded-full bg-gray-400 mr-3"></span>
                                    Berita & Pengumuman
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.kategori-berita.index') }}" class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-gradient-to-r hover:from-gray-50 hover:to-slate-50 transition-all duration-200 {{ request()->routeIs('admin.kategori-berita.*') ? 'bg-gradient-to-r from-gray-50 to-slate-50 text-gray-900 font-semibold' : '' }}">
                                    <span class="w-2 h-2 rounded-full bg-gray-400 mr-3"></span>
                                    Kategori Berita
                                </a>
                            </li>
                        </ul>
                    </li>



                   <!-- Menu Galeri dengan Dropdown -->
<li>
    <button type="button" class="nav-item flex items-center w-full p-4 text-gray-900 rounded-2xl hover:bg-gradient-to-r hover:from-cyan-50 hover:to-teal-50 group transition-all duration-300 {{ request()->routeIs('admin.galeri.*') || request()->routeIs('admin.kategori-galeri.*') ? 'bg-gradient-to-r from-cyan-50 to-teal-50 shadow-lg border border-cyan-200' : '' }}" data-collapse-toggle="galeri-menu">
        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-teal-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <span class="flex-1 ml-4 text-left font-semibold">Galeri</span>
        <svg class="w-5 h-5 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </button>
    <ul id="galeri-menu" class="submenu {{ request()->routeIs('admin.galeri.*') || request()->routeIs('admin.kategori-galeri.*') ? 'open' : '' }} py-2 space-y-1 ml-14">
        <li>
            <a href="{{ route('admin.galeri.index') }}" class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-gradient-to-r hover:from-gray-50 hover:to-slate-50 transition-all duration-200 {{ request()->routeIs('admin.galeri.*') ? 'bg-gradient-to-r from-gray-50 to-slate-50 text-gray-900 font-semibold' : '' }}">
                <span class="w-2 h-2 rounded-full bg-gray-400 mr-3"></span>
                Kelola Galeri
            </a>
        </li>
        <li>
            <a href="{{ route('admin.kategori-galeri.index') }}" class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-gradient-to-r hover:from-gray-50 hover:to-slate-50 transition-all duration-200 {{ request()->routeIs('admin.kategori-galeri.*') ? 'bg-gradient-to-r from-gray-50 to-slate-50 text-gray-900 font-semibold' : '' }}">
                <span class="w-2 h-2 rounded-full bg-gray-400 mr-3"></span>
                Kategori Galeri
            </a>
        </li>
    </ul>
</li>

                    <!-- Kontak -->
                    <li>
                        <a href="{{ route('admin.kontak.index') }}" class="nav-item flex items-center p-4 text-gray-900 rounded-2xl hover:bg-gradient-to-r hover:from-yellow-50 hover:to-amber-50 group transition-all duration-300 card-hover {{ request()->routeIs('admin.kontak.*') ? 'bg-gradient-to-r from-yellow-50 to-amber-50 shadow-lg border border-yellow-200' : '' }}">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-amber-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-4 font-semibold">Kontak & Pesan</span>
                            @php
                                $unreadMessages = \App\Models\KontakMessage::unread()->count();
                            @endphp
                            @if($unreadMessages > 0)
                            <span class="ml-auto bg-gradient-to-r from-red-500 to-red-600 text-white text-xs px-3 py-1 rounded-full font-bold shadow-lg">{{ $unreadMessages }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Enhanced Main Content -->
        <div class="p-4 pt-24 sm:ml-72 transition-all duration-300">
            <div class="glass-card rounded-3xl shadow-2xl border border-white/20 p-8 mobile-optimized">
                @yield('content')
            </div>
        </div>

        <!-- Mobile Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/60 backdrop-blur-sm lg:hidden hidden transition-all duration-300"></div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });

        // User dropdown functionality
        const userMenuBtn = document.getElementById('user-menu-btn');
        const userDropdown = document.getElementById('user-dropdown');

        userMenuBtn.addEventListener('click', () => {
            userDropdown.classList.toggle('hidden');
            const chevron = userMenuBtn.querySelector('svg:last-child');
            chevron.classList.toggle('rotate-180');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.add('hidden');
                const chevron = userMenuBtn.querySelector('svg:last-child');
                chevron.classList.remove('rotate-180');
            }
        });

        // Enhanced submenu functionality
        document.querySelectorAll('[data-collapse-toggle]').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-collapse-toggle');
                const target = document.getElementById(targetId);
                const chevron = this.querySelector('svg:last-child');

                target.classList.toggle('open');
                chevron.classList.toggle('rotate-180');
            });
        });

        // Smooth scrolling for sidebar
        const sidebarContainer = document.querySelector('#sidebar .overflow-y-auto');
        if (sidebarContainer) {
            sidebarContainer.style.scrollBehavior = 'smooth';
        }

        // Auto-close mobile menu on resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 640) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });

        // Add loading states for navigation
        document.querySelectorAll('a[href]').forEach(link => {
            if (!link.target && link.hostname === window.location.hostname) {
                link.addEventListener('click', function() {
                    const loader = document.createElement('div');
                    loader.className = 'fixed top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-purple-600 z-50';
                    loader.style.animation = 'loading 2s ease-in-out';
                    document.body.appendChild(loader);

                    setTimeout(() => loader.remove(), 2000);
                });
            }
        });

        // Add loading animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes loading {
                0% { transform: translateX(-100%); }
                50% { transform: translateX(0%); }
                100% { transform: translateX(100%); }
            }
        `;
        document.head.appendChild(style);

        // Initialize tooltips for icons (if you want to add them)
        document.querySelectorAll('[title]').forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.position = 'relative';
            });
        });

        // Enhance card hover effects on touch devices
        if ('ontouchstart' in window) {
            document.querySelectorAll('.card-hover').forEach(card => {
                card.addEventListener('touchstart', function() {
                    this.style.transform = 'translateY(-4px) scale(1.01)';
                });

                card.addEventListener('touchend', function() {
                    this.style.transform = '';
                });
            });
        }
    </script>
        @stack('scripts')
</body>
</html>
