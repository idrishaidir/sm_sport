<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-700 leading-tight tracking-wide">
            Dashboard Manajemen
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-50 text-green-600 p-4 mb-8 rounded-3xl shadow-clay-input text-center font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                <div class="bg-white rounded-4xl shadow-clay-card p-8 transform transition duration-300 hover:scale-105">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest pl-2">Total Pendapatan (Lunas)</h3>
                    <p class="text-4xl font-extrabold text-indigo-500 mt-4 pl-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                
                <div class="bg-white rounded-4xl shadow-clay-card p-8 transform transition duration-300 hover:scale-105">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest pl-2">Total Reservasi</h3>
                    <p class="text-4xl font-extrabold text-slate-700 mt-4 pl-2">{{ $totalReservasi }} <span class="text-xl">Transaksi</span></p>
                </div>

                <div class="bg-white rounded-4xl shadow-clay-card p-8 transform transition duration-300 hover:scale-105">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest pl-2">Menunggu Pembayaran</h3>
                    <p class="text-4xl font-extrabold text-rose-400 mt-4 pl-2">{{ $menungguPembayaran }} <span class="text-xl">Transaksi</span></p>
                </div>
            </div>

            <div class="bg-white rounded-4xl shadow-clay-card p-6 md:p-8">
                <h3 class="text-xl font-bold text-slate-700 mb-6 pl-2">Daftar Reservasi Terbaru</h3>
                
                <div class="overflow-x-auto rounded-3xl shadow-clay-input bg-slate-50 p-2">
                    <table class="w-full text-left whitespace-nowrap">
                        <thead class="text-slate-400 text-sm">
                            <tr>
                                <th class="px-6 py-4 font-bold">Pelanggan</th>
                                <th class="px-6 py-4 font-bold">Lapangan</th>
                                <th class="px-6 py-4 font-bold">Jadwal Main</th>
                                <th class="px-6 py-4 font-bold">Total Bayar</th>
                                <th class="px-6 py-4 font-bold">Status</th>
                                <th class="px-6 py-4 font-bold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-600 text-sm">
                            @forelse($reservasis as $reservasi)
                                <tr class="hover:bg-white transition-colors duration-200 border-b border-slate-100 last:border-0 rounded-2xl">
                                    <td class="px-6 py-4 font-bold text-slate-700">{{ $reservasi->user->name }}</td>
                                    <td class="px-6 py-4 font-medium">{{ $reservasi->lapangan->nama_lapangan }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-700">{{ \Carbon\Carbon::parse($reservasi->tanggal)->format('d M Y') }}</div>
                                        <div class="text-slate-400">Jam: {{ $reservasi->jam_mulai }} ({{ $reservasi->durasi_jam }} Jam)</div>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-indigo-500">Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        @if($reservasi->status == 'Pending')
                                            <span class="bg-rose-100 text-rose-600 py-1.5 px-4 rounded-full font-bold shadow-sm">Pending</span>
                                        @elseif($reservasi->status == 'Lunas')
                                            <span class="bg-teal-100 text-teal-600 py-1.5 px-4 rounded-full font-bold shadow-sm">Lunas</span>
                                        @else
                                            <span class="bg-slate-200 text-slate-600 py-1.5 px-4 rounded-full font-bold shadow-sm">Batal</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('admin.reservasi.status', $reservasi->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <select name="status" onchange="this.form.submit()" class="text-sm rounded-2xl border-transparent bg-white shadow-clay-btn text-slate-600 font-bold focus:ring-0 py-2 pl-4 pr-8 cursor-pointer">
                                                <option value="Pending" {{ $reservasi->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Lunas" {{ $reservasi->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                                <option value="Batal" {{ $reservasi->status == 'Batal' ? 'selected' : '' }}>Batal</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-slate-400 font-bold">Belum ada data reservasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>