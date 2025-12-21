<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaOrganisasiController extends Controller
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

        // Ambil data organisasi
        $organisasi = DB::table('detail_organisasi_mahasiswa')
            ->select('nama_organisasi', 'jabatan')
            ->where('nim', $nim)
            ->orderBy('nama_organisasi', 'asc')
            ->get()
            ->map(function($item) {
                $item->poin = 250; // Set poin default 250
                return $item;
            });

        // Total poin dari organisasi
        $totalPoin = $organisasi->sum('poin');

        return view('tampilan_mahasiswa.organisasi.index', compact('organisasi', 'nim', 'totalPoin'));
    }
}
