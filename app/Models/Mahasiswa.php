<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nim',
        'temp_lahir',
        'tgl_lahir',
        'sex',
        'agama',
        'hobi',
        'angkatan',
        'email',
    ];
}