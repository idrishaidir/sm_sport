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

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 font-medium">
            {{ session('success') }}
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
                        
                        <td class="py-4 px-6">
                            @if($res->status == 'Lunas')
                                <span class="px-3 py-1 bg-green-50 text-green-600 rounded-lg text-xs font-bold">Lunas</span>
                            @elseif($res->status == 'Batal')
                                <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-xs font-bold">Batal</span>
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
                            @if($res->status == 'Pending' && $res->bukti_bayar)
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('admin.reservasi.status', $res->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Lunas">
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg title='Terima' transition-colors">
                                        <span class="material-symbols-outlined text-sm">check_circle</span>
                                    </button>
                                </form>

                                <form action="{{ route('admin.reservasi.status', $res->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Batal">
                                    <button type="submit" onclick="return confirm('Tolak dan batalkan pesanan ini?')" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg title='Tolak' transition-colors">
                                        <span class="material-symbols-outlined text-sm">cancel</span>
                                    </button>
                                </form>
                            </div>
                            @else
                                <div class="text-center text-gray-300">-</div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-10 text-center text-gray-400">Belum ada data reservasi masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Script AJAX Polling & Suara dipindah ke dalam @push('scripts') -->
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

        document.addEventListener('DOMContentLoaded', function() {
            let lastValidasiCount = parseInt(document.getElementById('data-validasi-count').value) || 0;

            setInterval(function() {
                fetch(window.location.href)
                    .then(response => response.text())
                    .then(html => {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(html, 'text/html');

                        let newCount = parseInt(doc.getElementById('data-validasi-count').value) || 0;

                        document.getElementById('tabel-reservasi').innerHTML = doc.getElementById('tabel-reservasi').innerHTML;
                        document.getElementById('badge-container').innerHTML = doc.getElementById('badge-container').innerHTML;
                        document.getElementById('data-validasi-count').value = newCount;

                        if (newCount > lastValidasiCount) {
                            if (sessionStorage.getItem('izin_suara') === 'true') {
                                let audio = new Audio('https://actions.google.com/sounds/v1/alarms/beep_short.ogg');
                                audio.play().catch(e => console.log(e));
                            } else {
                                alert("TING TONG! Ada bukti pembayaran baru yang butuh validasi!");
                            }
                        }
                        
                        lastValidasiCount = newCount;
                    })
                    .catch(error => console.log("Sedang memuat data..."));
            }, 5000);
        });
    </script>
@endpush