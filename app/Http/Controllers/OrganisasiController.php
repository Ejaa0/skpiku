<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use App\Models\DetailOrganisasiMahasiswa;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    // Tampilkan semua organisasi
    public function index()
    {
        $organisasi = Organisasi::all();
        return view('organisasi.index', compact('organisasi'));
    }

    // Tampilkan form tambah anggota (lama - lewat query)
    public function create(Request $request)
    {
        $id_organisasi = $request->query('id_organisasi');
        $organisasi = Organisasi::where('id_organisasi', $id_organisasi)->firstOrFail();

        return view('detail_organisasi_mahasiswa.create', [
            'id_organisasi' => $organisasi->id_organisasi,
            'nama_organisasi' => $organisasi->nama_organisasi
        ]);
    }

    // Simpan data anggota organisasi (versi lama)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_organisasi' => 'required|string',
            'mahasiswa_nim' => 'required|string',
            'jabatan' => 'required|string',
            'status_keanggotaan' => 'required|in:aktif,nonaktif',
        ]);

        DetailOrganisasiMahasiswa::create($validated);

        return redirect()->route('organisasi.index')->with('success', 'Data anggota organisasi berhasil ditambahkan.');
    }

    // Tampilkan form tambah organisasi baru
    public function createOrganisasi()
    {
        return view('organisasi.create');
    }

    // Simpan data organisasi baru
    public function storeOrganisasi(Request $request)
    {
        $validated = $request->validate([
            'id_organisasi' => 'required|string|unique:organisasi,id_organisasi',
            'nama_organisasi' => 'required|string',
        ]);

        Organisasi::create($validated);

        return redirect()->route('organisasi.index')->with('success', 'Organisasi baru berhasil ditambahkan.');
    }

    // Tampilkan form edit organisasi
    public function edit($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        return view('organisasi.edit', compact('organisasi'));
    }

    // Simpan perubahan data organisasi
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_organisasi' => 'required|string',
            'nama_organisasi' => 'required|string',
        ]);

        $organisasi = Organisasi::findOrFail($id);
        $organisasi->update($validatedData);

        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil diperbarui.');
    }

    // Hapus organisasi
    public function destroy($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $organisasi->delete();

        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil dihapus.');
    }

    // Tampilkan detail organisasi dan anggotanya
    public function show($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $detailMahasiswa = DetailOrganisasiMahasiswa::where('id_organisasi', $organisasi->id_organisasi)->get();

        return view('organisasi.show', compact('organisasi', 'detailMahasiswa'));
    }

    // ✅ Form tambah anggota organisasi (versi lengkap & lebih baik)
    public function formTambahAnggota($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $mahasiswa = Mahasiswa::all(); // Ambil semua mahasiswa

        return view('organisasi.tambah_anggota', compact('organisasi', 'mahasiswa'));
    }

    // ✅ Simpan anggota organisasi dari form versi lengkap
    public function simpanAnggota(Request $request, $id)
    {
        $validated = $request->validate([
            'mahasiswa_nim' => 'required|string|exists:mahasiswa,nim',
            'jabatan' => 'required|string',
            'status_keanggotaan' => 'required|in:aktif,nonaktif',
        ]);

        DetailOrganisasiMahasiswa::create([
            'id_organisasi' => Organisasi::findOrFail($id)->id_organisasi,
            'mahasiswa_nim' => $validated['mahasiswa_nim'],
            'jabatan' => $validated['jabatan'],
            'status_keanggotaan' => $validated['status_keanggotaan'],
        ]);

        return redirect()->route('organisasi.show', $id)->with('success', 'Anggota berhasil ditambahkan.');
    }
}
