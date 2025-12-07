<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use App\Models\Mahasiswa;
use App\Models\DetailOrganisasiMahasiswa;

class WarekTambahAnggotaController extends Controller
{
    // ============================
    // SHOW DETAIL ORGANISASI
    // ============================
    public function show($id_organisasi)
    {
        $organisasi = Organisasi::with('anggota')->findOrFail($id_organisasi);
        return view('warek.dataorganisasi.show', compact('organisasi'));
    }

    // ============================
    // FORM CREATE ANGGOTA
    // ============================
    public function create($id_organisasi)
    {
        $organisasi = Organisasi::findOrFail($id_organisasi);
        $mahasiswa = Mahasiswa::all();

        return view('warek.dataorganisasi.create', compact('organisasi', 'mahasiswa'));
    }

    // ============================
    // STORE ANGGOTA BARU
    // ============================
    public function store(Request $request, $id_organisasi)
{
    $request->validate([
        'nim' => 'required',
        'jabatan' => 'required',
        'status_keanggotaan' => 'required|in:aktif,nonaktif',
        'jabatan_custom' => 'nullable|string|max:255'
    ]);

    $jabatan = $request->jabatan === 'lainnya'
        ? $request->jabatan_custom
        : $request->jabatan;

    // Ambil data mahasiswa dan organisasi
    $mahasiswa = Mahasiswa::find($request->nim);
    $organisasi = Organisasi::findOrFail($id_organisasi);

    DetailOrganisasiMahasiswa::create([
        'id_organisasi'    => $id_organisasi,
        'nim'              => $request->nim,
        'nama'             => $mahasiswa->nama ?? '-',   // nama mahasiswa
        'jabatan'          => $jabatan,
        'status_keanggotaan'=> $request->status_keanggotaan,
        'nama_organisasi'  => $organisasi->nama_organisasi // <-- penting
    ]);

    return redirect()
        ->route('warek.dataorganisasi.show', $id_organisasi)
        ->with('success', 'Anggota berhasil ditambahkan.');
}

    // ============================
    // FORM EDIT ANGGOTA
    // ============================
    public function edit($id)
    {
        $detail = DetailOrganisasiMahasiswa::findOrFail($id);
        return view('warek.dataorganisasi.edit', compact('detail'));
    }

    // ============================
    // UPDATE ANGGOTA
    // ============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'jabatan' => 'required',
            'status_keanggotaan' => 'required|in:aktif,nonaktif',
            'jabatan_custom' => 'nullable|string|max:255'
        ]);

        $detail = DetailOrganisasiMahasiswa::findOrFail($id);

        $jabatan = $request->jabatan === 'lainnya'
            ? $request->jabatan_custom
            : $request->jabatan;

        $detail->update([
            'jabatan' => $jabatan,
            'status_keanggotaan' => $request->status_keanggotaan,
        ]);

        return redirect()
            ->route('warek.dataorganisasi.show', $detail->id_organisasi)
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    // ============================
    // DELETE ANGGOTA
    // ============================
    public function destroy($id)
    {
        $detail = DetailOrganisasiMahasiswa::findOrFail($id);

        $orgId = $detail->id_organisasi;

        $detail->delete();

        return redirect()
            ->route('warek.dataorganisasi.show', $orgId)
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
