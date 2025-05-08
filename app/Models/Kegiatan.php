<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    // Relasi dari Kegiatan ke Organisasi
    public function organisasi()
    {
        return $this->hasMany(Organisasi::class, 'id_kegiatan');
    }
}
