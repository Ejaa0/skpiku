<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'nama',
        'temp_lahir',
        'tgl_lahir',
        'sex',
        'agama',
        'hobi',
        'angkatan',
        'email',
    ];

    public function getRouteKeyName()
    {
        return 'nim';
    }

    // Relasi ke poin mahasiswa
    public function poin()
    {
        return $this->hasMany(PoinMahasiswa::class, 'nim', 'nim');
    }

    // Relasi ke pivot/detail kegiatan
    public function detailKegiatan()
    {
        return $this->hasMany(DetailKegiatanMahasiswa::class, 'mahasiswa_nim', 'nim');
    }

    // Relasi ke kegiatan lewat pivot
    public function kegiatan()
    {
        return $this->belongsToMany(
            Kegiatan::class,             // Model tujuan
            'detail_kegiatan_mahasiswa', // Tabel pivot
            'mahasiswa_nim',             // FK pivot ke mahasiswa
            'kegiatan_id_ref',           // FK pivot ke kegiatan
            'nim',                       // PK Mahasiswa
            'id_kegiatan'                // PK Kegiatan
        );
    }

    // Relasi ke detail organisasi mahasiswa
    public function detailOrganisasi()
    {
        return $this->hasMany(DetailOrganisasiMahasiswa::class, 'nim', 'nim');
    }
}
