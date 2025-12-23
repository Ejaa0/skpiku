<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;

class DashboardMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        // 🔐 CEK LOGIN GLOBAL
        if (!session('is_logged_in') || session('user_role') !== 'mahasiswa') {
            return redirect()->route('login');
        }

        // ✅ Ambil NIM dari email (7 angka)
        $email = session('user_email');
        $nim   = substr($email, 0, 7);

        // Ambil data mahasiswa
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        // Total kegiatan
        $totalKegiatan = DB::table('detail_kegiatan_mahasiswa')
            ->where('mahasiswa_nim', $nim)
            ->count();

        // Total organisasi
        $totalOrganisasi = DB::table('detail_organisasi_mahasiswa')
            ->where('nim', $nim)
            ->count();

        // Total poin (100 per kegiatan, 250 per organisasi)
        $totalPoin = ($totalKegiatan * 100) + ($totalOrganisasi * 250);

        // Riwayat kegiatan terbaru (5 kegiatan)
        $riwayatKegiatan = DB::table('detail_kegiatan_mahasiswa as dkm')
            ->join('kegiatans as k', 'dkm.kegiatan_id_ref', '=', 'k.id')
            ->select('k.tanggal_kegiatan', 'k.nama_kegiatan', DB::raw('100 as poin'))
            ->where('dkm.mahasiswa_nim', $nim)
            ->orderBy('k.tanggal_kegiatan', 'desc')
            ->limit(5)
            ->get();

        return view('tampilan_mahasiswa.index', compact(
            'nim',
            'mahasiswa',
            'totalKegiatan',
            'totalOrganisasi',
            'totalPoin',
            'riwayatKegiatan'
        ));
    }
}
