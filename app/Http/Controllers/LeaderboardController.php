<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;

class LeaderboardController extends Controller
{
    public function index()
    {
        $nimLogin = session('user_nim'); // NIM mahasiswa yang login

        // Ambil NIM teman mahasiswa yang login
        $temanNim = DB::table('temans')
            ->where('mahasiswa_nim', $nimLogin)
            ->orWhere('teman_nim', $nimLogin)
            ->get()
            ->map(function($row) use ($nimLogin) {
                // kembalikan NIM teman, bukan NIM login
                return $row->mahasiswa_nim == $nimLogin ? $row->teman_nim : $row->mahasiswa_nim;
            })
            ->toArray();

        // Ambil data mahasiswa yang menjadi teman
        $mahasiswas = Mahasiswa::whereIn('nim', $temanNim)->get();

        $mahasiswa = $mahasiswas->map(function ($mhs) {

            // -------------------------
            // Poin kegiatan: 100 per kegiatan
            // -------------------------
            $jumlahKegiatan = DB::table('detail_kegiatan_mahasiswa')
                ->where('mahasiswa_nim', $mhs->nim)
                ->count();
            $poinKegiatan = $jumlahKegiatan * 100;

            // -------------------------
            // Poin organisasi: 250 per organisasi aktif
            // -------------------------
            $jumlahOrganisasi = DB::table('detail_organisasi_mahasiswa')
                ->where('nim', $mhs->nim)
                ->where('status_keanggotaan', 'aktif')
                ->count();
            $poinOrganisasi = $jumlahOrganisasi * 250;

            // -------------------------
            // Poin teman: 10 per teman
            // -------------------------
            $jumlahTeman = DB::table('temans')
                ->where(function($q) use ($mhs) {
                    $q->where('mahasiswa_nim', $mhs->nim)
                      ->orWhere('teman_nim', $mhs->nim);
                })
                ->count();
            $poinTeman = $jumlahTeman * 10;

            $totalPoin = $poinKegiatan + $poinOrganisasi + $poinTeman;

            return [
                'nim' => $mhs->nim,
                'nama' => $mhs->nama,
                'poin_kegiatan' => $poinKegiatan,
                'poin_organisasi' => $poinOrganisasi,
                'poin_teman' => $poinTeman,
                'total_poin' => $totalPoin,
                'jumlah_teman' => $jumlahTeman
            ];
        })
        ->sortByDesc('total_poin') // urutkan dari poin tertinggi
        ->values();

        return view('tampilan_mahasiswa.leaderboard.index', compact('mahasiswa'));
    }
}
