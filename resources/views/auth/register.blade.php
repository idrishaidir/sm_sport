@extends('layouts.main')

@section('title', 'Daftar Akun - SM Sport Center')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center py-10 px-4 sm:px-6 lg:px-8">
    <div class="bento-card max-w-4xl w-full grid grid-cols-1 md:grid-cols-2 overflow-hidden shadow-2xl">
        
        <div class="bg-gradient-to-br from-primary to-secondary p-10 text-white relative flex flex-col justify-center overflow-hidden">
            <div class="absolute -right-10 -bottom-10 opacity-10 pointer-events-none">
                <span class="material-symbols-outlined" style="font-size: 250px;">sports_basketball</span>
            </div>
            
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-white/10">
                    <span class="material-symbols-outlined text-4xl text-white">person_add</span>
                </div>
                <h2 class="text-3xl font-bold mb-4 leading-tight">Bergabung Bersama Kami!</h2>
                <p class="text-white/80 mb-8 text-sm leading-relaxed">
                    Buat akun sekarang untuk mulai memesan lapangan secara online, melihat jadwal secara real-time, dan mengelola transaksimu dengan mudah.
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                        <span class="material-symbols-outlined text-green-300">check_circle</span>
                        <span class="text-sm font-medium">Booking cepat tanpa antre</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                        <span class="material-symbols-outlined text-green-300">account_balance_wallet</span>
                        <span class="text-sm font-medium">Pembayaran mudah & aman</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                        <span class="material-symbols-outlined text-green-300">history</span>
                        <span class="text-sm font-medium">Pantau riwayat jadwal mainmu</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-10 bg-white flex flex-col justify-center">
            <div class="mb-8 text-center md:text-left">
                <h3 class="text-2xl font-bold text-gray-800">Daftar Akun Baru</h3>
                <p class="text-sm text-gray-500 mt-1">Lengkapi data diri Anda di bawah ini.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <ul class="list-disc list-inside text-sm text-red-600 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 text-lg">person</span>
                        </div>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap" class="w-full pl-12 border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 text-sm transition-colors">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 text-lg">mail</span>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com" class="w-full pl-12 border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 text-sm transition-colors">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 text-lg">lock</span>
                        </div>
                        <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter" class="w-full pl-12 border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 text-sm transition-colors">
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 text-lg">lock_reset</span>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ketik ulang kata sandi" class="w-full pl-12 border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 text-sm transition-colors">
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-green-800 text-white font-bold py-3.5 rounded-xl transition-all shadow-md mt-6 flex justify-center items-center gap-2 group">
                    Daftar Sekarang 
                    <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-500 border-t border-gray-100 pt-6">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-bold text-secondary hover:text-primary transition-colors">Masuk di sini</a>
            </div>
        </div>
        
    </div>
</div>
@endsection