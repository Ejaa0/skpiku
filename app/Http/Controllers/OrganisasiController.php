<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    // Menampilkan daftar organisasi
    public function index()
    {
        $organisasis = Organisasi::all();
        return view('organisasi.index', compact('organisasis'));
    }

    // Menampilkan form tambah organisasi
    public function create()
    {
        return view('organisasi.create'); // tidak kirim $kegiatans
    }

    // Menyimpan data organisasi baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nim' => 'required|string',
            'nama' => 'required|string',
            'kegiatan' => 'required|string|max:255',
            'nama_organisasi' => 'required|string',
            'absensi' => 'required|string',
        ]);

        // Simpan data organisasi
        Organisasi::create($validated);

        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil ditambahkan!');
    }

    // Menampilkan form edit organisasi
    public function edit(Organisasi $organisasi)
    {
        return view('organisasi.edit', compact('organisasi')); // tidak kirim $kegiatans
    }

    // Mengupdate data organisasi
    public function update(Request $request, Organisasi $organisasi)
    {
        $validated = $request->validate([
            'nim' => 'required|string',
            'nama' => 'required|string',
            'kegiatan' => 'required|string|max:255',
            'nama_organisasi' => 'required|string',
            'absensi' => 'required|string',
        ]);

        $organisasi->update($validated);

        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil diperbarui!');
    }

    // Menghapus data organisasi
    public function destroy(Organisasi $organisasi)
    {
        $organisasi->delete();

        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil dihapus!');
    }
}
