@extends('layouts.main')

@section('title', 'Dashboard Admin - SM Sport Center')

@section('content')
    <input type="hidden" id="data-validasi-count" value="{{ $butuhValidasi }}">

    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-bento shadow-bento border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-primary">Panel Admin Validasi</h1>
                <p class="text-text/60 text-sm">Kelola persetujuan pembayaran manual</p>
                
                <button onclick="aktifkanSuara()" id="btnSuara" class="mt-2 bg-gray-100 text-gray-500 hover:bg-gray-200 px-3 py-1 rounded-lg text-xs font-semibold flex items-center gap-1 transition-colors">
                    <span class="material-symbols-outlined text-sm" id="iconSuara">notifications_off</span> 
                    <span id="teksSuara">Aktifkan Suara</span>
                </button>
            </div>
        </div>

        @if(session('success') || session('Succes'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 font-medium">
            {{ session('success') ?? session('Succes') }}
        </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            <div id="badge-container" class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h2 class="text-lg font-bold text-gray-800">Daftar Transaksi</h2>
                @if($butuhValidasi > 0)
                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-bold animate-pulse">
                        Ada {{ $butuhValidasi }} antrean butuh validasi!
                    </span>
                @endif
            </div>

            <table class="min-w-full text-left">
                <thead class="bg-gray-50 text-gray-500 text-sm">
                    <tr>
                        <th class="py-4 px-6 font-semibold">Pelanggan</th>
                        <th class="py-4 px-6 font-semibold">Jadwal Main</th>
                        <th class="py-4 px-6 font-semibold">Total Bayar</th>
                        <th class="py-4 px-6 font-semibold">Status & Bukti</th>
                        <th class="py-4 px-6 font-semibold">Keterangan</th>
                        <th class="py-4 px-6 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabel-reservasi" class="text-sm">
                    @forelse($reservasis as $res)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-medium">{{ $res->user->name }}</td>
                        <td class="py-4 px-6">
                            {{ \Carbon\Carbon::parse($res->tanggal)->format('d M Y') }}<br>
                            <span class="text-xs text-gray-500">{{ $res->jam_mulai }} ({{ $res->durasi_jam }} Jam) di {{ $res->lapangan->nama_lapangan }}</span>
                        </td>
                        <td class="py-4 px-6 font-bold text-green-700">Rp {{ number_format($res->total_bayar, 0, ',', '.') }}</td>
                        
                        <!-- TAMBAHAN CLASS: status-cell -->
                        <td class="py-4 px-6 status-cell">
                            @if($res->status == 'Lunas')
                                <span class="px-3 py-1 bg-green-50 text-green-600 rounded-lg text-xs font-bold">Lunas</span>
                            @elseif($res->status == 'Gagal')
                                <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-xs font-bold">Gagal</span>
                            @else
                                <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-lg text-xs font-bold mb-2 inline-block">Pending</span>
                            @endif

                            @if($res->bukti_bayar)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/bukti_bayar/' . $res->bukti_bayar) }}" target="_blank" class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded hover:bg-blue-100 flex items-center gap-1 inline-flex">
                                        <span class="material-symbols-outlined text-[14px]">image</span> Lihat Struk
                                    </a>
                                </div>
                            @elseif($res->status == 'Pending')
                                <p class="text-[10px] text-gray-400 mt-1 italic">Belum upload bukti</p>
                            @endif
                        </td>

                        <td class="py-4 px-6">
                            <form action="{{route('admin.reservasi.status', $res->id)}}" method="POST" id="form-tolak-{{$res->id}}">
                                @csrf
                                <!-- Tambahkan baris ini agar saat di-Enter statusnya ikut terkirim -->
                                <input type="hidden" name="status" value="Gagal">
                                
                                <input type="text" name="keterangan" placeholder="Alasan Gagal" class="w-48 border border-gray-200 rounded-lg px-2 py-1 text-xs focus:ring-1 focus:ring-primary">
                            </form>
                        </td>

                        <!-- TAMBAHAN CLASS: aksi-cell -->
                        <td class="py-4 px-6 aksi-cell">
                            @if($res->status == 'Pending' && $res->bukti_bayar)
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('admin.reservasi.status', $res->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Lunas">
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg title='Terima' transition-colors">
                                        <span class="material-symbols-outlined text-sm">check_circle</span>
                                    </button>
                                </form>

                                <button type="button" onclick="tolakDenganKeterangan('form-tolak-{{ $res->id }}')" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg title='Tolak' transition-colors">
                                    <span class="material-symbols-outlined text-sm">cancel</span>
                                </button>
                            </div>
                            @else
                                <div class="text-center text-gray-300">-</div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-10 text-center text-gray-400">Belum ada data reservasi masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let izinSuara = sessionStorage.getItem('izin_suara');
        
        if (izinSuara === 'true') {
            ubahTombolAktif();
        }

        function aktifkanSuara() {
            sessionStorage.setItem('izin_suara', 'true');
            ubahTombolAktif();
            let audio = new Audio('https://actions.google.com/sounds/v1/alarms/beep_short.ogg');
            audio.play().catch(e => console.log("Audio siap."));
        }

        function ubahTombolAktif() {
            let btn = document.getElementById('btnSuara');
            btn.classList.replace('bg-gray-100', 'bg-green-100');
            btn.classList.replace('text-gray-500', 'text-green-700');
            document.getElementById('iconSuara').innerText = 'notifications_active';
            document.getElementById('teksSuara').innerText = 'Suara Aktif';
        }

        function tolakDenganKeterangan(formId) {
            document.getElementById(formId).submit();
        }

        document.addEventListener('DOMContentLoaded', function() {
            setInterval(function() {
                fetch(window.location.href)
                    .then(response => response.text())
                    .then(html => {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(html, 'text/html');

                        // 1. Update Notifikasi Atas (Bukan overview-stats)
                        let badgeLama = document.getElementById('badge-container');
                        let badgeBaru = doc.getElementById('badge-container');
                        if (badgeLama && badgeBaru) {
                            badgeLama.innerHTML = badgeBaru.innerHTML;
                        }

                        // 2. Logika Update Tabel Tanpa Merusak Input
                        let tbodyLama = document.getElementById('tabel-reservasi');
                        let tabelLama = tbodyLama.querySelectorAll('tr');
                        let tabelBaru = doc.getElementById('tabel-reservasi').querySelectorAll('tr');

                        // Jika jumlah baris berubah (ada pesanan baru masuk), terpaksa update seluruh tabel
                        if (tabelLama.length !== tabelBaru.length) {
                            tbodyLama.innerHTML = doc.getElementById('tabel-reservasi').innerHTML;
                        } else {
                            // Jika jumlah baris sama, update elemen status dan aksi saja
                            tabelBaru.forEach((row, index) => {
                                if (tabelLama[index]) {
                                    // Update kolom Status & Bukti
                                    let statusLama = tabelLama[index].querySelector('.status-cell');
                                    let statusBaru = row.querySelector('.status-cell');
                                    if (statusLama && statusBaru && statusLama.innerHTML !== statusBaru.innerHTML) {
                                        statusLama.innerHTML = statusBaru.innerHTML;
                                    }

                                    // Update kolom Aksi (Tombol Terima/Tolak)
                                    let aksiLama = tabelLama[index].querySelector('.aksi-cell');
                                    let aksiBaru = row.querySelector('.aksi-cell');
                                    if (aksiLama && aksiBaru && aksiLama.innerHTML !== aksiBaru.innerHTML) {
                                        aksiLama.innerHTML = aksiBaru.innerHTML;
                                    }
                                }
                            });
                        }
                    })
                    .catch(error => console.log("Sedang memuat data..."));
            }, 5000);
        });
    </script>
@endpush