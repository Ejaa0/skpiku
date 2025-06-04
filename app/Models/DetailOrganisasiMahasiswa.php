<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organisasi; // ✅ WAJIB ditambahkan agar relasi tidak salah

class DetailOrganisasiMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'detail_organisasi_mahasiswa';

    protected $fillable = [
        'mahasiswa_nim',
        'id_organisasi',
        'jabatan',
        'status_keanggotaan',
    ];

    // Relasi ke Organisasi
    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'id_organisasi', 'id_organisasi');
    }

    // public function mahasiswa()
    // {
    //     return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    // }
}
