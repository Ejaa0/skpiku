<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\PoinMahasiswa;
use App\Models\Mahasiswa;

class WarekController extends Controller
{
    /**
     * Tampilkan dashboard Wakil Rektor III
     */
    public function index()
    {
        // Pastikan user sudah login sebagai warek
        if (!Session::get('is_warek_logged_in')) {
            return redirect()->route('warek.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data statistik
        $totalMahasiswa = Mahasiswa::count();
        $totalPoin = PoinMahasiswa::sum('poin'); // pastikan kolom 'poin' ada di tabel poin_mahasiswa

        // Sesuaikan dengan nama file view kamu
        // Jika file ada di resources/views/dashboard_warek.blade.php
        return view('dashboard_warek', compact('totalMahasiswa', 'totalPoin'));

        // Jika file ada di resources/views/warek/dashboard_warek.blade.php
        // return view('warek.dashboard_warek', compact('totalMahasiswa', 'totalPoin'));
    }

    /**
     * Proses login WR III
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Contoh hardcode login, bisa diganti database nanti
        if ($request->email === 'warek@unai.ac.id' && $request->password === 'warek123') {
            Session::put('is_warek_logged_in', true);
            return redirect()->route('warek.dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    /**
     * Logout WR III
     */
    public function logout()
    {
        Session::forget('is_warek_logged_in');
        return redirect()->route('warek.login')->with('success', 'Berhasil logout.');
    }
}
