<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinMahasiswa extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika nama model dan tabel mengikuti konvensi)
    protected $table = 'poin_mahasiswa';

    // Kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'nim',
        'nama',
        'nama_kegiatan',
        'beri_poin',
        'jumlah_poin',
    ];
}
