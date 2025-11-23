<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $table = 'organisasis';
    
    protected $primaryKey = 'id_organisasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_organisasi',
        'nama_organisasi',
    ];

    // Relasi ke anggota
    public function anggota()
    {
        return $this->hasMany(\App\Models\DetailOrganisasiMahasiswa::class, 'id_organisasi', 'id_organisasi');
    }
}
