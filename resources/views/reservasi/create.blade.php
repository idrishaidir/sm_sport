@extends('layouts.main')

@section('title', 'Buat Reservasi - SM Sport Center')

@section('content')
    <!-- Notifikasi -->
    @if(session('Succes') || session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-bento relative flex items-center gap-3 mb-6 shadow-sm">
        <span class="material-symbols-outlined">check_circle</span>
        <span class="block sm:inline font-medium">{{ session('Succes') ?? session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-bento relative flex items-center gap-3 mb-6 shadow-sm">
        <span class="material-symbols-outlined">error</span>
        <span class="block sm:inline font-medium">{{ session('error') }}</span>
    </div>
    @endif

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-bento mb-6 shadow-sm">
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
                            <option value="{{ $lapangan->id }}">{{ $lapangan->nama_lapangan }} ({{ $lapangan->jenis_lapangan ?? 'Reguler' }}) - Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}/jam</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-sm font-semibold text-text mb-2">Tanggal Main</label>
                    <input type="date" id="tanggal" name="tanggal" required min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" class="w-full border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 px-4">
                </div>
     
                <!-- Jam Mulai -->
                <div>
                    <label for="jam_mulai" class="block text-sm font-semibold text-text mb-2">Jam Mulai</label>
                    <select id="jam_mulai" name="jam_mulai" required class="w-full border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 px-4">
                        <option value="">-- Pilih Jam --</option>
                        @for($i = 8; $i <= 22; $i++)
                            @php $jamStr = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00'; @endphp
                            <option value="{{ $jamStr }}">{{ $jamStr }}</option>
                        @endfor
                    </select>
                    <p class="text-xs text-gray-500 mt-1">*Pilih dari daftar atau klik blok hijau di sebelah.</p>
                </div>

                <!-- Durasi -->
                <div>
                    <label for="durasi_jam" class="block text-sm font-semibold text-text mb-2">Durasi (Jam)</label>
                    <input type="number" id="durasi_jam" name="durasi_jam" required min="1" max="5" value="1" class="w-full border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 px-4">
                </div>

                <!-- Aturan Waktu Bayar -->
                <div class="bg-orange-50 p-3 rounded-lg border border-orange-100 text-xs text-orange-700 mt-2">
                    <span class="font-bold block mb-1">Penting:</span>
                    Setelah klik tombol di bawah, Anda akan diarahkan ke Dashboard. Anda wajib upload bukti transfer dalam waktu <strong>15 Menit</strong>.
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-green-800 text-white font-bold py-3.5 rounded-xl transition-all shadow-md mt-4 flex justify-center items-center gap-2">
                    <span class="material-symbols-outlined">event_available</span> Booking Sekarang
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
@endsection

@push('scripts')
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
@endpush