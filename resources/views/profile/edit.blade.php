@extends('layouts.main')

@section('title', 'Profil Saya - SM Sport Center')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
        <span class="material-symbols-outlined text-secondary">account_circle</span>
        Pengaturan Profil
    </h1>

    {{-- Notifikasi Sukses Update Profil --}}
    @if (session('status') === 'profile-updated')
        <div class="bg-green-500/20 border border-green-500/40 px-4 py-3 rounded-xl mb-6 text-sm font-medium animate-pulse">
            Informasi profil berhasil diperbarui.
        </div>
    @endif

    {{-- Notifikasi Sukses Update Password --}}
    @if (session('status') === 'password-updated')
        <div class="bg-green-500/20 border border-green-500/40 px-4 py-3 rounded-xl mb-6 text-sm font-medium animate-pulse">
            Kata sandi berhasil diperbarui.
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="md:col-span-1 bg-slate-800 text-white p-6 rounded-2xl border border-white/10 flex flex-col items-center text-center h-fit shadow-xl">
            <div class="w-20 h-20 bg-secondary rounded-full flex items-center justify-center text-white mb-4 shadow-lg">
                <span class="material-symbols-outlined text-4xl">person</span>
            </div>
            <h2 class="text-lg font-bold truncate max-w-full">{{ Auth::user()->name }}</h2>
            <p class="text-xs text-white/50 mb-4 truncate max-w-full">{{ Auth::user()->email }}</p>
            <span class="px-3 py-1 bg-white/10 rounded-full text-[10px] font-bold uppercase tracking-wider text-secondary">
                {{ Auth::user()->role ?? 'Pelanggan' }}
            </span>
        </div>

        <div class="md:col-span-2 space-y-6">
            
            <div class="bg-slate-800 text-white p-6 rounded-2xl border border-white/10 shadow-xl">
                <h3 class="text-md font-bold mb-4 text-white flex items-center gap-2 border-b border-white/10 pb-2">
                    <span class="material-symbols-outlined text-sm text-secondary">badge</span>
                    Informasi Pribadi
                </h3>
                
                <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    @method('patch')

                    <div>
                        <label class="block text-xs text-white/70 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full p-2.5 bg-white/5 border border-white/10 rounded-xl text-sm focus:ring-1 focus:ring-secondary focus:border-secondary transition-all" required>
                        @error('name') 
                            <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-white/70 mb-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full p-2.5 bg-white/5 border border-white/10 rounded-xl text-sm focus:ring-1 focus:ring-secondary focus:border-secondary transition-all" required>
                        @error('email') 
                            <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="bg-secondary hover:bg-green-600 text-white px-4 py-2 rounded-xl text-xs font-bold transition-colors shadow-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-slate-800 text-white p-6 rounded-2xl border border-white/10 shadow-xl">
                <h3 class="text-md font-bold mb-4 text-white flex items-center gap-2 border-b border-white/10 pb-2">
                    <span class="material-symbols-outlined text-sm text-secondary">lock</span>
                    Perbarui Kata Sandi
                </h3>
                
                <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf
                    @method('put')

                    <div>
                        <label class="block text-xs text-white/70 mb-1">Kata Sandi Saat Ini</label>
                        <input type="password" name="current_password" class="w-full p-2.5 bg-white/5 border border-white/10 rounded-xl text-sm focus:ring-1 focus:ring-secondary focus:border-secondary transition-all" required>
                        @error('current_password', 'updatePassword') 
                            <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-white/70 mb-1">Kata Sandi Baru</label>
                        <input type="password" name="password" class="w-full p-2.5 bg-white/5 border border-white/10 rounded-xl text-sm focus:ring-1 focus:ring-secondary focus:border-secondary transition-all" required>
                        @error('password', 'updatePassword') 
                            <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-white/70 mb-1">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="password_confirmation" class="w-full p-2.5 bg-white/5 border border-white/10 rounded-xl text-sm focus:ring-1 focus:ring-secondary focus:border-secondary transition-all" required>
                        @error('password_confirmation', 'updatePassword') 
                            <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="bg-secondary hover:bg-green-600 text-white px-4 py-2 rounded-xl text-xs font-bold transition-colors shadow-md">
                            Perbarui Sandi
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-slate-800 text-white p-6 rounded-2xl border border-red-500/30 shadow-xl">
                <h3 class="text-md font-bold mb-2 text-red-400 flex items-center gap-2 border-b border-red-500/20 pb-2">
                    <span class="material-symbols-outlined text-sm">warning</span>
                    Hapus Akun Permanen
                </h3>
                <p class="text-xs text-white/60 mb-4 leading-relaxed">
                    Setelah akun Anda dihapus, semua data profil dan riwayat pemesanan Anda di SM Sport Center akan dihapus secara permanen. Harap masukkan kata sandi Anda untuk mengonfirmasi tindakan ini.
                </p>
                
                <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                    @csrf
                    @method('delete')

                    <div>
                        <label class="block text-xs text-white/70 mb-1">Kata Sandi Akun</label>
                        <input type="password" name="password" placeholder="Masukkan sandi untuk konfirmasi hapus" class="w-full p-2.5 bg-white/5 border border-red-500/30 rounded-xl text-sm focus:ring-1 focus:ring-red-500 focus:border-red-500 transition-all" required>
                        @error('password', 'userDeletion') 
                            <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" onclick="return confirm('Apakah Anda sangat yakin ingin menghapus akun ini permanen? Seluruh riwayat transaksi Anda akan hilang.')" class="bg-red-500/10 hover:bg-red-600 text-red-400 hover:text-white border border-red-500/50 px-4 py-2 rounded-xl text-xs font-bold transition-colors shadow-sm">
                            Hapus Akun Saya
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection