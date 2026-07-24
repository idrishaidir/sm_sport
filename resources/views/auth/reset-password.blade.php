@extends('layouts.main')

@section('title', 'Atur Ulang Password - SM Sport Center')

@section('content')
<div class="flex justify-center items-center min-h-[65vh] py-12">
    <div class="w-full max-w-md bento-card p-8 shadow-md self-center">
        
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-green-50 text-primary border border-secondary/30 rounded-full flex justify-center items-center mx-auto mb-4 shadow-sm">
                <span class="material-symbols-outlined text-3xl text-secondary">lock_open</span>
            </div>
            <h2 class="text-2xl font-bold text-primary">Atur Ulang Kata Sandi</h2>
            <p class="text-sm text-gray-500 mt-1">
                Silakan masukkan kata sandi baru Anda di bawah ini.
            </p>
        </div>

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-5 shadow-sm text-sm">
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label for="email" class="block text-sm font-semibold text-text mb-2">Alamat Email</label>
                <div class="relative">
                    <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required readonly
                        class="w-full border-gray-200 bg-gray-100 rounded-xl py-3 px-4 pl-11 text-gray-500 cursor-not-allowed">
                    <span class="material-symbols-outlined absolute left-3.5 top-3.5 text-gray-400 text-xl">mail</span>
                </div>
            </div>

            <div x-data="{ show: false }">
                <label for="password" class="block text-sm font-semibold text-text mb-2">Kata Sandi Baru</label>
                <div class="relative">
                    <input x-bind:type="show ? 'text' : 'password'" id="password" name="password" required autocomplete="new-password"
                        placeholder="Minimal 8 karakter"
                        class="w-full border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 px-4 pl-11 pr-12">
                    <span class="material-symbols-outlined absolute left-3.5 top-3.5 text-gray-400 text-xl">lock</span>
                    
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                        <span class="material-symbols-outlined text-lg" x-show="!show">visibility</span>
                        <span class="material-symbols-outlined text-lg" x-show="show" style="display: none;">visibility_off</span>
                    </button>
                </div>
            </div>

            <div x-data="{ show: false }">
                <label for="password_confirmation" class="block text-sm font-semibold text-text mb-2">Konfirmasi Kata Sandi Baru</label>
                <div class="relative">
                    <input x-bind:type="show ? 'text' : 'password'" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                        placeholder="Ulangi kata sandi baru"
                        class="w-full border-gray-200 bg-gray-50 rounded-xl focus:border-secondary focus:ring-secondary py-3 px-4 pl-11 pr-12">
                    <span class="material-symbols-outlined absolute left-3.5 top-3.5 text-gray-400 text-xl">lock</span>

                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                        <span class="material-symbols-outlined text-lg" x-show="!show">visibility</span>
                        <span class="material-symbols-outlined text-lg" x-show="show" style="display: none;">visibility_off</span>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-green-800 text-white font-bold py-3.5 rounded-xl transition-all shadow-md flex justify-center items-center gap-2 cursor-pointer">
                <span class="material-symbols-outlined text-xl">published_with_changes</span> Perbarui Kata Sandi
            </button>
        </form>
    </div>
</div>
@endsection