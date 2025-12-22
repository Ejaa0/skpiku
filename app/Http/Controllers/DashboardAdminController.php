<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // wajib ada

class DashboardAdminController extends Controller
{
    public function statistik()
    {
        // Cek tabel, ubah nama sesuai DB
        $mahasiswa  = DB::table('mahasiswas')->count();
        $kegiatan   = DB::table('kegiatans')->count();
        $organisasi = DB::table('organisasis')->count();
        $poin       = DB::table('poin_mahasiswas')->sum('poin');

        // Chart dummy ringan supaya tidak error
        $chart = [0,0,0,0,0,0,0,0,0,0,0,0];

        return response()->json([
            'mahasiswa'  => $mahasiswa,
            'kegiatan'   => $kegiatan,
            'organisasi' => $organisasi,
            'poin'       => $poin,
            'chart'      => $chart
        ]);
    }
}
