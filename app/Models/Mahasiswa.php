<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'nama', 'nim', 'temp_lahir', 'tgl_lahir', 'sex', 'agama', 'hobi', 'angkatan', 'email'
    ];
    public function detailKegiatan()
{
    return $this->hasMany(DetailKegiatanMahasiswa::class, 'mahasiswa_nim', 'nim');
}

}
