<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skpi extends Model
{
    use HasFactory;

    protected $table = 'skpis';

    protected $fillable = [
        'nama',
        'ttl',
        'nim',
        'masuk',
        'lulus',
        'no_ijazah',
        'gelar',
        'prodi',
        'bahasa',
        'jenjang',
        'karakter',
        'tanggal_surat',
    ];
}
