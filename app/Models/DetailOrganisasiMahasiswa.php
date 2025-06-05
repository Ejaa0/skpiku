<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrganisasiMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'detail_organisasi_mahasiswa';

    protected $fillable = [
        'nim',
        'id_organisasi',
         'nama_organisasi',  // PENTING: harus ada di sini
        'nama', // tambahkan jika kamu menyimpan nama di tabel ini
        'jabatan',
        'status_keanggotaan',
    ];

    /**
     * Relasi ke model Organisasi
     */
    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'id_organisasi', 'id_organisasi');
    }

    /**
     * Relasi ke model Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }
}
