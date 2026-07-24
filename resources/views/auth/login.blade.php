@extends('layouts.main')

@section('title', 'Masuk Akun - SM Sport Center')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center py-10 px-4 sm:px-6 lg:px-8">
    <div class="bento-card max-w-4xl w-full grid grid-cols-1 md:grid-cols-2 overflow-hidden shadow-2xl">
        
        <div class="bg-gradient-to-br from-primary to-secondary p-10 text-white relative flex flex-col justify-center overflow-hidden">
            <div class="absolute -right-10 -bottom-10 opacity-10 pointer-events-none">
                <span class="material-symbols-outlined" style="font-size: 250px;">sports_soccer</span>
            </div>
            
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-white/10">
                    <span class="material-symbols-outlined text-4xl text-white">login</span>
                </div>
                <h2 class="text-3xl font-bold mb-4 leading-tight">Selamat Datang Kembali!</h2>
                <p class="text-white/80 mb-8 text-sm leading-relaxed">
                    Masuk ke akun Anda untuk melanjutkan pemesanan lapangan futsal atau badminton, cek status pembayaran, dan kelola jadwal main Anda.
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                        <span class="material-symbols-outlined text-green-300">schedule</span>
                        <span class="text-sm font-medium">Pantau ketersediaan slot secara realtime</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                        <span class="material-symbols-outlined text-green-300">notifications_active</span>
                        <span class="text-sm font-medium">Dapatkan notifikasi status via email</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-10 bg-white flex flex-col justify-center">
            <div class="mb-8 text-center md:text-left">
                <h3 class="text-2xl font-bold text-gray-800">Masuk Akun</h3>
                <p class="text-sm text-gray-500 mt-1">Silakan masukkan email dan kata sandi Anda.</p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 text-sm text-blue-600 rounded-xl font-medium">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <ul class="list-disc list-inside text-sm text-red-600 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 text-lg">mail</span>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="email@contoh.com" class="w-full pl-12 border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 text-sm transition-colors">
                    </div>
                </div>

                <div x-data="{ show: false }">
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-secondary hover:text-primary transition-colors">Lupa sandi?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 text-lg">lock</span>
                        </div>
                        <input x-bind:type="show ? 'text' : 'password'" id="password" name="password" required placeholder="Masukkan kata sandi Anda" class="w-full pl-12 pr-12 border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 text-sm transition-colors">
                        
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                            <span class="material-symbols-outlined text-lg" x-show="!show">visibility</span>
                            <span class="material-symbols-outlined text-lg" x-show="show" style="display: none;">visibility_off</span>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-secondary focus:ring-secondary">
                        <span class="ms-2 text-sm text-gray-600 font-medium selection:bg-transparent">Ingat Saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-green-800 text-white font-bold py-3.5 rounded-xl transition-all shadow-md mt-6 flex justify-center items-center gap-2 group">
                    Masuk Sekarang 
                    <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-500 border-t border-gray-100 pt-6">
                Belum memiliki akun? 
                <a href="{{ route('register') }}" class="font-bold text-secondary hover:text-primary transition-colors">Daftar di sini</a>
            </div>
        </div>
        
    </div>
</div>
@endsection