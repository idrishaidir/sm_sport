<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Reservasi - SM Sport Center</title>

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
                        primary: '#166534',
                        secondary: '#10B981',
                        accent: '#84CC16',
                        background: '#F8FAF8',
                        surface: '#FFFFFF',
                        text: '#1F2937',
                        highlight: '#F97316',
                    },
                    borderRadius: {
                        'bento': '20px',
                    },
                    boxShadow: {
                        'bento': '0 8px 30px rgba(0,0,0,0.04)',
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
            border: 1px solid rgba(16, 185, 129, 0.05);
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="font-sans antialiased selection:bg-secondary selection:text-white pt-28 pb-10">

    <!-- Navigation -->
    <nav class="fixed top-4 left-0 right-0 z-50 mx-4 md:mx-auto max-w-7xl glass-panel rounded-bento px-6 py-4 flex justify-between items-center shadow-sm">
        <a href="{{ route('home') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white font-bold text-lg">SM</div>
            <span class="font-bold text-xl text-primary hidden sm:block">Sport Center</span>
        </a>
        
        <div class="flex items-center space-x-4">
            <div class="text-sm font-medium text-text mr-4 hidden md:block">
                Halo, {{ Auth::user()->name }}
            </div>
            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-5 py-2 rounded-xl font-semibold transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Notifikasi -->
        @if(session('Succes'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-bento relative flex items-center gap-3" role="alert">
            <span class="material-symbols-outlined">check_circle</span>
            <span class="block sm:inline font-medium">{{ session('Succes') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-bento relative flex items-center gap-3" role="alert">
            <span class="material-symbols-outlined">error</span>
            <span class="block sm:inline font-medium">{{ session('error') }}</span>
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-bento">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Grid Layout Kiri & Kanan -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- KOLOM KIRI: Form Reservasi -->
            <div class="lg:col-span-4 bento-card p-8 self-start">
                <h2 class="text-2xl font-bold text-primary mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">edit_document</span>
                    Form Booking
                </h2>

                <form action="{{ route('reservasi.store') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <!-- Lapangan -->
                    <div>
                        <label for="lapangan_id" class="block text-sm font-semibold text-text mb-2">Pilih Lapangan</label>
                        <select id="lapangan_id" name="lapangan_id" required class="w-full border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 px-4">
                            <option value="">-- Pilih Lapangan --</option>
                            @foreach($lapangans as $lapangan)
                                <option value="{{ $lapangan->id }}">{{ $lapangan->nama_lapangan }} ({{ $lapangan->jenis_lapangan }}) - Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}/jam</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label for="tanggal" class="block text-sm font-semibold text-text mb-2">Tanggal Main</label>
                        <input type="date" id="tanggal" name="tanggal" required min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" class="w-full border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 px-4">
                    </div>
         
                    <div>
                        <label for="jam_mulai" class="block text-sm font-semibold text-text mb-2">Jam Mulai</label>
                        <select id="jam_mulai" name="jam_mulai" required class="w-full border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 px-4">
                            <option value="">-- Pilih Jam --</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                            <option value="19:00">19:00</option>
                            <option value="20:00">20:00</option>
                            <option value="21:00">21:00</option>
                            <option value="22:00">22:00</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">*Pilih dari daftar atau klik blok hijau di sebelah.</p>
                    </div>

                    
                    <div>
                        <label for="durasi_jam" class="block text-sm font-semibold text-text mb-2">Durasi (Jam)</label>
                        <input type="number" id="durasi_jam" name="durasi_jam" required min="1" max="5" value="1" class="w-full border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 px-4">
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-green-800 text-white font-bold py-3.5 rounded-xl transition-all shadow-md mt-4">
                        Booking Sekarang
                    </button>
                </form>
            </div>

            <!-- KOLOM KANAN: Real-time Ketersediaan -->
            <div class="lg:col-span-8 bento-card p-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <h2 class="text-2xl font-bold text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">calendar_month</span>
                        Cek Ketersediaan
                    </h2>
                    <div class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg text-sm font-medium border border-blue-200">
                        Sinkronisasi Otomatis dengan Form
                    </div>
                </div>

                <!-- Container Hasil -->
                <div id="slot-container" class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-4 min-h-[300px] content-start">
                    <div class="col-span-full py-16 text-center border-dashed border-2 border-gray-200 rounded-xl">
                        <span class="material-symbols-outlined text-gray-300 text-6xl mb-3">touch_app</span>
                        <p class="text-text/50 font-medium text-lg">Silakan pilih lapangan di form sebelah kiri terlebih dahulu.</p>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-sm text-text/70 border-t border-gray-100 pt-6">
                    <div class="flex items-center gap-2">
                        <span class="w-5 h-5 rounded bg-green-50 border-2 border-secondary flex items-center justify-center"></span> 
                        <span>Tersedia (Bisa Diklik)</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-5 h-5 rounded bg-gray-100 border-2 border-gray-300 flex items-center justify-center"></span> 
                        <span>Sudah Dipesan</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Script Fetch API Terintegrasi -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen dari form sebelah kiri
            const tglInput = document.getElementById('tanggal');
            const lapInput = document.getElementById('lapangan_id');
            const jamInput = document.getElementById('jam_mulai');
            const container = document.getElementById('slot-container');

            const jamOperasional = [
                '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', 
                '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'
            ];

            function cekJadwal() {
                const tanggal = tglInput.value;
                const lapangan_id = lapInput.value;

                if (!tanggal || !lapangan_id) {
                    container.innerHTML = `
                        <div class="col-span-full py-16 text-center border-dashed border-2 border-gray-200 rounded-xl">
                            <span class="material-symbols-outlined text-gray-300 text-6xl mb-3">touch_app</span>
                            <p class="text-text/50 font-medium text-lg">Silakan pilih lapangan di form sebelah kiri terlebih dahulu.</p>
                        </div>`;
                    return;
                }

                container.innerHTML = `
                    <div class="col-span-full py-20 text-center flex flex-col items-center justify-center">
                        <span class="material-symbols-outlined text-secondary animate-spin text-4xl mb-3">refresh</span>
                        <p class="text-secondary font-medium text-lg">Memuat data ketersediaan...</p>
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
                                div.className = 'py-4 px-2 rounded-xl border-2 border-gray-200 bg-gray-100 text-gray-400 text-center cursor-not-allowed flex flex-col items-center gap-1';
                                div.innerHTML = `
                                    <span class="font-bold text-lg">${jam}</span> 
                                    <span class="text-[10px] font-medium bg-gray-200 px-2 py-0.5 rounded text-gray-500 uppercase tracking-wider">Dipesan</span>`;
                            } else {
                                // Tambahkan fitur click untuk mengisi input Jam Mulai
                                div.className = 'py-4 px-2 rounded-xl border-2 border-secondary/30 bg-green-50 text-primary text-center font-semibold transition-all hover:bg-secondary hover:text-white hover:border-secondary hover:-translate-y-1 shadow-sm cursor-pointer flex flex-col items-center gap-1 group';
                                div.innerHTML = `
                                    <span class="font-bold text-lg">${jam}</span> 
                                    <span class="text-[10px] font-medium bg-white/50 px-2 py-0.5 rounded text-primary group-hover:text-white uppercase tracking-wider">Pilih</span>`;
                                
                                // Event listener ketika user klik kotak hijau
                                div.addEventListener('click', function() {
                                    jamInput.value = jam;
                                    
                                    // Berikan efek visual sebentar agar user tahu jam sudah terpilih
                                    div.classList.add('ring-4', 'ring-secondary', 'ring-opacity-50');
                                    setTimeout(() => {
                                        div.classList.remove('ring-4', 'ring-secondary', 'ring-opacity-50');
                                    }, 300);
                                });
                            }
                            
                            container.appendChild(div);
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        container.innerHTML = `<div class="col-span-full text-center text-red-500 py-6 font-medium bg-red-50 rounded-xl">Gagal menghubungi server.</div>`;
                    });
            }

            // Panggil cekJadwal saat pengguna mengganti tanggal atau lapangan
            tglInput.addEventListener('change', cekJadwal);
            lapInput.addEventListener('change', cekJadwal);
            
            // Panggil sekali saat halaman dimuat (jika ada nilai default)
            if(lapInput.value) cekJadwal();
        });
    </script>
</body>
</html>