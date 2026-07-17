<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $fillable = [
        'user_id',
        'lapangan_id',
        'tanggal',
        'jam_mulai',
        'durasi_jam',
        'total_bayar',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }
}
