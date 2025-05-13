<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'poin_mahasiswas';

    protected $fillable = [
        'nim',
        'nama',
        'nama_kegiatan',
        'jenis_kegiatan',
        'tanggal_kegiatan',
        'deskripsi',
        'poin',
    ];
}
