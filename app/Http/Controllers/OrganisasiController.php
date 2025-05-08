<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    // Menampilkan daftar organisasi
    public function index()
    {
        // Mengambil semua data organisasi dari database
        $organisasi = Organisasi::all();

        // Mengembalikan ke view 'organisasi.index' dengan data organisasi
        return view('organisasi.index', compact('organisasi'));
    }

    // Menangani form input dan menyimpan data ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nim' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'id_kegiatan' => 'required|exists:kegiatans,id', // Pastikan id_kegiatan ada di tabel kegiatans
            'nama_organisasi' => 'required|string|max:255',
            'absensi' => 'required|in:HADIR,TIDAK', // Absensi hanya bisa Hadir atau Tidak Hadir
        ]);

        // Menyimpan data ke dalam tabel organisasi
        Organisasi::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'id_kegiatan' => $request->id_kegiatan,
            'nama_organisasi' => $request->nama_organisasi,
            'absensi' => $request->absensi,
        ]);

        // Redirect ke halaman index organisasi atau halaman lain setelah berhasil
        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil ditambahkan!');
    }
}
