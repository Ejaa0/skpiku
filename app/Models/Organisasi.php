<?php

// app/Models/Organisasi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $table = 'organisasi'; // <- Tambahkan baris ini

    protected $fillable = [
        'id_organisasi',
        'nama_organisasi',
    ];
}

