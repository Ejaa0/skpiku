<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teman extends Model
{
    protected $fillable = ['mahasiswa_nim', 'teman_nim'];

    public function temanMahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'teman_nim', 'nim');
    }
}
