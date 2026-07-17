<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- SEO Optimization Tags -->
    <title>SM Sport Center - Reservasi Lapangan Futsal & Badminton Online</title>
    <meta name="description" content="Sistem reservasi online SM Sport Center. Pesan jadwal lapangan futsal dan badminton premium dengan mudah, cepat, dan bebas jadwal bentrok.">
    <meta name="keywords" content="reservasi lapangan, sewa futsal, sewa badminton, sm sport center, booking lapangan olahraga, fasilitas premium">
    <meta name="author" content="SM Sport Center">
    <meta name="robots" content="index, follow">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Vite (Tailwind CSS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Color Palette Variables */
        :root {
            --cream: #F1DEC4;
            --dark-green: #677E61;
            --sage-green: #73976A;
            --brick-red: #BD4444;
        }

body{
    background:
    linear-gradient(
        180deg,
        #f8f6f2,
        #f3ead7,
        #efe7d6
    );
}

        /* Claymorphism Utilities */
        .clay-card{
            background:#F8F5EE;
            border-radius:24px;
            border:1px solid rgba(103,126,97,.08);
            box-shadow:
                0 10px 30px rgba(0,0,0,.08);
            
            transition:.3s;
        }

        .clay-card-inner {
            background-color: var(--cream);
            border-radius: 2.5rem;
            box-shadow: inset 8px 8px 16px rgba(103, 126, 97, 0.15), 
                       inset -8px -8px 16px rgba(255, 255, 255, 0.7);
        }

        .clay-card:hover{
            transform:translateY(-8px);
            box-shadow:
                0 18px 40px rgba(0,0,0,.12);
        }

        .clay-btn-red {
            background-color: var(--brick-red);
            color: #F1DEC4;
            border-radius: 9999px;
            box-shadow: 6px 6px 12px rgba(103, 126, 97, 0.2), 
                       -6px -6px 12px rgba(255, 255, 255, 0.8),
                       inset 2px 2px 4px rgba(255, 255, 255, 0.3), 
                       inset -2px -2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .clay-btn-red:hover {
            transform: translateY(-2px);
            box-shadow: 8px 8px 16px rgba(103, 126, 97, 0.25), 
                       -8px -8px 16px rgba(255, 255, 255, 0.9),
                       inset 2px 2px 4px rgba(255, 255, 255, 0.4), 
                       inset -2px -2px 4px rgba(0, 0, 0, 0.15);
        }

        .clay-btn-red:active {
            transform: translateY(1px);
            box-shadow: inset 4px 4px 8px rgba(0, 0, 0, 0.2), 
                       inset -4px -4px 8px rgba(255, 255, 255, 0.2);
        }

        .clay-btn-green {
            background-color: var(--sage-green);
            color: #F1DEC4;
            border-radius: 9999px;
            box-shadow: 6px 6px 12px rgba(103, 126, 97, 0.2), 
                       -6px -6px 12px rgba(255, 255, 255, 0.8),
                       inset 2px 2px 4px rgba(255, 255, 255, 0.3), 
                       inset -2px -2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }
    </style>
</head>
<body class="font-sans antialiased selection:bg-[#BD4444] selection:text-[#F1DEC4] pb-12">

    <!-- Navigation -->
    <nav class="w-full pt-8 pb-4 px-4 sm:px-6 lg:px-8 max-w-[1400px] mx-auto flex justify-between items-center z-50 relative">
        <div class="text-3xl font-black text-[#677E61] uppercase tracking-tighter">
            SM SPORT
        </div>
        
        <div class="hidden md:flex gap-8 text-sm font-bold text-[#73976A] uppercase tracking-wider">
            <a href="#fasilitas" class="hover:text-[#BD4444] transition-colors">Fasilitas</a>
            <a href="#tentang" class="hover:text-[#BD4444] transition-colors">Tentang Kami</a>
            <a href="#cara-pesan" class="hover:text-[#BD4444] transition-colors">Panduan</a>
        </div>

        <div class="flex gap-4">
            @if (Route::has('login'))
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ url('/admin/dashboard') }}" class="clay-btn-green font-bold text-xs uppercase px-6 py-3">Dashboard Admin</a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="clay-btn-green font-bold text-xs uppercase px-6 py-3">Dashboard Saya</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="clay-btn-green font-bold text-xs uppercase px-6 py-3 hidden sm:inline-block">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="clay-btn-red font-bold text-xs uppercase px-6 py-3">Daftar</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <main class="max-w-[1400px] mx-auto px-4 sm:px-6 space-y-12 mt-4">

        <!-- 1. Hero Section (Image Background, Left Aligned Text) -->
        <header class="clay-card p-4 h-[600px] md:h-[560px] relative flex items-center">
            <!-- Inner container for the image to preserve outer clay border -->
            <div class="w-full h-full rounded-[2rem] overflow-hidden relative shadow-inner">
                <!-- Background Image Placeholder (Unsplash) -->
                <img src="https://images.unsplash.com/photo-1574629810360-7efbb1925536?q=80&w=2000&auto=format&fit=crop" alt="Pemain sepak bola di lapangan" class="absolute inset-0 w-full h-full object-cover object-center" />
                
                <!-- Gradient Overlay for Text Readability -->
                <div class="absolute inset-0 bg-gradient-to-r from-[#556d55]/90 via-[#556d55]/50 to-transparent backdrop-blur-[2px]"></div>

                <!-- Left Aligned Content -->
                <div class="relative z-10 w-full max-w-3xl px-8 md:px-16 flex flex-col justify-center h-full">
                    <span class="inline-block bg-[#F1DEC4] text-[#BD4444] font-black tracking-widest text-xs px-4 py-2 rounded-full mb-6 w-max shadow-md">
                        Reservasi Real-Time
                    </span>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-[#F1DEC4] leading-[1.1] mb-6 tracking-tight">
                        Waktunya Bermain, <br>
                        <span class="text-[#73976A]">Bukan Mengantre.</span>
                    </h1>
                    <p class="text-lg text-[#F1DEC4]/90 font-medium mb-10 leading-relaxed max-w-xl">
                        Sistem manajemen fasilitas olahraga cerdas. Temukan jadwal kosong, amankan lapangan Anda, dan rasakan kualitas lapangan premium kami.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('reservasi.create') }}" class="clay-btn-red text-center font-bold text-sm uppercase tracking-wider px-10 py-4">
                            Booking Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- 2. Fasilitas Section (Bento Grid) -->
        <section id="fasilitas" class="pt-10">
            <div class="mb-8 px-4">
                <h2 class="text-4xl font-black text-[#677E61] uppercase tracking-tight">Fasilitas Lapangan</h2>
                <p class="text-[#73976A] font-bold mt-2">Infrastruktur standar profesional untuk performa maksimal.</p>
            </div>

            <!-- Bento Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($lapangans as $index => $lapangan)
                    <!-- Bento Item: Item pertama membentang 2 kolom (asimetris) -->
                    <article class="clay-card p-6 flex flex-col {{ $index == 0 ? 'md:col-span-2' : 'col-span-1' }}">
                        <div class="w-full h-56 rounded-3xl overflow-hidden relative mb-6 clay-card-inner">
                            @if($lapangan->jenis_lapangan == 'Futsal')
                                <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover mix-blend-multiply opacity-80" alt="Futsal Court">
                            @else
                                <img src="https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover mix-blend-multiply opacity-80" alt="Badminton Court">
                            @endif
                        </div>
                        
                        <div class="flex flex-col h-full justify-between px-2">
                            <div>
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-2xl font-black text-[#677E61] uppercase tracking-tight">{{ $lapangan->nama_lapangan }}</h3>
                                    <span class="bg-[#73976A] text-[#F1DEC4] text-[10px] font-bold uppercase px-3 py-1 rounded-full">
                                        {{ $lapangan->jenis_lapangan }}
                                    </span>
                                </div>
                                <p class="text-[#73976A] font-medium text-sm mb-6 line-clamp-2">
                                    {{ $lapangan->jenis_lapangan == 'Futsal' ? 'Lapangan vinyl standar FIFA. Pencahayaan LED optimal untuk turnamen dan latihan rutin.' : 'Karpet BWF Approved anti-slip. Sirkulasi udara teratur, bebas gangguan angin.' }}
                                </p>
                            </div>
                            <div class="flex justify-between items-end border-t-2 border-[#73976A]/20 pt-4 mt-auto">
                                <div>
                                    <p class="text-[#73976A] font-bold text-xs uppercase tracking-widest mb-1">Tarif Sewa</p>
                                    <p class="text-2xl font-black text-[#BD4444]">Rp {{ number_format($lapangan->harga_per_jam/1000, 0) }}k<span class="text-sm font-bold text-[#677E61]">/jam</span></p>
                                </div>
                                <a href="{{ route('reservasi.create') }}" class="clay-btn-red w-12 h-12 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="clay-card p-12 col-span-full text-center">
                        <p class="text-[#677E61] font-bold text-lg">Belum ada data lapangan tersedia.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- 3 & 4. Tentang Kami & Cara Pesan (Bento Row) -->
        <section id="tentang" class="grid grid-cols-1 lg:grid-cols-2 gap-6 pt-6">
            <!-- Tentang Card -->
            <div class="clay-card p-10 md:p-14 flex flex-col justify-center">
                <h2 class="text-3xl md:text-4xl font-black text-[#677E61] uppercase tracking-tight mb-6">Inovasi Layanan Olahraga.</h2>
                <div class="space-y-4 text-[#73976A] font-medium leading-relaxed">
                    <p>SM Sport Center menolak sistem pemesanan manual yang usang. Kami memastikan 100% transparansi jadwal melalui sistem digital terintegrasi ini.</p>
                    <p>Fasilitas kami dirawat secara berkala untuk menjaga standar pantulan bola, traksi sepatu, dan kenyamanan pemain dari level amatir hingga profesional.</p>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-10">
                    <div class="clay-card-inner p-6 text-center">
                        <p class="text-4xl font-black text-[#BD4444] mb-1">100%</p>
                        <p class="text-[#677E61] text-xs font-bold uppercase tracking-wider">Anti Bentrok</p>
                    </div>
                    <div class="clay-card-inner p-6 text-center">
                        <p class="text-4xl font-black text-[#BD4444] mb-1">16h</p>
                        <p class="text-[#677E61] text-xs font-bold uppercase tracking-wider">Operasional</p>
                    </div>
                </div>
            </div>

            <!-- Cara Pesan Card -->
            <div class="clay-card p-10 md:p-14 bg-[#73976A] text-[#F1DEC4] border-none" style="box-shadow: 12px 12px 24px rgba(103, 126, 97, 0.3), -12px -12px 24px rgba(255, 255, 255, 0.4), inset 2px 2px 4px rgba(255, 255, 255, 0.2), inset -2px -2px 4px rgba(0, 0, 0, 0.1);">
                <h2 class="text-3xl font-black uppercase tracking-tight mb-10 text-[#F1DEC4]">4 Langkah Booking</h2>
                <div class="space-y-6">
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 rounded-2xl bg-[#677E61] flex items-center justify-center font-black text-xl shadow-inner shrink-0 text-[#F1DEC4]">1</div>
                        <div>
                            <h3 class="font-black text-lg uppercase tracking-wide">Registrasi Akun</h3>
                            <p class="text-[#F1DEC4]/80 text-sm font-medium">Buat akun untuk merekam riwayat permainan Anda.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 rounded-2xl bg-[#677E61] flex items-center justify-center font-black text-xl shadow-inner shrink-0 text-[#F1DEC4]">2</div>
                        <div>
                            <h3 class="font-black text-lg uppercase tracking-wide">Pilih Jadwal</h3>
                            <p class="text-[#F1DEC4]/80 text-sm font-medium">Cek tabel ketersediaan dan pilih slot waktu.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 rounded-2xl bg-[#677E61] flex items-center justify-center font-black text-xl shadow-inner shrink-0 text-[#F1DEC4]">3</div>
                        <div>
                            <h3 class="font-black text-lg uppercase tracking-wide">Validasi Sistem</h3>
                            <p class="text-[#F1DEC4]/80 text-sm font-medium">Sistem mengunci jadwal secara otomatis.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 rounded-2xl bg-[#BD4444] flex items-center justify-center font-black text-xl shadow-inner shrink-0 text-[#F1DEC4]">4</div>
                        <div>
                            <h3 class="font-black text-lg uppercase tracking-wide">Pembayaran</h3>
                            <p class="text-[#F1DEC4]/80 text-sm font-medium">Selesaikan transaksi untuk status Lunas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Kontak & CTA (Bento Row) -->
        <section id="kontak" class="grid grid-cols-1 lg:grid-cols-3 gap-6 pt-6">
            
            <!-- CTA Card -->
            <div class="clay-card p-10 lg:col-span-2 flex flex-col justify-center items-center text-center bg-[#677E61] border-none" style="box-shadow: 12px 12px 24px rgba(103, 126, 97, 0.4), -12px -12px 24px rgba(255, 255, 255, 0.4), inset 2px 2px 4px rgba(255, 255, 255, 0.1), inset -2px -2px 4px rgba(0, 0, 0, 0.2);">
                <h2 class="text-4xl md:text-5xl font-black text-[#F1DEC4] mb-6 uppercase tracking-tight">Kunci Lapangan Anda</h2>
                <p class="text-[#73976A] text-lg font-bold mb-10 max-w-lg text-[#F1DEC4]/80">
                    Jadwal prime-time (malam hari) sangat cepat terisi. Jangan sampai tim Anda kehilangan momen berharga.
                </p>
                <a href="{{ route('register') }}" class="clay-btn-red font-black uppercase tracking-widest text-lg px-12 py-5">
                    Mulai Reservasi
                </a>
            </div>

            <!-- Kontak Card -->
            <div class="clay-card p-10 flex flex-col justify-between">
                <div>
                    <h2 class="text-2xl font-black text-[#677E61] uppercase tracking-tight mb-8">Pusat Bantuan</h2>
                    
                    <div class="space-y-6">
                        <div>
                            <p class="text-[#73976A] font-bold text-xs uppercase tracking-widest mb-1">Alamat</p>
                            <p class="text-[#677E61] font-bold">Jl. Olahraga No. 88<br>Kota Pusat, 12345</p>
                        </div>
                        <div>
                            <p class="text-[#73976A] font-bold text-xs uppercase tracking-widest mb-1">WhatsApp</p>
                            <p class="text-[#677E61] font-black text-xl">0812-3456-7890</p>
                        </div>
                        <div>
                            <p class="text-[#73976A] font-bold text-xs uppercase tracking-widest mb-1">Email</p>
                            <p class="text-[#677E61] font-bold">admin@smsport.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="pt-6 pb-6">
            <div class="clay-card p-8 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-xl font-black text-[#677E61] uppercase tracking-tighter">
                    SM SPORT
                </div>
                
                <p class="text-[#73976A] font-bold text-xs uppercase tracking-widest text-center">
                    &copy; {{ date('Y') }} Sistem Reservasi Berbasis Web
                </p>

                <div class="flex gap-6 text-[#73976A] font-bold text-xs uppercase tracking-widest">
                    <a href="#" class="hover:text-[#BD4444] transition-colors">Privasi</a>
                    <a href="#" class="hover:text-[#BD4444] transition-colors">Syarat</a>
                </div>
            </div>
        </footer>

    </main>
</body>
</html>