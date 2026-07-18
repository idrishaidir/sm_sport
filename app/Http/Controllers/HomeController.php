<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;
use App\Models\Reservasi;

class HomeController extends Controller
{
    public function index(){
        $lapangans = Lapangan::all();
        return view('welcome', compact('lapangans'));
    }

    public function ketersediaan()
    {
        $lapangans = Lapangan::all();
        return view('ketersediaan', compact('lapangans'));
    }

    public function getJadwal(Request $request)
    {
        $lapangan_id = $request->lapangan_id;
        $tanggal = $request->tanggal;

        if(!$lapangan_id || !$tanggal){
            return response()->json([]);
        }

        $reservasis = Reservasi::where('lapangan_id', $lapangan_id)
            ->where('tanggal', $tanggal)
            ->whereIn('status',['Pending', 'Lunas'])
            ->get(['jam_mulai', 'durasi_jam']);

        $booked_slots = [];

        foreach ($reservasis as $res) {
            $startHour = (int) date('H', strtotime($res->jam_mulai));
            for ($i = 0; $i < $res->durasi_jam; $i++){
                $booked_slots[] = sprintf('%02d:00', $startHour + $i);
            }
        }

        return response()->json($booked_slots);
    }
}
