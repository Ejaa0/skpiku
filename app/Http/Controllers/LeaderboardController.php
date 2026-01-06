<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa; // Ganti dengan model mahasiswa kamu

class LeaderboardController extends Controller
{
    public function index()
    {
        // Ambil semua mahasiswa, urut berdasarkan poin terbesar
        $mahasiswa = Mahasiswa::orderBy('poin', 'desc')->get();

        // Kirim data ke view
        return view('tampilan_mahasiswa.leaderboard.index', compact('mahasiswa'));
    }
}
