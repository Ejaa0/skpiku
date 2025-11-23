<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use App\Models\DetailOrganisasiMahasiswa;

class OrganisasiController extends Controller
{
    // INDEX: Tampilkan semua organisasi
    public function index()
    {
        // Ambil data organisasi dengan pagination 10 per halaman
        $organisasi = Organisasi::paginate(10);
        return view('organisasi.index', compact('organisasi'));
    }

    // CREATE: Form tambah organisasi
    public function create()
    {
        return view('organisasi.create');
    }

    // STORE: Simpan organisasi baru
    public function store(Request $request)
    {
        $request->validate([
            'id_organisasi' => 'required|unique:organisasis,id_organisasi',
            'nama_organisasi' => 'required',
        ]);

        Organisasi::create([
            'id_organisasi' => $request->id_organisasi,
            'nama_organisasi' => $request->nama_organisasi,
        ]);

        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil ditambahkan.');
    }

    // SHOW: Detail organisasi + daftar anggotanya
    public function show($id)
    {
        $organisasi = Organisasi::where('id_organisasi', $id)->firstOrFail();
        $anggota = DetailOrganisasiMahasiswa::where('id_organisasi', $id)->get();

        return view('organisasi.show', [
            'organisasi' => $organisasi,
            'detailMahasiswa' => $anggota
        ]);
    }

    // EDIT: Form edit organisasi
    public function edit($id)
    {
        $organisasi = Organisasi::where('id_organisasi', $id)->firstOrFail();
        return view('organisasi.edit', compact('organisasi'));
    }

    // UPDATE: Simpan perubahan organisasi
    public function update(Request $request, $id)
    {
        $organisasi = Organisasi::where('id_organisasi', $id)->firstOrFail();

        $request->validate([
            'nama_organisasi' => 'required',
        ]);

        $organisasi->update([
            'nama_organisasi' => $request->nama_organisasi,
        ]);

        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil diperbarui.');
    }

    // DESTROY: Hapus organisasi
    public function destroy($id)
    {
        $organisasi = Organisasi::where('id_organisasi', $id)->firstOrFail();
        $organisasi->delete();

        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil dihapus.');
    }
}
