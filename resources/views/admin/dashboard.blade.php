@extends('layouts.main')

@section('title', 'Dashboard Admin - SM Sport Center')

@section('content')
    <input type="hidden" id="data-validasi-count" value="{{ $butuhValidasi }}">

    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-bento shadow-bento border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-primary">Panel Admin Validasi</h1>
                <p class="text-text/60 text-sm">Kelola persetujuan pembayaran manual dan pembatalan pesanan</p>
                
                <button onclick="aktifkanSuara()" id="btnSuara" class="mt-2 bg-gray-100 text-gray-500 hover:bg-gray-200 px-3 py-1 rounded-lg text-xs font-semibold flex items-center gap-1 transition-colors">
                    <span class="material-symbols-outlined text-sm" id="iconSuara">notifications_off</span> 
                    <span id="teksSuara">Aktifkan Suara</span>
                </button>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 font-medium">
            {{ session('success')}}
        </div>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                <span class="font-medium">Gagal!</span> {{ session('error') }}
            </div>
        @endif

        <form action="{{route('admin.reservasi.cepat')}}" method="POST" class="p-10 mb-6 shadow-sm bg-white rounded-xl">
            @csrf
            <h1 class="font-bold pb-2 text-xl">Input Pelanggan (Manual)</h1>
            <input type="text" name="nama_pelanggan" placeholder="Nama Pelanggan (Tamu)" class="w-full mb-3 p-2.5 border border-gray-200 rounded-xl focus:ring-primary focus:border-primary text-sm" required>

            <select name="lapangan_id" class="w-full mb-3 p-2.5 border border-gray-200 rounded-xl text-sm">
                @foreach(\App\Models\Lapangan::all() as $lap)
                    <option value="{{ $lap->id}}">{{$lap->nama_lapangan}}</option>
                @endforeach
            </select>

            <div class="flex gap-3 mb-3">
                <input type="date" name="tanggal" class="w-1/2 p-2.5 border border-gray-200 rounded-xl text-sm" required>
                <input type="time" name="jam_mulai" class="w-1/4 p-2.5 border border-gray-200 rounded-xl text-sm" required>
                <input type="number" name="durasi_jam" placeholder="Jam" class="w-14 p.25 border border-gray-200 rounded-xl text-sm" min="1" required>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="submit" class="bg-primary hover:bg-green-700 text-white px-4 py-2.5 rounded-xl text-sm font-bold transition-colors">Simpan & Lunas</button>
            </div>
        </form>
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div id="badge-container" class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h2 class="text-lg font-bold text-gray-800">Daftar Transaksi</h2>
                @if($butuhValidasi > 0)
                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-bold animate-pulse">
                        Ada {{ $butuhValidasi }} antrean butuh validasi!
                    </span>
                @endif
                <div class="relative w-full sm:w-64">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">
                        search
                    </span>
                    <input type="text" id="inputCari" onkeyup="cariPelanggan()" placeholder="Cari Nama Pelanggan..." class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl text-xs focus:ring-1 focus:ring-primary focus:border-primary placeholder-gray-400">
                </div>
            </div>

            <div class="overflow-x-auto">
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
                            <td class="py-4 px-6 font-medium">{{ $res->user->name ?? 'Tamu' }}</td>
                            <td class="py-4 px-6">
                                {{ \Carbon\Carbon::parse($res->tanggal)->format('d M Y') }}<br>
                                <span class="text-xs text-gray-500">{{ $res->jam_mulai }} ({{ $res->durasi_jam }} Jam) di {{ $res->lapangan->nama_lapangan ?? '-' }}</span>
                            </td>
                            <td class="py-4 px-6 font-bold text-green-700">Rp {{ number_format($res->total_bayar, 0, ',', '.') }}</td>
                            
                            <td class="py-4 px-6 status-cell">
                                @if($res->status == 'Lunas')
                                    <span class="px-3 py-1 bg-green-50 text-green-600 rounded-lg text-xs font-bold">Lunas</span>
                                @elseif($res->status == 'Gagal')
                                    <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-xs font-bold">Gagal</span>
                                @elseif($res->status == 'Batal')
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold border border-gray-200">Batal</span>
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
                                @if($res->keterangan)
                                    <div class="mb-2 text-xs font-medium text-gray-700 bg-gray-100 p-2 rounded-lg whitespace-normal break-words max-w-[200px]">
                                        {{$res->keterangan}}
                                    </div>
                                @endif

                                @if($res->status == "Pending")    
                                    <form action="{{route('admin.reservasi.status', $res->id)}}" method="POST" id="form-alasan-{{$res->id}}">
                                        @csrf
                                        <input type="hidden" name="status" value="Gagal">
                                        <input type="text" name="keterangan" placeholder="Alasan Gagal (Wajib)" class="w-48 border border-gray-200 rounded-lg px-2 py-1 text-xs focus:ring-1 focus:ring-primary" required>
                                    </form>
                                @endif

                                @if($res->status == "Lunas")    
                                    <form action="{{route('admin.reservasi.status', $res->id)}}" method="POST" id="form-alasan-{{$res->id}}">
                                        @csrf
                                        <input type="hidden" name="status" value="Batal">
                                        <input type="text" name="keterangan" placeholder="Alasan Pembatalan..." class="w-48 border border-gray-200 rounded-lg px-2 py-1 text-xs focus:ring-1 focus:ring-primary" required>
                                    </form>
                                @endif
                            </td>

                            <td class="py-4 px-6 aksi-cell">
                                @if($res->status == 'Pending')
                                <div class="flex items-center justify-center gap-2">
                                    @if($res->bukti_bayar)
                                        <form action="{{ route('admin.reservasi.status', $res->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="Lunas">
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg transition-colors" title="Terima Pembayaran">
                                                <span class="material-symbols-outlined text-sm">check_circle</span>
                                            </button>
                                        </form>
                                    @endif
                                    <button type="button" onclick="kirimDenganKeterangan('form-alasan-{{ $res->id }}')" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-colors" title="Batalkan Pesanan">
                                        <span class="material-symbols-outlined text-sm">cancel</span>
                                    </button>
                                </div>
                                @elseif($res->status == 'Lunas')
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" onclick="kirimDenganKeterangan('form-alasan-{{ $res->id }}')" class="bg-gray-500 hover:bg-gray-700 text-white p-2 rounded-lg transition-colors" title="Batalkan Pesanan (Refund/Maintenance)">
                                        <span class="material-symbols-outlined text-sm">event_busy</span>
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
            
            <div class="p-6 border-t border-gray-100 bg-gray-50/30 flex justify-between items-center">
                <div class="text-xs text-gray-500 hidden sm:block">
                    Menampilkan data transaksi per halaman (Maks. 10 data)
                </div>
                <div>
                    {{ $reservasis->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Fitur Notifikasi Suara
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

        // Fitur Tombol Gagal / Batal dengan Keterangan
        function kirimDenganKeterangan(formId) {
            let form = document.getElementById(formId);
            let inputKeterangan = form.querySelector('input[name="keterangan"]');
            
            if (!inputKeterangan.value.trim()) {
                alert('MOHON ISI ALASAN TERLEBIH DAHULU!\nKetik alasan di kolom Keterangan (Contoh: Maintenance lapangan, Permintaan User, dll).');
                inputKeterangan.focus();
                return;
            }

            let statusYangDikirim = form.querySelector('input[name="status"]').value;
            let pesanKonfirmasi = 'Apakah Anda yakin ingin menggagalkan pesanan ini?';
            
            if(statusYangDikirim === 'Batal') {
                pesanKonfirmasi = 'PERHATIAN: Pesanan ini sudah LUNAS.\nApakah Anda yakin ingin membatalkannya? Pastikan urusan uang (refund) diselesaikan dengan pelanggan.';
            }

            if (confirm(pesanKonfirmasi)) {
                form.submit();
            }
        }

        // Fitur Pencarian Data
        function cariPelanggan() {
            let input = document.getElementById('inputCari');
            let filter = input.value.toLowerCase();
            let tbody = document.getElementById('tabel-reservasi');
            let tr = tbody.getElementsByTagName('tr');

            for (let i = 0; i < tr.length; i++) {
                let teksBaris = tr[i].textContent || tr[i].innerText;
                if (teksBaris.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
        
        // Fitur Auto Refresh Ringan (Sudah Diperbaiki)
        document.addEventListener('DOMContentLoaded', function() {
            function hitungBukti() {
                return document.querySelectorAll('.status-cell a[href*="bukti_bayar"]').length;
            }

            let jumlahBuktiTerakhir = hitungBukti();

            setInterval(function() {
                fetch(window.location.href)
                    .then(response => response.text())
                    .then(html => {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(html, 'text/html');
                        
                        let jumlahBuktiBaru = doc.querySelectorAll('.status-cell a[href*="bukti_bayar"]').length;

                        // Bunyikan suara jika ada bukti bayar baru
                        if (jumlahBuktiBaru > jumlahBuktiTerakhir) {
                            if (sessionStorage.getItem('izin_suara') === 'true') {
                                let audio = new Audio('https://actions.google.com/sounds/v1/alarms/beep_short.ogg');
                                audio.play().catch(e => console.error("Audio gagal diputar:", e));
                            }
                            jumlahBuktiTerakhir = jumlahBuktiBaru;
                        }

                        // CEK APAKAH ADMIN SEDANG NGETIK
                        let elemenAktif = document.activeElement;
                        let sedangMengetik = elemenAktif && elemenAktif.tagName === 'INPUT' && elemenAktif.name === 'keterangan';

                        // TUNDA REFRESH JIKA SEDANG NGETIK
                        if (!sedangMengetik) {
                            let tbodyLama = document.getElementById('tabel-reservasi');
                            tbodyLama.innerHTML = doc.getElementById('tabel-reservasi').innerHTML;

                            // Terapkan ulang filter pencarian setelah data direfresh
                            cariPelanggan();
                        }
                    })
                    .catch(error => console.log("Sedang memuat data..."));
            }, 5000);
        });
    </script>
@endpush