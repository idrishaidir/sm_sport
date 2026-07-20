<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Model\Reservasi;

#[Signature('app:cek-reservasi-kadaluwarsa')]
#[Description('Command description')]
class CekReservasiKadaluwarsa extends Command
{   
    protected $signature = 'reservasi:cek-kadaluwarsa';
    protected $description = 'Membatalkan reservasi yang lewat batas waktu pembayaran 15 menit';
    public function handle()
    {
        $sekarang = Carbon::now();

        $reservasi = Reservasi::where('status', 'Pending')
            ->where('bukti_bayar', null)
            ->where('batas_waktu_bayar', '<', $sekarang)
            ->get();

        foreach ($reservasi as $res){
            $res->update([
                'status' => 'Gagal', 
                'keterangan' => 'Waktu Pembayaran 15 menit habis (otomatis oleh sistem).'
            ]);
            $this->info("Reservasi ID: {$res->id} telah dibatalkan.");
        }

        $this->info('Pengecekan Selesai.');
    }
}
