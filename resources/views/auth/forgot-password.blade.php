@extends('layouts.main')

@section('title', 'Lupa Password - SM Sport Center')

@section('content')
<div class="flex justify-center items-center min-h-[60vh] py-12">
    <div class="w-full max-w-md bento-card p-8 shadow-md self-center">
        
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-green-50 text-primary border border-secondary/30 rounded-full flex justify-center items-center mx-auto mb-4 shadow-sm">
                <span class="material-symbols-outlined text-3xl text-secondary">lock_reset</span>
            </div>
            <h2 class="text-2xl font-bold text-primary">Lupa Kata Sandi?</h2>
            <p class="text-sm text-gray-500 mt-2 px-2">
                Masukkan alamat email Anda yang terdaftar. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
            </p>
        </div>

        @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3 mb-5 shadow-sm text-sm">
            <span class="material-symbols-outlined text-xl">check_circle</span>
            <span class="font-medium">{{ session('status') }}</span>
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-5 shadow-sm text-sm">
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-text mb-2">Alamat Email</label>
                <div class="relative">
                    <input type="email" id="email" name="email" :value="old('email')" required autofocus 
                        placeholder="contoh@gmail.com"
                        class="w-full border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 px-4 pl-11">
                    <span class="material-symbols-outlined absolute left-3.5 top-3.5 text-gray-400 text-xl">mail</span>
                </div>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-green-800 text-white font-bold py-3.5 rounded-xl transition-all shadow-md flex justify-center items-center gap-2 cursor-pointer">
                <span class="material-symbols-outlined text-xl">send</span> Kirim Tautan Reset
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-sm font-medium text-primary hover:text-green-800 transition-colors inline-flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection