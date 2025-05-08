<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    // Tentukan nama tabel yang sesuai dengan tabel di database
    protected $table = 'organisasi';  // Nama tabel yang benar

    protected $fillable = [
        'nim', 
        'nama', 
        'id_kegiatan', 
        'nama_organisasi', 
        'absensi'
    ];

    // Relasi dengan model Kegiatan
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }
}

