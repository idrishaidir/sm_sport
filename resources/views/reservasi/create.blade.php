<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-700 leading-tight tracking-wide">
            Buat Reservasi Lapangan
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-4xl shadow-clay-card p-8 md:p-10 transition-all duration-300">
                
                @if(session('error'))
                    <div class="bg-red-50 text-red-600 p-4 mb-6 rounded-3xl shadow-clay-input text-center font-semibold">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-50 text-green-600 p-4 mb-6 rounded-3xl shadow-clay-input text-center font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('reservasi.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-slate-500 mb-2 pl-2">Pilih Lapangan</label>
                        <select name="lapangan_id" class="w-full bg-slate-50 border-transparent focus:border-transparent focus:ring-0 rounded-3xl shadow-clay-input px-5 py-4 text-slate-700 transition-all">
                            @foreach($lapangans as $lapangan)
                                <option value="{{ $lapangan->id }}">
                                    {{ $lapangan->nama_lapangan }} (Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} / jam)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-500 mb-2 pl-2">Tanggal Main</label>
                            <input type="date" name="tanggal" class="w-full bg-slate-50 border-transparent focus:border-transparent focus:ring-0 rounded-3xl shadow-clay-input px-5 py-4 text-slate-700 transition-all" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-500 mb-2 pl-2">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="w-full bg-slate-50 border-transparent focus:border-transparent focus:ring-0 rounded-3xl shadow-clay-input px-5 py-4 text-slate-700 transition-all" required>
                        </div>
                    </div>

                    <div class="mb-10">
                        <label class="block text-sm font-bold text-slate-500 mb-2 pl-2">Durasi (Jam)</label>
                        <input type="number" name="durasi_jam" value="1" min="1" class="w-full md:w-1/2 bg-slate-50 border-transparent focus:border-transparent focus:ring-0 rounded-3xl shadow-clay-input px-5 py-4 text-slate-700 transition-all" required>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="w-full md:w-auto bg-indigo-500 text-white px-8 py-4 rounded-3xl shadow-clay-btn hover:bg-indigo-400 transform hover:-translate-y-1 transition duration-200 font-bold text-lg">
                            Pesan Lapangan Sekarang
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>