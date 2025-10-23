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

    // Jika tidak ada kolom created_at & updated_at
    // public $timestamps = false;

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

    // Relasi ke pivot/detail kegiatan
    public function detailKegiatan()
    {
        return $this->hasMany(DetailKegiatanMahasiswa::class, 'mahasiswa_nim', 'nim');
    }

    // Relasi langsung ke kegiatan lewat pivot
    public function kegiatan()
    {
        return $this->hasManyThrough(
            Kegiatan::class,
            DetailKegiatanMahasiswa::class,
            'mahasiswa_nim', // FK pivot ke mahasiswa
            'id_kegiatan',   // PK di Kegiatan
            'nim',           // PK di Mahasiswa
            'kegiatan_id_ref' // FK pivot ke kegiatan
        );
    }
}
