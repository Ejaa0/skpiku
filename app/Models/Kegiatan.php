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

    // Relasi ke pivot detail_kegiatan_mahasiswa (opsional)
    public function detailMahasiswa()
    {
        return $this->hasMany(DetailKegiatanMahasiswa::class, 'kegiatan_id_ref', 'id');
    }

    // Relasi langsung ke mahasiswa melalui pivot
    public function mahasiswa()
    {
        return $this->belongsToMany(
            Mahasiswa::class,            // Model tujuan
            'detail_kegiatan_mahasiswa', // Nama tabel pivot
            'kegiatan_id_ref',           // FK di pivot ke kegiatan
            'mahasiswa_nim',             // FK di pivot ke mahasiswa
            'id',                        // PK kegiatan
            'nim'                        // PK mahasiswa
        );
    }
}
