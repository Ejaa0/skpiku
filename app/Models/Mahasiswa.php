<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'nim', 'temp_lahir', 'tgl_lahir', 'sex', 'agama', 'hobi', 'angkatan', 'email'
    ];
}
