@extends('layouts.main')

@section('title', 'Dashboard Pelanggan - SM Sport Center')

@section('content')
    <div class="bento-card p-8 bg-gradient-to-r from-primary to-secondary text-white relative overflow-hidden">
        <div class="absolute -right-10 -top-10 opacity-10">
            <span class="material-symbols-outlined" style="font-size: 200px;">sports_soccer</span>
        </div>
        <div class="relative z-10">
            <h1 class="text-3xl font-bold mb-2">Selamat datang kembali, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
            <p class="text-white/80">Pantau jadwal mainmu dan kelola transaksimu secara realtime.</p>
        </div>
    </div>

    @if(session('Succes') || session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 font-medium">
        {{ session('Succes') ?? session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 font-medium">
        {{ session('error') }}
    </div>
    @endif

    <div id="overview-stats" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bento-card p-6 flex items-center gap-4">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-3xl">sports_score</span></div>
            <div><p class="text-sm font-medium text-text/60">Total Booking</p><h3 class="text-2xl font-bold text-text">{{ $total_reservasi }} <span class="text-sm font-normal text-text/50">kali</span></h3></div>
        </div>
        <div class="bento-card p-6 flex items-center gap-4">
            <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-3xl">pending_actions</span></div>
            <div><p class="text-sm font-medium text-text/60">Menunggu Pembayaran</p><h3 class="text-2xl font-bold text-text">{{ $menunggu_pembayaran }} <span class="text-sm font-normal text-text/50">transaksi</span></h3></div>
        </div>
        <div class="bento-card p-6 flex items-center gap-4">
            <div class="w-14 h-14 bg-green-50 text-secondary rounded-2xl flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-3xl">account_balance_wallet</span></div>
            <div><p class="text-sm font-medium text-text/60">Total Pengeluaran</p><h3 class="text-2xl font-bold text-text">Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</h3></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div id="riwayat-transaksi" class="lg:col-span-2 bento-card p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-primary flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">history</span>
                    Riwayat Transaksi
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-text/60 text-sm">
                            <th class="pb-3 font-semibold">Tanggal Main</th>
                            <th class="pb-3 font-semibold">Lapangan</th>
                            <th class="pb-3 font-semibold">Total</th>
                            <th class="pb-3 font-semibold">Status</th>
                            <th class="pb-3 font-semibold">Keterangan</th>
                            <th class="pb-3 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($reservasis as $res)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors {{ request('show') == $res->id ? 'bg-gray-100' : '' }}">
                            <td class="py-4 font-medium">{{ \Carbon\Carbon::parse($res->tanggal)->format('d M Y') }}</td>
                            <td class="py-4">{{ $res->lapangan->nama_lapangan ?? 'Terhapus' }}<br><span class="text-xs text-text/50">{{ $res->jam_mulai }} ({{ $res->durasi_jam }} Jam)</span></td>
                            <td class="py-4 font-medium">Rp {{ number_format($res->total_bayar, 0, ',', '.') }}</td>
                            <td class="py-4">
                                @if($res->status == 'Lunas') <span class="px-3 py-1 bg-green-50 text-green-600 border border-green-200 rounded-lg text-xs font-semibold">Lunas</span>
                                @elseif($res->status == 'Pending') <span class="px-3 py-1 bg-orange-50 text-orange-600 border border-orange-200 rounded-lg text-xs font-semibold">Pending</span>
                                @else <span class="px-3 py-1 bg-red-50 text-red-600 border border-red-200 rounded-lg text-xs font-semibold">Gagal</span> @endif
                            </td>
                            <td class="py-4 text-xs text-gray-500 max-w-[150px] truncate" title="{{ $res->keterangan }}">
                                {{$res->keterangan ?? '-'}}
                            </td>
                            <td class="py-4 text-center">
                                <a href="{{ route('dashboard', ['show' => $res->id]) }}" class="inline-block px-3 py-1 {{ request('show') == $res->id ? 'bg-primary text-white' : 'bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-200' }} rounded-lg text-xs font-semibold transition-colors">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="py-10 text-center text-text/50">Belum ada riwayat transaksi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            
            <input type="hidden" id="upcoming-hash" value="{{ $upcoming ? $upcoming->id . '-' . $upcoming->status . '-' . ($upcoming->bukti_bayar ? '1' : '0') : 'none' }}">

            <div id="upcoming-jadwal" class="bento-card p-6 bg-slate-800 text-white relative overflow-hidden">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-lg font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined text-highlight">event_upcoming</span>
                        {{ request()->has('show') ? 'Detail #'.$upcoming->id : 'Detail Transaksi' }}
                    </h2>
                    @if(request()->has('show'))
                        <a href="{{ route('dashboard') }}" class="text-white/50 hover:text-white bg-white/10 hover:bg-white/20 rounded-md p-1 transition-colors" title="Kembali ke jadwal utama">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </a>
                    @endif
                </div>

                @if($upcoming)
                    <div class="bg-white/10 rounded-xl p-5 border border-white/20 relative">
                        
                        @if($upcoming->status == 'Lunas')
                            <div class="absolute inset-0 bg-green-500/20 rounded-xl border-2 border-green-400 animate-pulse pointer-events-none"></div>
                        @endif
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="text-sm text-white/70 mb-1">{{ \Carbon\Carbon::parse($upcoming->tanggal)->format('l, d F Y') }}</div>
                        <div class="text-2xl font-bold mb-4">{{ $upcoming->jam_mulai }} <span class="text-sm font-normal text-white/70">({{ $upcoming->durasi_jam }} Jam)</span></div>
                        
                        <div class="flex items-center gap-3 mb-2 text-sm">
                            <span class="material-symbols-outlined text-base text-secondary">location_on</span>
                            {{ $upcoming->lapangan->nama_lapangan ?? 'Lapangan' }}
                        </div>
                        <div class="flex items-center gap-3 mb-4 text-sm">
                            <span class="material-symbols-outlined text-base text-secondary">info</span>
                            Status: <strong class="{{ $upcoming->status == 'Lunas' ? 'text-green-400' : ($upcoming->status == 'Gagal' ? 'text-red-400' : 'text-highlight') }}">{{ $upcoming->status }}</strong>
                        </div>

                        @if($upcoming->status == 'Pending' && is_null($upcoming->bukti_bayar))
                            @php $sisa_detik = \Carbon\Carbon::now()->diffInSeconds(\Carbon\Carbon::parse($upcoming->batas_waktu_bayar), false); @endphp

                            @if($sisa_detik > 0)
                                <div id="timer-data" data-sisa="{{ $sisa_detik }}" style="display:none;"></div>
                                
                                <div class="bg-orange-500/20 text-orange-200 p-4 rounded-lg text-sm border border-orange-500/30 mb-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-bold">Sisa Waktu:</span>
                                        <span id="timer" class="font-mono text-xl text-white bg-orange-500 px-2 py-1 rounded-md">--:--</span>
                                    </div>
                                    <p class="text-xs mb-2">Transfer <strong>Rp {{ number_format($upcoming->total_bayar, 0, ',', '.') }}</strong> ke BCA 123456789 a/n SM Sport Center.</p>
                                </div>
                                <form action="{{ route('reservasi.upload_bukti', $upcoming->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                    @csrf
                                    <div><input type="file" name="bukti_bayar" required accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-secondary file:text-white hover:file:bg-green-600 bg-white/5 rounded-xl border border-white/10"></div>
                                    <button type="submit" class="w-full bg-secondary hover:bg-green-600 text-white font-bold py-2 rounded-xl text-sm">Upload Bukti</button>
                                </form>
                            @else
                                <div class="bg-red-500/20 text-red-200 p-3 rounded-lg text-xs border border-red-500/30 text-center">Waktu habis. Silakan muat ulang halaman.</div>
                            @endif

                        @elseif($upcoming->status == 'Pending' && !is_null($upcoming->bukti_bayar))
                            <div class="bg-blue-500/20 text-blue-200 p-4 rounded-lg text-sm border border-blue-500/30 text-center">
                                <span class="material-symbols-outlined text-3xl mb-1 text-blue-400 animate-bounce">hourglass_top</span>
                                <p class="font-medium">Bukti sedang diverifikasi Admin.</p>
                                <p class="text-xs mt-1">Halaman ini akan otomatis diperbarui.</p>
                            </div>
                        @elseif($upcoming->status == 'Lunas')
                            <div class="bg-green-500/20 text-green-200 p-4 rounded-lg text-sm border border-green-500/30 text-center">
                                <span class="material-symbols-outlined text-3xl mb-1 text-green-400">check_circle</span>
                                <p class="font-medium">Pembayaran Berhasil!</p>
                                <p class="text-xs mt-1">Tunjukkan halaman ini kepada petugas lapangan.</p>
                            </div>
                        @endif
                    </div>
                        <div class="whitespace-normal break-words">
                            <p><strong>Keterangan:</strong> {{ $upcoming->keterangan }}</p>
                        </div>
                @else
                    <div class="bg-white/5 rounded-xl p-8 text-center border border-white/10">
                        <span class="material-symbols-outlined text-4xl text-white/20 mb-2">sports_tennis</span>
                        <p class="text-sm text-white/50">Tidak ada jadwal aktif/detail.</p>
                    </div>
                @endif
            </div>

            <div class="bento-card p-6 text-center">
                <a href="{{ route('reservasi.create') }}" class="block w-full bg-primary hover:bg-green-800 text-white font-bold py-3 rounded-xl transition-colors shadow-md">Buat Reservasi Baru</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let countdownInterval;

        function jalankanTimer() {
            clearInterval(countdownInterval);
            let dataEl = document.getElementById('timer-data');
            let timerEl = document.getElementById('timer');
            
            if (dataEl && timerEl) {
                let timeLeft = parseInt(dataEl.getAttribute('data-sisa'));
                
                countdownInterval = setInterval(() => {
                    if(timeLeft <= 0) {
                        clearInterval(countdownInterval);
                        timerEl.innerHTML = "HABIS";
                        timerEl.classList.replace('bg-orange-500', 'bg-red-600');
                    } else {
                        timeLeft--;
                        let m = Math.floor(timeLeft / 60);
                        let s = timeLeft % 60;
                        timerEl.innerHTML = (m < 10 ? '0' : '') + m + ":" + (s < 10 ? '0' : '') + s;
                        dataEl.setAttribute('data-sisa', timeLeft);
                    }
                }, 1000);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            jalankanTimer();

            setInterval(function() {
                fetch(window.location.href)
                    .then(response => response.text())
                    .then(html => {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(html, 'text/html');

                        document.getElementById('overview-stats').innerHTML = doc.getElementById('overview-stats').innerHTML;
                        document.getElementById('riwayat-transaksi').innerHTML = doc.getElementById('riwayat-transaksi').innerHTML;

                        let hashLama = document.getElementById('upcoming-hash').value;
                        let hashBaru = doc.getElementById('upcoming-hash').value;

                        if(hashLama !== hashBaru) {
                            document.getElementById('upcoming-hash').value = hashBaru;
                            document.getElementById('upcoming-jadwal').innerHTML = doc.getElementById('upcoming-jadwal').innerHTML;
                            jalankanTimer(); 
                        }
                    })
                    .catch(e => console.log("Menunggu koneksi..."));
            }, 5000);
        });
    </script>
@endpush