<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'poin_mahasiswas';

    protected $fillable = [
        'nim',
        'nama',
        'tipe',                 // wajib ditambahkan
        'nama_kegiatan',        // nullable, tapi harus di-include
        'jenis_kegiatan',       // nullable, tapi harus di-include
        'tanggal_kegiatan',     // nullable, tapi harus di-include
        'jabatan',              // nullable, tapi harus di-include
        'status_keanggotaan',   // nullable, tapi harus di-include
        'deskripsi',
        'poin',
    ];
}
