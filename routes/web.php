<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


Route::get('/' , [HomeController::class, 'index'])->name('home');


Route::get('/ketersediaan', [App\Http\Controllers\HomeController::class, 'ketersediaan'])->name('ketersediaan');

Route::get('/api/jadwal', [App\Http\Controllers\HomeController::class, 'getJadwal']);



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/reservasi/buat', [ReservasiController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi/buat', [ReservasiController::class,'store'])->name('reservasi.store');
    Route::post('/reservasi/{id}/upload-bukti', [ReservasiController::class, 'uploadBukti'])->name('reservasi.upload_bukti');
    Route::get('/gambar-bukti/{filename}', [ReservasiController::class, 'lihatBukti'])->name('lihat.bukti');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function (){
    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/reservasi/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.reservasi.status');
    Route::get('/laporan', [App\Http\Controllers\AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/laporan/cetak', [App\Http\Controllers\AdminController::class, 'cetakLaporan'])->name('admin.laporan.cetak');
    Route::post('/reservasi-cepat', [AdminController::class, 'storeReservasiCepat'])->name('admin.reservasi.cepat');

});


require __DIR__.'/auth.php';