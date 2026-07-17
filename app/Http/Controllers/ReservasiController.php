<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Reservasi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function create()
    {
        $lapangans = Lapangan::all();
        return view ('reservasi.create', compact('lapangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required',
            'durasi_jam' => 'required|integer|min:1'
        ]);

        $new_start = strtotime($request->jam_mulai);
        $new_end = strtotime("+". $request->durasi_jam . " hours", $new_start);

        $jadwal_hari_ini = Reservasi::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal', $request->tanggal)
            ->whereIn('status' , ['Pending', 'Lunas'])
            ->get();

        $bentrok = False;

        foreach($jadwal_hari_ini as $jadwal){
            $exist_start = strtotime($jadwal->jam_mulai);
            $exist_end = strtotime("+" . $jadwal->durasi_jam . " hours", $exist_start);

            if ($new_start < $exist_end && $new_end > $exist_start){
                $bentrok = true;
                break;
            };
        }

        if ($bentrok) {
            return back()->with('error', 'Gagal: Jadwal berbenturan. Lapangan sedang dipakai pada jam tersebut.');
        }
        $lapangan = Lapangan::find($request->lapangan_id);

        Reservasi::create([
            'user_id' => Auth::id(),
            'lapangan_id' => $request->lapangan_id,
            'tanggal' => $request->tanggal,
            'jam_mulai'=> $request->jam_mulai,
            'durasi_jam'=> $request->durasi_jam,
            'total_bayar'=>$lapangan->harga_per_jam * $request->durasi_jam,
            'status'=>'Pending'
        ]);

        return back()->with("Succes", "Reservasi Berhasil Dibuat! Silahkan Lakukan Pembayaran");

    }
}
