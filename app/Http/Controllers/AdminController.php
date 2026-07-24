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

        $reservasis = Reservasi::with('lapangan', 'user')->orderBy('created_at', 'desc')->paginate(10);
        
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

    public function storeReservasiCepat(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'lapangan_id' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'durasi_jam' => 'required|integer'
        ]);

        $lapangan = \App\Models\Lapangan::find($request->lapangan_id);

        if(!$lapangan){
            return back()->with('error', 'Gagal: Lapangan tidak ditemukan. ');
        }

        $new_start = strtotime($request->jam_mulai);
        $new_end = strtotime("+". $request->durasi_jam . " hours", $new_start);

        $bentrok = \App\Models\Reservasi::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal', $request->tanggal)
            ->where(function($query){
                $query -> where('status', 'Lunas')
                        -> orWhere(function($subQuery){
                            $subQuery ->where('status', 'Pending')
                                    -> where('batas_waktu_bayar', '>', now());
                        });
            })
            ->get()
            ->contains(function ($jadwal) use ($new_start, $new_end) {
                $exist_start = strtotime($jadwal->jam_mulai);
                $exist_end = strtotime("+" . $jadwal->durasi_jam . " hours", $exist_start);
                return $new_start < $exist_end && $new_end > $exist_start;
            });

        if ($bentrok) {
            return back()->with('error', 'Gagal: Jadwal tersebut sudah dipesan (berbenturan).');
        }

        $totalBayar = (int)$lapangan->harga_per_jam * (int)$request->durasi_jam;

        $akunTamu =\App\Models\User::where('email', 'tamusmsport@gmail.com')->first();

        $idPengguna = $akunTamu ? $akunTamu->id:\Illuminate\Support\Facades\Auth::id();
        
        \App\Models\Reservasi::create([
            'user_id' => $idPengguna,
            'lapangan_id' => $request->lapangan_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'durasi_jam' => $request->durasi_jam,
            'total_bayar' => $totalBayar,
            'status' => 'Lunas',
            'keterangan' => 'Pesan Ditempat. dipesan oleh: ' . $request->nama_pelanggan
        ]);

        return back()->with('success', 'Reservasi Berhasil Dibuat!');
    }
}
