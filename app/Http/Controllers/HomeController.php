<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

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

        $cacheKey = "Jadwal_{$lapangan_id}_{$tanggal}";

        $booked_slots = Cache::remember($cacheKey, 60, function () use ($lapangan_id, $tanggal){
            $reservasis = Reservasi::where('lapangan_id', $lapangan_id)
                ->where('tanggal', $tanggal)
                ->whereIn('status',['Pending', 'Lunas'])
                ->get(['jam_mulai', 'durasi_jam']);

            $slots = [];

            foreach ($reservasis as $res) {
                $startHour = (int) date('H', strtotime($res->jam_mulai));
                for ($i = 0; $i < $res->durasi_jam; $i++){
                    $slots[] = sprintf('%02d:00', $startHour + $i);
                }
            }
            return $slots;

        });

        return response()->json($booked_slots);
    }

    public function dashboard(Request $request)
    {
        if (Auth::user()->role === 'admin'){
            return redirect()->route('admin.dashboard');
        }

        Reservasi::where('user_id', Auth::id())
            ->where('status', 'Pending')
            ->whereNull('bukti_bayar')
            ->where('batas_waktu_bayar', '<', now())
            ->update([
                'status' => 'Gagal',
                'keterangan' => 'Waktu pembayaran 15 menit habis.'
            ]);
        
        $reservasis = Reservasi::where('user_id', Auth::id())->latest()->get();
        
        $total_reservasi = $reservasis->count();

        $menunggu_pembayaran = $reservasis->where('status', 'Pending')->count();
        $total_pengeluaran = $reservasis->where('status', 'Lunas')->sum('total_bayar');

        if($request->has('show')){
            $upcoming = $reservasis->where('id', $request->show)->first();
        } else {
            $upcoming = Reservasi::where('user_id', Auth::id())->latest()->first();
        }

        return view('dashboard', compact(
            'reservasis', 
            'total_reservasi', 
            'menunggu_pembayaran', 
            'total_pengeluaran', 
            'upcoming'
        ));
    }
}
