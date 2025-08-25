<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use App\Models\Kegiatan;

class WarekController extends Controller
{
    public function index()
    {
        $totalOrganisasi = Organisasi::count();
        $totalKegiatan   = Kegiatan::count();
        $laporanMasuk    = 5;

        return view('layouts.dashboard_warek_utama', compact('totalOrganisasi', 'totalKegiatan', 'laporanMasuk'));
    }
}
