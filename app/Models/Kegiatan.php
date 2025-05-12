<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = [
        'nim',
        'nama',
        'id_kegiatan',
        'jenis_kegiatan',
        'nama_kegiatan',
        'tanggal_kegiatan',
        'absensi',
    ];
}
