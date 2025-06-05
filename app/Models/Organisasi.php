<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $table = 'organisasi';

    // Jika primary key kamu bukan 'id', tapi 'id_organisasi'
    protected $primaryKey = 'id_organisasi';

    // Karena tipe primary key string, bukan integer auto increment
    public $incrementing = false;

    // Tipe data primary key string
    protected $keyType = 'string';

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'id_organisasi',
        'nama_organisasi',
    ];
}
