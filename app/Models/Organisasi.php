<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $table = 'organisasi'; // gunakan nama tabel yang benar
    protected $fillable = [
        'nim',
        'nama',
        'id_kegiatan',
        'nama_organisasi',
        'absensi',
    ];

    // Relasi ke tabel kegiatan (jika ada)
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }
}
