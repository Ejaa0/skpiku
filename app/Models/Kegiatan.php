<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailKegiatanMahasiswa;
use App\Models\Mahasiswa;

class Kegiatan extends Model
{
    protected $fillable = [
        'id_kegiatan', 'nama_kegiatan', 'tanggal_kegiatan', 'jenis_kegiatan', 'deskripsi'
    ];

    // Relasi ke tabel pivot detail_kegiatan_mahasiswa
    public function detailMahasiswa()
    {
        return $this->hasMany(DetailKegiatanMahasiswa::class, 'kegiatan_id_ref', 'id');
    }

    // Relasi langsung ke mahasiswa melalui pivot
    public function mahasiswa()
    {
        return $this->hasManyThrough(
            Mahasiswa::class,
            DetailKegiatanMahasiswa::class,
            'kegiatan_id_ref', // FK pivot ke kegiatan
            'nim',             // PK mahasiswa
            'id',              // PK kegiatan
            'mahasiswa_nim'    // FK pivot ke mahasiswa
        );
    }
}
