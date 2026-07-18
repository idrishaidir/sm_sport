@extends('layouts.main')

@section('title', 'Laporan Transaksi - SM Sport Center')

@section('content')
    <div class="max-w-7xl mx-auto">
        
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-bento shadow-bento border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-primary">Laporan Transaksi</h1>
                <p class="text-text/60 text-sm">Filter dan cetak laporan pendapatan SM Sport Center</p>
            </div>
        </div>

        <div class="bento-card p-6 mb-6 bg-white">
            <form action="{{ route('admin.laporan') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="w-full md:w-1/3">
                    <label class="block text-sm font-medium text-text/70 mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 p-2.5 border text-sm">
                </div>
                <div class="w-full md:w-1/3">
                    <label class="block text-sm font-medium text-text/70 mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 p-2.5 border text-sm">
                </div>
                <div class="w-full md:w-1/3 flex gap-2">
                    <button type="submit" class="w-full bg-primary hover:bg-green-800 text-white font-semibold py-2.5 rounded-xl transition-colors text-sm">
                        Filter Data
                    </button>
                    <button type="submit" formaction="{{ url('/admin/cetak-laporan') }}" formtarget="_blank" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2.5 rounded-xl transition-colors flex justify-center items-center gap-1 text-sm shadow-md">
                        <span class="material-symbols-outlined text-sm">print</span> Cetak PDF
                    </button>
                </div>
            </form>
        </div>

        <div class="bento-card overflow-hidden bg-white">
            <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center bg-gray-50/50 gap-4">
                <h2 class="text-lg font-bold text-gray-800">Hasil Data Transaksi</h2>
                
                @php
                    $totalLunas = $reservasis->where('status', 'Lunas')->sum('total_bayar');
                @endphp
                <span class="bg-green-100 border border-green-200 text-green-800 px-4 py-2 rounded-xl text-sm font-bold shadow-sm">
                    Total Pendapatan: Rp {{ number_format($totalLunas, 0, ',', '.') }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-sm">
                        <tr>
                            <th class="py-4 px-6 font-semibold">No</th>
                            <th class="py-4 px-6 font-semibold">Nama Pelanggan</th>
                            <th class="py-4 px-6 font-semibold">Tanggal & Lapangan</th>
                            <th class="py-4 px-6 font-semibold">Status</th>
                            <th class="py-4 px-6 font-semibold text-right">Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($reservasis as $index => $res)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 text-gray-500">{{ $index + 1 }}</td>
                            <td class="py-4 px-6 font-medium">{{ $res->user->name }}</td>
                            <td class="py-4 px-6">
                                {{ \Carbon\Carbon::parse($res->tanggal)->format('d M Y') }}<br>
                                <span class="text-xs text-gray-500">{{ $res->jam_mulai }} ({{ $res->durasi_jam }} Jam) di {{ $res->lapangan->nama_lapangan }}</span>
                            </td>
                            <td class="py-4 px-6">
                                @if($res->status == 'Lunas')
                                    <span class="px-3 py-1 bg-green-50 text-green-600 rounded-lg text-xs font-bold border border-green-100">Lunas</span>
                                @elseif($res->status == 'Batal')
                                    <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-xs font-bold border border-red-100">Batal</span>
                                @else
                                    <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-lg text-xs font-bold border border-orange-100">Pending</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right font-bold text-gray-700">Rp {{ number_format($res->total_bayar, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-gray-400">Tidak ada data transaksi yang ditemukan pada periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
@endsection