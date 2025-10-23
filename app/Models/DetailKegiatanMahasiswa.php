<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kegiatan;
use App\Models\Mahasiswa;

class DetailKegiatanMahasiswa extends Model
{
    protected $table = 'detail_kegiatan_mahasiswa';

    protected $fillable = [
        'kegiatan_id_ref', 'mahasiswa_nim'
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id_ref', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    }
}
