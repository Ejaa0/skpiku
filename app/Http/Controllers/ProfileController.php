<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil mahasiswa
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil NIM mahasiswa yang sedang login dari session
        $nim = session('user_nim');

        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        // Jika data tidak ditemukan, tampilkan 404
        if (!$mahasiswa) {
            abort(404, 'Data mahasiswa tidak ditemukan');
        }

        // Kirim data mahasiswa ke view
        return view('tampilan_mahasiswa.profil', compact('mahasiswa'));
    }
}
