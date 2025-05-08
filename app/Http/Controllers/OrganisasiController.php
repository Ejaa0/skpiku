<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    // Metode untuk menampilkan daftar organisasi
    public function index()
    {
        // Mengambil semua data organisasi
        $organisasis = Organisasi::all();

        // Mengembalikan view dengan data organisasi
        return view('organisasi.index', compact('organisasis'));
    }

    // Metode store untuk menyimpan data
    public function store(Request $request)
    {
        // Validasi dan penyimpanan data
        $validated = $request->validate([
            'nim' => 'required|numeric',
            'nama' => 'required|string',
            'id_kegiatan' => 'required|numeric',
            'nama_organisasi' => 'required|string',
            'absensi' => 'required|in:HADIR,TIDAK',
        ]);

        $organisasi = new Organisasi();
        $organisasi->nim = $validated['nim'];
        $organisasi->nama = $validated['nama'];
        $organisasi->id_kegiatan = $validated['id_kegiatan'];
        $organisasi->nama_organisasi = $validated['nama_organisasi'];
        $organisasi->absensi = $validated['absensi'];
        $organisasi->save();

        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil ditambahkan!');
    }

    // Metode lainnya...
}

