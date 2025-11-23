<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;

class WROrganisasiController extends Controller
{
    public function index()
    {
        // Ambil semua organisasi beserta relasi anggota
        $organisasis = Organisasi::with('detailOrganisasiMahasiswa')->get();

        return view('warek.tampilan_organisasi.index', compact('organisasis'));
    }
}
