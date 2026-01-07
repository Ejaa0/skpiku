<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemanRequest extends Model
{
    protected $table = 'teman_requests';

    protected $fillable = [
        'pengirim_nim',
        'penerima_nim',
        'status'
    ];
}
