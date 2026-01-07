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

        // Ambil NIM teman
        $temanNim = DB::table('temans')
            ->where('mahasiswa_nim', $nimLogin)
            ->orWhere('teman_nim', $nimLogin)
            ->get()
            ->map(function($row) use ($nimLogin) {
                return $row->mahasiswa_nim == $nimLogin ? $row->teman_nim : $row->mahasiswa_nim;
            })
            ->toArray();

        // Ambil data mahasiswa yang temannya ada
        $mahasiswas = Mahasiswa::whereIn('nim', $temanNim)->get();

        $mahasiswa = $mahasiswas->map(function ($mhs) {

            $poinKegiatan = DB::table('detail_kegiatan_mahasiswa')
                ->where('mahasiswa_nim', $mhs->nim)
                ->sum('poin');

            $poinOrganisasi = DB::table('detail_organisasi_mahasiswa')
                ->where('nim', $mhs->nim)
                ->where('status_keanggotaan', 'aktif')
                ->count() * 50;

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
        ->sortByDesc('total_poin')
        ->values();

        return view('tampilan_mahasiswa.leaderboard.index', compact('mahasiswa'));
    }
}
