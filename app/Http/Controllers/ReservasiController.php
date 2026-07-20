<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Reservasi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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

        $jam_mulai = (int) date('H', strtotime($request->jam_mulai));
        $durasi = (int) $request->durasi_jam;
        $jam_selesai = $jam_mulai + $durasi;

        if ($jam_selesai > 23){
            return back()->with('error', 'Gagal: Melebihi Jam Operasional SM SPORT CENTER pukul 23.00.');
        }

        if($jam_mulai == 22 && $durasi > 1){
            return back()->with("error", "Gagal: Untuk Pemesanan jam 22.00, durasi maksimal 1.");
        }

        DB::beginTransaction();

        try {
            $lapangan = Lapangan::where('id', $request->lapangan_id)->lockForUpdate()->first();

            $new_start = strtotime($request->jam_mulai);
            $new_end = strtotime("+". $request->durasi_jam . " hours", $new_start);

            $bentrok = Reservasi::where('lapangan_id', $request->lapangan_id)
                ->where('tanggal', $request->tanggal)
                ->whereIn('status' , ['Pending', 'Lunas'])
                ->get()
                ->contains(function ($jadwal) use ($new_start, $new_end) {
                    $exist_start = strtotime($jadwal->jam_mulai);
                    $exist_end = strtotime("+" . $jadwal->durasi_jam . " hours", $exist_start);
                    return $new_start < $exist_end && $new_end > $exist_start;
                });

            if ($bentrok) {
                DB::rollBack(); 
                return back()->with('error', 'Gagal: Jadwal berbenturan.');
            }

            Reservasi::create([
                'user_id' => Auth::id(),
                'lapangan_id' => $request->lapangan_id,
                'tanggal' => $request->tanggal,
                'jam_mulai'=> $request->jam_mulai,
                'durasi_jam'=> $request->durasi_jam,
                'total_bayar'=> $lapangan->harga_per_jam * $request->durasi_jam,
                'status'=>'Pending',
                'batas_waktu_bayar' => now()->addMinutes(15)
            ]);

            DB::commit(); 
            return redirect()->route('dashboard')->with("success", "Reservasi Berhasil!");

        } catch (\Exception $e) {
            DB::rollBack(); 
            return back()->with('error', 'Terjadi kesalahan sistem, silakan coba lagi.');
        }
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'bukti_bayar.max' => 'Ukuran file terlalu besar! Maksimal 2MB.',
            'bukti_bayar.image' => 'File harus berupa gambar.',
            'bukti_bayar.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
        ]);

        $reservasi = Reservasi::findOrFail($id);

        if (now()->greaterThan($reservasi->batas_waktu_bayar)){
            $reservasi->update([
                'status' => 'Gagal',
                'keterangan' => 'Waktu pembayaran 15 menit telah habis.'
                ]);
            return back()->with('error', 'Waktu Pembayaran telah Habis. Pesanan dibatalkan otomatis.');
        }

        if ($request->hasFile('bukti_bayar')){
            $file = $request->file('bukti_bayar');

            $nama_file = time() . "_" . $file->getClientOriginalName();
            
            $file->storeAs('bukti_bayar', $nama_file, 'public');
            $reservasi->update([
                'bukti_bayar' => $nama_file,
            ]);

            return back()->with("Succes", "Bukti pembayaran berhasil diunggah! Menunggu Konfirmasi Admin.");
        }

        return back()->with('error', 'Gagal mengunggah file.');
    }
}
