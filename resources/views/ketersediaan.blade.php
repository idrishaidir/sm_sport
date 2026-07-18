<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Jadwal - SM Sport Center</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Tailwind CSS Custom Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: '#166534', /* Forest Green */
                        secondary: '#10B981', /* Emerald Green */
                        accent: '#84CC16', /* Lime Green */
                        background: '#F8FAF8', /* Off White */
                        surface: '#FFFFFF', /* White */
                        text: '#1F2937', /* Dark Slate */
                        highlight: '#F97316', /* Soft Orange */
                    },
                    borderRadius: {
                        'bento': '20px',
                    },
                    boxShadow: {
                        'bento': '0 8px 30px rgba(0,0,0,0.04)',
                        'bento-hover': '0 15px 40px rgba(22,101,52,0.08)',
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #F8FAF8; color: #1F2937; }
        .bento-card {
            background-color: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.04);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(16, 185, 129, 0.05);
            overflow: hidden;
        }
        .bento-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 40px rgba(22,101,52,0.08);
            border-color: rgba(16, 185, 129, 0.2);
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="font-sans antialiased selection:bg-secondary selection:text-white">

    <!-- 1. Navigation -->
    <nav class="fixed top-4 left-0 right-0 z-50 mx-4 md:mx-auto max-w-7xl glass-panel rounded-bento px-6 py-4 flex justify-between items-center transition-all shadow-sm">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-3 cursor-pointer hover:opacity-80 transition-opacity">
            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white font-bold text-lg">
                SM
            </div>
            <span class="font-bold text-xl text-primary tracking-tight hidden sm:block">Sport Center</span>
        </a>
        
        <!-- Center Menu -->
        <div class="hidden lg:flex space-x-8">
            <a href="{{ route('home') }}" class="text-text hover:text-primary transition-colors font-medium">Home</a>
            <a href="{{ route('ketersediaan') }}" class="text-primary font-semibold">Cek Jadwal</a>
            <a href="{{ route('home') }}#facilities" class="text-text hover:text-primary transition-colors font-medium">Facilities</a>
            <a href="{{ route('home') }}#contact" class="text-text hover:text-primary transition-colors font-medium">Contact</a>
        </div>

        <!-- Right Side Actions -->
        <div class="flex items-center space-x-4">
            @auth
                <a href="{{ route('dashboard') }}" class="text-text font-medium hover:text-primary transition-colors hidden md:block">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-text font-medium hover:text-primary transition-colors hidden md:block">Login</a>
            @endauth
            
            <a href="{{ route('register') }}" class="bg-highlight hover:bg-orange-600 text-white px-6 py-2.5 rounded-xl font-semibold shadow-md transition-all hover:-translate-y-0.5">
                Book Now
            </a>
        </div>
    </nav>

    <!-- Main Content Wrapper for Spacing -->
    <div class="pt-28 pb-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- 2. Ketersediaan Bento Card -->
        <section class="bento-card p-8 md:p-12">
            
            <div class="flex items-center gap-4 mb-8">
                <div class="w-2 h-8 bg-secondary rounded-full"></div>
                <div>
                    <h2 class="text-3xl font-bold text-primary">Cek Jadwal Lapangan</h2>
                    <p class="text-text/70 mt-1">Pilih tanggal dan lapangan untuk melihat waktu yang masih tersedia.</p>
                </div>
            </div>

            <!-- Filter Real-time -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10 bg-background p-6 rounded-2xl border border-gray-100">
                <div>
                    <label for="tanggal" class="block text-sm font-semibold text-primary mb-2">Pilih Tanggal</label>
                    <input type="date" id="tanggal" class="w-full border-gray-200 text-text rounded-xl shadow-sm focus:border-secondary focus:ring-secondary py-3 px-4" value="{{ date('Y-m-d') }}">
                </div>
                <div>
                    <label for="lapangan_id" class="block text-sm font-semibold text-primary mb-2">Pilih Lapangan</label>
                    <select id="lapangan_id" class="w-full border-gray-200 text-text rounded-xl shadow-sm focus:border-secondary focus:ring-secondary py-3 px-4">
                        <option value="">-- Silakan Pilih Lapangan --</option>
                        @foreach($lapangans as $lapangan)
                            <option value="{{ $lapangan->id }}">{{ $lapangan->nama_lapangan }} ({{ $lapangan->jenis_lapangan }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Area Hasil (Grid Waktu) -->
            <div>
                <h3 class="text-xl font-semibold text-text mb-6">Status Ketersediaan Waktu:</h3>
                
                <!-- Container ini akan diisi oleh JavaScript -->
                <div id="slot-container" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                    <div class="col-span-full bento-card p-10 text-center flex flex-col items-center justify-center border-dashed border-2 border-gray-200 shadow-none">
                        <span class="material-symbols-outlined text-gray-300 text-5xl mb-3">calendar_month</span>
                        <p class="text-text/50 font-medium">Silakan pilih lapangan terlebih dahulu untuk melihat jadwal.</p>
                    </div>
                </div>
            </div>
            
            <!-- Keterangan Status -->
            <div class="mt-10 flex flex-wrap items-center justify-center gap-6 text-sm text-text/70 border-t border-gray-100 pt-8">
                <div class="flex items-center gap-2">
                    <span class="w-5 h-5 rounded-lg bg-green-50 border-2 border-secondary flex items-center justify-center">
                        <span class="material-symbols-outlined text-[12px] text-secondary">check</span>
                    </span> 
                    <span class="font-medium">Tersedia</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-5 h-5 rounded-lg bg-gray-100 border-2 border-gray-200 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[12px] text-gray-400">close</span>
                    </span> 
                    <span class="font-medium">Telah Dipesan</span>
                </div>
            </div>
        </section>

        <!-- 3. Footer -->
        <footer class="mt-16 bento-card p-10 bg-white">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 border-b border-gray-100 pb-10">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white font-bold text-sm">SM</div>
                        <span class="font-bold text-lg text-primary">Sport Center</span>
                    </div>
                    <p class="text-sm text-text/70 leading-relaxed mb-6">
                        Providing modern, comfortable, and professional sports facilities to encourage a healthy lifestyle.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-bold text-primary mb-4">Quick Links</h4>
                    <ul class="space-y-3 text-sm text-text/70">
                        <li><a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a></li>
                        <li><a href="{{ route('ketersediaan') }}" class="hover:text-primary transition-colors">Cek Ketersediaan</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-primary transition-colors">Login / Register</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-primary mb-4">Contact Info</h4>
                    <ul class="space-y-3 text-sm text-text/70">
                        <li>📍 123 Health Avenue, City</li>
                        <li>📞 +62 812 3456 7890</li>
                        <li>✉️ hello@smsport.com</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-primary mb-4">Opening Hours</h4>
                    <ul class="space-y-3 text-sm text-text/70">
                        <li>Monday - Friday: 08:00 - 23:00</li>
                        <li>Saturday - Sunday: 07:00 - 23:00</li>
                    </ul>
                </div>
            </div>
            <div class="pt-6 text-center text-xs text-text/50">
                <p>&copy; 2026 SM Sport Center. All rights reserved.</p>
            </div>
        </footer>

    </div>

    <!-- Script Fetch API Real-time -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tglInput = document.getElementById('tanggal');
            const lapInput = document.getElementById('lapangan_id');
            const container = document.getElementById('slot-container');

            // Asumsi jam operasional SM Sport Center (08:00 - 23:00)
            const jamOperasional = [
                '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', 
                '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'
            ];

            function cekJadwal() {
                const tanggal = tglInput.value;
                const lapangan_id = lapInput.value;

                if (!tanggal || !lapangan_id) {
                    container.innerHTML = `
                        <div class="col-span-full bento-card p-10 text-center flex flex-col items-center justify-center border-dashed border-2 border-gray-200 shadow-none">
                            <span class="material-symbols-outlined text-gray-300 text-5xl mb-3">calendar_month</span>
                            <p class="text-text/50 font-medium">Silakan pilih lapangan terlebih dahulu untuk melihat jadwal.</p>
                        </div>`;
                    return;
                }

                container.innerHTML = `
                    <div class="col-span-full py-10 text-center flex flex-col items-center justify-center">
                        <span class="material-symbols-outlined text-secondary animate-spin text-4xl mb-2">refresh</span>
                        <p class="text-secondary font-medium">Memuat data ketersediaan...</p>
                    </div>`;

                fetch(`/api/jadwal?tanggal=${tanggal}&lapangan_id=${lapangan_id}`)
                    .then(response => response.json())
                    .then(bookedSlots => {
                        if (!Array.isArray(bookedSlots)) {
                            container.innerHTML = `<div class="col-span-full text-center text-red-500 py-6 font-medium bg-red-50 rounded-xl">Terjadi kesalahan di server.</div>`;
                            return; 
                        }

                        container.innerHTML = ''; 

                        jamOperasional.forEach(jam => {
                            const isBooked = bookedSlots.includes(jam);
                            const div = document.createElement('div');
                            
                            if (isBooked) {
                                div.className = 'py-4 px-3 rounded-xl border-2 border-gray-100 bg-gray-50 text-gray-400 text-center cursor-not-allowed flex flex-col items-center justify-center gap-1';
                                div.innerHTML = `
                                    <span class="font-bold text-lg">${jam}</span> 
                                    <span class="text-xs font-medium bg-gray-200 px-2 py-0.5 rounded text-gray-500">Dipesan</span>`;
                            } else {
                                div.className = 'py-4 px-3 rounded-xl border-2 border-secondary/30 bg-green-50 text-primary text-center font-semibold transition-all hover:bg-secondary hover:text-white hover:border-secondary hover:-translate-y-1 shadow-sm cursor-pointer flex flex-col items-center justify-center gap-1 group';
                                div.innerHTML = `
                                    <span class="font-bold text-lg">${jam}</span> 
                                    <span class="text-xs font-medium bg-white/50 px-2 py-0.5 rounded text-primary group-hover:text-white">Tersedia</span>`;
                            }
                            
                            container.appendChild(div);
                        });
                    })
                    .catch(error => {
                        console.error('Error jaringan/Fetch:', error);
                        container.innerHTML = `<div class="col-span-full text-center text-red-500 py-6 font-medium bg-red-50 rounded-xl">Gagal menghubungi server.</div>`;
                    });
            }

            tglInput.addEventListener('change', cekJadwal);
            lapInput.addEventListener('change', cekJadwal);
        });
    </script>
</body>
</html>