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

        // 📌 Ambil organisasi yang diikuti
        $organisasi = DB::table('detail_organisasi_mahasiswa')
            ->where('nim', $nim)
            ->get();

        // 📌 Hitung total poin (250 per organisasi)
        $totalPoin = $organisasi->count() * 250;

        return view('tampilan_mahasiswa.klaim_poin.index', compact(
            'nim',
            'organisasi',
            'totalPoin'
        ));
    }
}
