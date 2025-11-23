<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Organisasi;

class OrganisasiDashboardController extends Controller
{
    public function index()
    {
        if (!session('is_logged_in') || session('user_role') !== 'organisasi') {
            return redirect()->route('login');
        }

        $totalKegiatan = Kegiatan::count();
        $totalOrganisasi = Organisasi::count();
        $latestKegiatan = Kegiatan::latest('created_at')->take(5)->get();

        return view('tampilan_organisasi.dashboard_organisasi', compact(
            'totalKegiatan',
            'totalOrganisasi',
            'latestKegiatan'
        ));
    }
}
