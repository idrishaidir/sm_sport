<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Notifications\StatusReservasiNotification;

class AdminController extends Controller
{
    public function index()
    {
        $totalPendapatan = Reservasi::where('status', 'Lunas')->sum('total_bayar');
        $totalReservasi = Reservasi::count();
        $menungguPembayaran = Reservasi::where('status', 'Pending')->count();

        $reservasis = Reservasi::with(['user', 'lapangan'])->latest()->get();

        $tglBatas = now()->subDays(3);
        $kadaluarsa = Reservasi::whereNotNull('bukti_bayar')
            ->where('tanggal', '<', $tglBatas)
            ->get();

        foreach ($kadaluarsa as $res){
            Storage::delete('public/bukti_bayar/' . $res->bukti_bayar);
            $res->update(['bukti_bayar' => null]);
        }

        $reservasis = Reservasi::with('lapangan', 'user')->orderBy('created_at', 'desc')->get();

        $butuhValidasi = Reservasi::where('status', 'Pending')->whereNotNull('bukti_bayar')->count();
        return view('admin.dashboard', compact('totalPendapatan', 'totalReservasi', 'menungguPembayaran', 'reservasis', 'butuhValidasi'));
    }

    public function laporan(Request $request)
    {
        $query = Reservasi::with(['user', 'lapangan']);

        if($request->filled('start_date') && $request->filled('end_date')){
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $reservasis = $query->orderBy('tanggal', 'desc')->orderBy('jam_mulai', 'desc')->get();

        return view('admin.laporan', compact('reservasis'));
    }

    public function cetakLaporan(Request $request)
    {
        $query = Reservasi::with(['user', 'lapangan']);

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }


        $reservasis = $query->orderBy('tanggal', 'desc')
                        ->orderBy('jam_mulai', 'desc')
                        ->get();

        return view('admin.cetak-laporan', compact('reservasis'));
    }



    public function updateStatus(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan ?? null,
        ]);

        if ($reservasi->user) {
                $reservasi->user->notify(new StatusReservasiNotification($reservasi));
            }
        return back()->with('succes', 'Status reservasi berhasil diperbarui dan notifikasi email telah dikirim ke pelanggan.');
    }
}
