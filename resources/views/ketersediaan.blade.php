@extends('layouts.main')

@section('title', 'Cek Jadwal Lapangan - SM Sport Center')

@section('content')
    <div class="max-w-7xl mx-auto">
        
        <div class="bento-card p-8 bg-slate-800 text-white relative overflow-hidden mb-6">
            <div class="absolute -right-10 -top-10 opacity-10">
                <span class="material-symbols-outlined" style="font-size: 150px;">calendar_month</span>
            </div>
            <div class="relative z-10">
                <h1 class="text-3xl font-bold mb-2 text-secondary">Cek Ketersediaan Lapangan</h1>
                <p class="text-white/80">Pantau jadwal kosong secara real-time dan booking sebelum keduluan!</p>
            </div>
        </div>

        <div class="bento-card p-6 mb-8">
            <form action="{{ route('ketersediaan') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="w-full md:w-1/2">
                    <label class="block text-sm font-medium text-text/70 mb-2">
                        <span class="material-symbols-outlined text-sm align-middle mr-1">event</span>
                        Pilih Tanggal Main
                    </label>
                    <input type="date" name="tanggal" value="{{ request('tanggal', \Carbon\Carbon::today()->format('Y-m-d')) }}" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 p-3 border text-sm font-medium">
                </div>
                <div class="w-full md:w-1/2 flex gap-3">
                    <button type="submit" class="w-full bg-primary hover:bg-green-800 text-white font-bold py-3 rounded-xl transition-colors text-sm shadow-md flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-base">search</span> Cek Jadwal
                    </button>
                    @auth
                        <a href="{{ route('reservasi.create') }}" class="w-full bg-secondary hover:bg-green-600 text-white font-bold py-3 rounded-xl transition-colors text-sm shadow-md flex items-center justify-center gap-2 text-center">
                            <span class="material-symbols-outlined text-base">add_circle</span> Booking Baru
                        </a>
                    @endauth
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($lapangans as $lapangan)
                <div class="bento-card overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">{{ $lapangan->nama_lapangan }}</h2>
                            <p class="text-sm font-semibold text-primary">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} / Jam</p>
                        </div>
                        <span class="material-symbols-outlined text-4xl text-secondary opacity-20">sports_tennis</span>
                    </div>
                    
                    <div class="p-6 flex-grow">
                        <p class="text-sm text-text/60 mb-4">Ketersediaan pada: <strong class="text-text">{{ \Carbon\Carbon::parse(request('tanggal', now()))->format('d F Y') }}</strong></p>
                        
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                            @php
                                $jamBuka = 8;
                                $jamTutup = 22;
                                
                                $jadwalTerpesan = $lapangan->reservasis->where('tanggal', request('tanggal', now()->format('Y-m-d')))
                                                    ->whereIn('status', ['Lunas', 'Pending'])
                                                    ->pluck('jam_mulai')
                                                    ->map(function($jam) {
                                                        return (int) \Carbon\Carbon::parse($jam)->format('H');
                                                    })->toArray();
                            @endphp

                            @for($i = $jamBuka; $i <= $jamTutup; $i++)
                                @php
                                    $jamFormat = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
                                    $isBooked = in_array($i, $jadwalTerpesan);
                                @endphp

                                @if($isBooked)
                                    <div class="bg-gray-100 text-gray-400 rounded-lg p-2 text-center text-xs font-bold border border-gray-200 cursor-not-allowed title='Sudah dipesan'">
                                        <span class="block line-through">{{ $jamFormat }}</span>
                                        <span class="text-[9px] font-normal text-red-500">Booked</span>
                                    </div>
                                @else
                                    <div class="bg-green-50 text-secondary border border-green-200 rounded-lg p-2 text-center text-xs font-bold hover:bg-secondary hover:text-white transition-colors cursor-pointer title='Tersedia'">
                                        <span class="block">{{ $jamFormat }}</span>
                                        <span class="text-[9px] font-normal opacity-80">Kosong</span>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bento-card p-10 text-center text-gray-500">
                    <span class="material-symbols-outlined text-5xl text-gray-300 mb-3">sentiment_dissatisfied</span>
                    <p>Data lapangan belum ditambahkan ke dalam sistem.</p>
                </div>
            @endforelse
        </div>

    </div>
@endsection