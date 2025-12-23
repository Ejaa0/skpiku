<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaKegiatanController extends Controller
{
    public function index()
    {
        // 🔐 CEK LOGIN MAHASISWA
        if (!session('is_logged_in') || session('user_role') !== 'mahasiswa') {
            return redirect()->route('login');
        }

        // ✅ Ambil NIM dari email (7 angka)
        $email = session('user_email');
        $nim   = substr($email, 0, 7);

        // 📌 Ambil daftar kegiatan mahasiswa berdasarkan NIM
        $kegiatans = DB::table('detail_kegiatan_mahasiswa as dkm')
            ->join('kegiatans as k', 'dkm.kegiatan_id_ref', '=', 'k.id')
            ->select(
                'k.nama_kegiatan',
                'k.tanggal_kegiatan'
            )
            ->where('dkm.mahasiswa_nim', $nim)
            ->orderBy('k.tanggal_kegiatan', 'desc')
            ->get()
            ->map(function($item) {
                $item->poin = 100; // Setiap kegiatan 150 poin
                return $item;
            });

        // Hitung total poin
        $totalPoin = $kegiatans->count() * 100;

        return view('tampilan_mahasiswa.kegiatan.index', compact(
            'kegiatans',
            'nim',
            'totalPoin'
        ));
    }
}
