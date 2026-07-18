<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Models\Reservasi;

use Illuminate\Support\Facades\Route;

Route::get('/' , [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin'){
        return redirect()->route('admin.dashboard');
    }

    $reservasis = Reservasi::with('lapangan')
        ->where('user_id', Auth::id())
        ->orderBy('tanggal', 'desc')
        ->orderBy('jam_mulai', 'desc')
        ->get();

    $total_reservasi = $reservasis->count();
    $menunggu_pembayaran = $reservasis->where('status', 'Pending')->count();
    $total_pengeluaran = $reservasis->where('status', 'Lunas')->sum('total_bayar');

    $upcoming = $reservasis ->where('tanggal', '>=', now()->toDateString())
                            ->whereIn('status', ['Pending', 'Lunas'])
                            ->first();

    return view('dashboard', compact('reservasis', 'total_reservasi', 'menunggu_pembayaran', 'total_pengeluaran', 'upcoming'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/reservasi/buat', [ReservasiController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi/buat', [ReservasiController::class,'store'])->name('reservasi.store');
    Route::post('/reservasi/{id}/upload-bukti', [ReservasiController::class, 'uploadBukti'])->name('reservasi.upload_bukti');
    Route::post('admin/reservasi/{id}/status',[AdminController::class, 'updateStatus'])->name('admin.reservasi.status');
    
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function (){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/reservasi/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.reservasi.status');
    Route::get('/laporan', [App\Http\Controllers\AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/laporan/cetak', [App\Http\Controllers\AdminController::class, 'cetakLaporan'])->name('admin.laporan.cetak');
});

Route::get('/ketersediaan', [App\Http\Controllers\HomeController::class, 'ketersediaan'])->name('ketersediaan');
Route::get('/api/jadwal', [App\Http\Controllers\HomeController::class, 'getJadwal']);
require __DIR__.'/auth.php';
