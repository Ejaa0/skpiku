<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use App\Models\Kegiatan;
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
        // Ambil semua kegiatan untuk dipilih pada dropdown
        $kegiatans = Kegiatan::all();
        return view('organisasi.create', compact('kegiatans'));
    }

    // Menyimpan data organisasi baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nim' => 'required|string',
            'nama' => 'required|string',
            'nama_organisasi' => 'required|string',
            'absensi' => 'required|string',
            'id_kegiatan' => 'required|exists:kegiatans,id', // Pastikan id_kegiatan ada di tabel kegiatans
        ]);

        // Simpan data organisasi
        Organisasi::create($validated);

        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil ditambahkan!');
    }

    // Menampilkan form edit organisasi
    public function edit(Organisasi $organisasi)
    {
        $kegiatans = Kegiatan::all();
        return view('organisasi.edit', compact('organisasi', 'kegiatans'));
    }

    // Mengupdate data organisasi
    public function update(Request $request, Organisasi $organisasi)
    {
        $validated = $request->validate([
            'nim' => 'required|string',
            'nama' => 'required|string',
            'nama_organisasi' => 'required|string',
            'absensi' => 'required|string',
            'id_kegiatan' => 'required|exists:kegiatans,id',
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
