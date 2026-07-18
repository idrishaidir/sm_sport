<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SM Sport Center')</title>

    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'], },
                    colors: { primary: '#166534', secondary: '#10B981', accent: '#84CC16', background: '#F8FAF8', surface: '#FFFFFF', text: '#1F2937', highlight: '#F97316', },
                    borderRadius: { 'bento': '20px', },
                    boxShadow: { 'bento': '0 8px 30px rgba(0,0,0,0.04)', }
                }
            }
        }
    </script>
    <style>
        body { background-color: #F8FAF8; color: #1F2937; }
        .bento-card { background-color: #FFFFFF; border-radius: 20px; box-shadow: 0 8px 30px rgba(0,0,0,0.04); border: 1px solid rgba(16, 185, 129, 0.05); transition: transform 0.3s ease; }
        .bento-card:hover { transform: translateY(-2px); }
        .glass-panel { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.5); }
    </style>
    @stack('styles') 
</head>
<body class="font-sans antialiased selection:bg-secondary selection:text-white pt-28 pb-10">

    <nav class="fixed top-4 left-0 right-0 z-50 mx-4 md:mx-auto max-w-7xl glass-panel rounded-bento px-6 py-4 flex justify-between items-center shadow-sm">
        
        <a href="{{ url('/') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white font-bold text-lg">SM</div>
            <span class="font-bold text-xl text-primary hidden sm:block">Sport Center</span>
        </a>
        
        <div class="hidden lg:flex space-x-8">
            @if(Auth::check() && Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="text-text hover:text-primary transition-colors font-medium">Dashboard Admin</a>
                <a href="{{ route('admin.laporan') }}" class="text-text hover:text-primary transition-colors font-medium">Laporan</a>
            @else
                <a href="{{ url('/') }}" class="text-text hover:text-primary transition-colors font-medium">Home</a>
                <a href="{{ route('ketersediaan') ?? '#' }}" class="text-text hover:text-primary transition-colors font-medium">Cek Jadwal</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-text hover:text-primary transition-colors font-medium">Dashboard</a>
                @endauth
            @endif
        </div>

        <div class="flex items-center space-x-4">
            @auth
                <div class="flex items-center gap-2 bg-green-50 px-3 py-1.5 rounded-lg border border-green-100 hidden md:flex">
                    <span class="material-symbols-outlined text-secondary text-sm">
                        {{ Auth::user()->role === 'admin' ? 'admin_panel_settings' : 'account_circle' }}
                    </span>
                    <span class="text-sm font-semibold text-primary">{{ Auth::user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-4 py-2 rounded-xl font-semibold transition-colors text-sm">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-primary font-semibold hover:text-green-800 px-4 py-2">Login</a>
                <a href="{{ route('register') }}" class="bg-primary hover:bg-green-800 text-white px-4 py-2 rounded-xl font-semibold transition-colors text-sm shadow-md">Daftar</a>
            @endauth
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>