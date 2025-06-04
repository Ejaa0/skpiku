<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use App\Models\DetailOrganisasiMahasiswa;

class DetailOrganisasiMahasiswaController extends Controller
{
    // Tampilkan form tambah anggota untuk organisasi tertentu
    public function create($id_organisasi)
    {
        // Cari organisasi berdasarkan id_organisasi
        $organisasi = Organisasi::where('id_organisasi', $id_organisasi)->firstOrFail();

        return view('detail_organisasi_mahasiswa.create', [
            'id_organisasi' => $organisasi->id_organisasi,
            'nama_organisasi' => $organisasi->nama_organisasi,
        ]);
    }

    // Simpan data anggota baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_organisasi' => 'required|exists:organisasi,id_organisasi',
            'mahasiswa_nim' => 'required|string',
            'jabatan' => 'required|string',
            'status_keanggotaan' => 'required|in:aktif,nonaktif',
        ]);

        // Simpan data anggota
        DetailOrganisasiMahasiswa::create([
            'id_organisasi' => $request->id_organisasi,
            'mahasiswa_nim' => $request->mahasiswa_nim,
            'jabatan' => $request->jabatan,
            'status_keanggotaan' => $request->status_keanggotaan,
        ]);

        // Redirect ke halaman show organisasi beserta anggota
        return redirect()->route('detail_organisasi_mahasiswa.show', $request->id_organisasi)
                         ->with('success', 'Data anggota berhasil ditambahkan.');
    }

    // Tampilkan detail organisasi beserta anggota-anggotanya
    public function show($id_organisasi)
    {
        $organisasi = Organisasi::where('id_organisasi', $id_organisasi)->firstOrFail();

        // Ambil semua anggota dari organisasi tersebut
        $detailMahasiswa = DetailOrganisasiMahasiswa::where('id_organisasi', $id_organisasi)->get();

        return view('organisasi.show', compact('organisasi', 'detailMahasiswa'));
    }

    // Tampilkan form edit anggota
    public function edit($id)
    {
        $detail = DetailOrganisasiMahasiswa::findOrFail($id);

        $organisasi = Organisasi::where('id_organisasi', $detail->id_organisasi)->firstOrFail();

        return view('detail_organisasi_mahasiswa.edit', compact('detail', 'organisasi'));
    }

    // Update data anggota
    public function update(Request $request, $id)
    {
        $request->validate([
            'mahasiswa_nim' => 'required|string',
            'jabatan' => 'required|string',
            'status_keanggotaan' => 'required|in:aktif,nonaktif',
        ]);

        $item = DetailOrganisasiMahasiswa::findOrFail($id);

        $item->update([
            'mahasiswa_nim' => $request->mahasiswa_nim,
            'jabatan' => $request->jabatan,
            'status_keanggotaan' => $request->status_keanggotaan,
        ]);

        return redirect()->route('detail_organisasi_mahasiswa.show', $item->id_organisasi)
                         ->with('success', 'Data anggota berhasil diperbarui.');
    }

    // Hapus data anggota
    public function destroy($id)
    {
        $item = DetailOrganisasiMahasiswa::findOrFail($id);
        $id_organisasi = $item->id_organisasi;
        $item->delete();

        return redirect()->route('detail_organisasi_mahasiswa.show', $id_organisasi)
                         ->with('success', 'Data anggota berhasil dihapus.');
    }
}
