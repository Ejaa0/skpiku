<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaKlaimPoinController extends Controller
{
    public function index()
    {
        // 🔐 Cek login mahasiswa
        if (!session('is_logged_in') || session('user_role') !== 'mahasiswa') {
            return redirect()->route('login');
        }

        // ✅ Ambil NIM dari email (7 angka)
        $email = session('user_email');
        $nim   = substr($email, 0, 7);

        // ================= ORGANISASI =================
        $organisasi = DB::table('detail_organisasi_mahasiswa')
            ->where('nim', $nim)
            ->get();

        $poinOrganisasi = $organisasi->count() * 250;

        // ================= KEGIATAN (JOIN) =================
        $kegiatan = DB::table('detail_kegiatan_mahasiswa')
            ->join(
                'kegiatans',
                'detail_kegiatan_mahasiswa.kegiatan_id_ref',
                '=',
                'kegiatans.id'
            )
            ->where('detail_kegiatan_mahasiswa.mahasiswa_nim', $nim)
            ->select(
                'kegiatans.nama_kegiatan'
            )
            ->get();

        $poinKegiatan = $kegiatan->count() * 100;

        // ================= TOTAL =================
        $totalPoin = $poinOrganisasi + $poinKegiatan;

        return view('tampilan_mahasiswa.klaim_poin.index', compact(
            'nim',
            'organisasi',
            'kegiatan',
            'poinOrganisasi',
            'poinKegiatan',
            'totalPoin'
        ));
    }
}
