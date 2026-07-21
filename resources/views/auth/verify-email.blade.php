@extends('layouts.main')

@section('title', 'Verifikasi Email - SM Sport Center')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center">
    <div class="w-14 h-14 bg-green-50 text-secondary rounded-2xl flex items-center justify-center mx-auto mb-4">
        <span class="material-symbols-outlined text-3xl">mark_email_unread</span>
    </div>

    <h2 class="text-2xl font-bold text-primary mb-2">Verifikasi Email Anda</h2>
    
    <p class="text-text/70 text-sm mb-6 leading-relaxed">
        Terima kasih telah mendaftar! Sebelum mulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan melalui email. Jika Anda tidak menerima email tersebut, dengan senang hati kami akan mengirimkannya kembali.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-xs text-green-600 bg-green-50 p-3 rounded-xl border border-green-100">
            Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
        </div>
    @endif

    <div class="flex flex-col gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-primary hover:bg-green-800 text-white py-2.5 rounded-xl font-semibold transition-colors text-sm shadow-md">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full bg-gray-50 text-gray-600 hover:bg-gray-100 py-2.5 rounded-xl font-semibold transition-colors text-sm">
                Keluar (Logout)
            </button>
        </form>
    </div>
</div>
@endsection