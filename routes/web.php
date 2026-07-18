<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

Route::get('/' , [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/reservasi/buat', [ReservasiController::class, 'create'])->name('reservasi.create');
    
    Route::post('/reservasi/buat', [ReservasiController::class,'store'])->name('reservasi.store');
    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
