<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = [
        'id_kegiatan',
        'jenis_kegiatan',
        'nama_kegiatan',
        'tanggal_kegiatan',
        'absensi',
    ];
    public function detailMahasiswa()
{
    return $this->hasMany(DetailKegiatanMahasiswa::class, 'kegiatan_id_ref', 'id_kegiatan');
}

}
