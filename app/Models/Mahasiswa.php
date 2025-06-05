<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';

    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    // Jika kamu tidak punya kolom created_at dan updated_at di tabel mahasiswas,
    // uncomment baris ini:
    // public $timestamps = false;

    protected $fillable = [
        'nim',
        'nama',
        'temp_lahir',
        'tgl_lahir',
        'sex',
        'agama',
        'hobi',
        'angkatan',
        'email',
    ];

    public function getRouteKeyName()
    {
        return 'nim';
    }
}
