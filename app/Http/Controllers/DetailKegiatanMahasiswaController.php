<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailKegiatanMahasiswaController extends Controller
{
    public function index()
    {
        $data = DB::table('detail_kegiatan_mahasiswa')
            ->join('mahasiswas', 'detail_kegiatan_mahasiswa.mahasiswa_nim', '=', 'mahasiswas.nim')
            ->join('kegiatans', 'detail_kegiatan_mahasiswa.kegiatan_id_ref', '=', 'kegiatans.id_kegiatan')
            ->select('mahasiswas.nama', 'kegiatans.nama_kegiatan')
            ->get();

        return view('detail_kegiatan_mahasiswa.index', compact('data'));
    }
}
