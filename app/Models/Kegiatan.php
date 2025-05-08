<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatans'; // default-nya Laravel
    protected $fillable = [
        'nim',
        'nama',
        'tanggal_kegiatan',
        'nama_kegiatan',
        'deskripsi',
    ];
}
