<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalPendapatan = Reservasi::where('status', 'Lunas')->sum('total_bayar');
        $totalReservasi = Reservasi::count();
        $menungguPembayaran = Reservasi::where('status', 'Pending')->count();

        $reservasis = Reservasi::with(['user', 'lapangan'])->latest()->get();

        return view('admin.dashboard', compact('totalPendapatan', 'totalReservasi', 'menungguPembayaran', 'reservasis'));
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

        if ($request->filled('start_date') && $request->filled('end_date')){
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $reservasis = $query->orderBy('tanggal', 'desc')->orderBy('jam_mulai', 'desc')->get();
        return view('admin.cetak-laporan', compact('reservasis'));
    }

    public function updateStatus(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update([
            'status' => $request->status,
        ]);

        return back()->with('Succes', 'Status reservasi Berhasil diperbarui');
    }
}
