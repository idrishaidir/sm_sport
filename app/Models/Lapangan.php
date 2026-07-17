<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{   
    protected $fillable = [
        'nama_lapangan',
        'jenis_lapangan',
        'harga_per_jam'
    ];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}
