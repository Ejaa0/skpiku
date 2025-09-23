<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenentuanPoin extends Model
{
    use HasFactory;

    protected $table = 'penentuan_poin';

    protected $fillable = [
        'keterangan',
        'poin',
    ];
}
