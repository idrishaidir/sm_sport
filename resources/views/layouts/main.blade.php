<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SM Sport Center')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { 
            background-color: #F8FAF8; 
            color: #1F2937; 
        }
        .bento-card { 
            background-color: #FFFFFF; 
            border-radius: 20px; 
            box-shadow: 0 8px 30px rgba(0,0,0,0.04); 
            border: 1px solid rgba(16, 185, 129, 0.05); 
            transition: transform 0.3s ease; 
        }
        .bento-card:hover { 
            transform: translateY(-2px); 
        }
        .glass-panel { 
            background: rgba(255, 255, 255, 0.9); 
            backdrop-filter: blur(16px); 
            border: 1px solid rgba(255, 255, 255, 0.5); 
        }
    </style>
    @stack('styles') 
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased selection:bg-secondary selection:text-white pt-28 pb-10">

<nav x-data="{ openMobile: false }" class="fixed top-4 left-0 right-0 z-50 mx-4 md:mx-auto max-w-7xl glass-panel rounded-bento px-6 py-3.5 flex justify-between items-center shadow-sm backdrop-blur-md bg-white/90 border border-white/20">
    <a href="{{ url('/') }}" class="flex items-center gap-1 hover:opacity-80 transition-opacity">
        <img src="{{asset('images/logo.png')}}" alt="Logo SM SPORT" class="w-11 rounded-xl flex items-center justify-center">
        <span class="font-bold text-xl text-primary hidden sm:block">Sport Center</span>
    </a>
    
    <div class="hidden lg:flex items-center space-x-6">
        <a href="{{ url('/') }}" class="text-text hover:text-primary transition-colors font-medium text-sm">Home</a>
        @auth
            <a href="{{ route('reservasi.create') ?? '#' }}" class="text-text hover:text-primary transition-colors font-medium text-sm">Buat Pesanan</a>

        @else
            <a href="{{ route('ketersediaan') ?? '#' }}" class="text-text hover:text-primary transition-colors font-medium text-sm">Cek Jadwal</a>
        @endauth
        
        <div x-data="{ openDropdown: false }" @click.away="openDropdown = false" class="relative">
            <button @click="openDropdown = !openDropdown" class="flex items-center gap-1 text-text hover:text-primary transition-colors font-medium text-sm focus:outline-none">
                <span>Profil SM</span>
                <span class="material-symbols-outlined text-sm transition-transform duration-200" :class="openDropdown ? 'rotate-180' : ''">expand_more</span>
            </button>
            
            <div x-show="openDropdown" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute top-full left-0 mt-2 w-44 bg-white border border-gray-100 rounded-xl shadow-lg py-2 flex flex-col z-50" 
                 style="display: none;">
                <a href="{{ url('/#about') }}" @click="openDropdown = false" class="px-4 py-2 text-sm text-text hover:bg-green-50 hover:text-primary transition-colors">Tentang Kami</a>
                <a href="{{ url('/#facilities') }}" @click="openDropdown = false" class="px-4 py-2 text-sm text-text hover:bg-green-50 hover:text-primary transition-colors">Fasilitas</a>
                <a href="{{ url('/#gallery') }}" @click="openDropdown = false" class="px-4 py-2 text-sm text-text hover:bg-green-50 hover:text-primary transition-colors">Galeri</a>
            </div>
        </div>

        @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="text-text hover:text-primary transition-colors font-medium text-sm">Dashboard Admin</a>
            <a href="{{ route('admin.laporan') }}" class="text-text hover:text-primary transition-colors font-medium text-sm">Laporan</a>
        @elseif(Auth::check())
            <a href="{{ route('dashboard') }}" class="text-text hover:text-primary transition-colors font-medium text-sm">Dashboard</a>
        @endif
    </div>

    <div class="hidden lg:flex items-center space-x-3">
        @auth
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 bg-green-50 hover:bg-green-100 px-3 py-1.5 rounded-lg border border-green-100 transition-colors shadow-sm" title="Pengaturan Profil">
                <span class="material-symbols-outlined text-secondary text-sm">
                    {{ Auth::user()->role === 'admin' ? 'admin_panel_settings' : 'account_circle' }}
                </span>
                <span class="text-sm font-semibold text-primary">{{ Auth::user()->name }}</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-3.5 py-1.5 rounded-xl font-semibold transition-colors text-sm shadow-sm">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('dashboard') ?? route('login') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl font-semibold transition-colors text-sm shadow-sm flex items-center gap-1.5">
                <span class="material-symbols-outlined text-base">calendar_month</span>
                Pesan Sekarang
            </a>
            <a href="{{ route('register') }}" class="bg-primary hover:bg-green-800 text-white px-3.5 py-2 rounded-xl font-semibold transition-colors text-sm shadow-md">Daftar</a>
        @endauth
    </div>

    <div class="flex lg:hidden items-center gap-2">
        @auth
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-1 bg-green-50 hover:bg-green-100 px-2.5 py-1 rounded-lg border border-green-100 transition-colors shadow-sm md:hidden">
                <span class="material-symbols-outlined text-secondary text-xs">
                    {{ Auth::user()->role === 'admin' ? 'admin_panel_settings' : 'account_circle' }}
                </span>
                <span class="text-xs font-semibold text-primary truncate max-w-[70px]">{{ Auth::user()->name }}</span>
            </a>
        @else
            <a href="{{ route('ketersediaan') ?? route('login') }}" class="bg-orange-500 text-white px-3 py-1.5 rounded-lg font-semibold text-xs shadow-sm">
                Pesan
            </a>
        @endauth

        <button @click="openMobile = !openMobile" class="p-2 text-gray-600 hover:bg-gray-100 rounded-xl transition-colors focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <div x-show="openMobile" @click.away="openMobile = false" class="absolute top-full left-0 right-0 mt-2 bg-white/95 backdrop-blur-md border border-gray-100 rounded-2xl shadow-xl p-4 flex flex-col space-y-2.5 lg:hidden" style="display: none;">
        <a href="{{ url('/') }}" class="text-text hover:text-primary transition-colors font-medium py-1 text-sm">Home</a>
        <a href="{{ route('ketersediaan') ?? '#' }}" class="text-text hover:text-primary transition-colors font-medium py-1 text-sm">Cek Jadwal</a>
        <a href="{{ url('/#about') }}" @click="openMobile = false" class="text-text hover:text-primary transition-colors font-medium py-1 text-sm">Tentang Kami</a>
        <a href="{{ url('/#facilities') }}" @click="openMobile = false" class="text-text hover:text-primary transition-colors font-medium py-1 text-sm">Fasilitas</a>
        <a href="{{ url('/#gallery') }}" @click="openMobile = false" class="text-text hover:text-primary transition-colors font-medium py-1 text-sm">Galeri</a>

        @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="text-text hover:text-primary transition-colors font-medium py-1 text-sm">Dashboard Admin</a>
            <a href="{{ route('admin.laporan') }}" class="text-text hover:text-primary transition-colors font-medium py-1 text-sm">Laporan</a>
        @elseif(Auth::check())
            <a href="{{ route('dashboard') }}" class="text-text hover:text-primary transition-colors font-medium py-1 text-sm">Dashboard</a>
        @endif

        <hr class="border-gray-100 my-1">

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left bg-red-50 text-red-600 hover:bg-red-100 px-4 py-2 rounded-xl font-semibold transition-colors text-sm shadow-sm">
                    Logout
                </button>
            </form>
        @else
            <div class="flex flex-col gap-2 pt-1">
                <a href="{{ route('dashboard') }}" class="text-center bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl font-semibold transition-colors text-sm shadow-sm">
                    Pesan Sekarang
                </a>
                <a href="{{ route('register') }}" class="text-center bg-primary hover:bg-green-800 text-white px-4 py-2 rounded-xl font-semibold transition-colors text-sm shadow-md">Daftar</a>
            </div>
        @endauth
    </div>
</nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>