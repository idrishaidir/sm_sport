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

    public function updateStatus(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update([
            'status' => $request->status,
        ]);

        return back()->with('Succes', 'Status reservasi Berhasil diperbarui');
    }
}
