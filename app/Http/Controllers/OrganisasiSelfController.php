<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use Illuminate\Support\Facades\DB;

class OrganisasiSelfController extends Controller
{
    public function index(Request $request)
    {
        $query = Organisasi::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_organisasi', 'like', '%'.$request->search.'%');
        }

        $organisasi = $query->get();
        $search = $request->search ?? '';

        return view('tampilan_organisasi.organisasi.index', compact('organisasi', 'search'));
    }

    public function create()
    {
        return view('tampilan_organisasi.organisasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_organisasi' => 'required|string|max:255',
        ]);

        Organisasi::create([
            'nama_organisasi' => $request->nama_organisasi,
        ]);

        return redirect()->route('organisasi.self.index')->with('success', 'Organisasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        return view('tampilan_organisasi.organisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, $id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $request->validate([
            'nama_organisasi' => 'required|string|max:255',
        ]);

        $organisasi->update(['nama_organisasi' => $request->nama_organisasi]);

        return redirect()->route('organisasi.self.index')->with('success', 'Data organisasi berhasil diperbarui.');
    }

    public function show($id)
    {
        $organisasi = Organisasi::findOrFail($id);

        $mahasiswa = DB::table('detail_organisasi_mahasiswa as dom')
            ->join('mahasiswas as m', 'dom.nim', '=', 'm.nim')
            ->where('dom.id_organisasi', $id)
            ->select('dom.*', 'm.nama')
            ->get();

        return view('tampilan_organisasi.organisasi.show', compact('organisasi', 'mahasiswa'));
    }

    public function destroy($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $organisasi->delete();

        return redirect()->route('organisasi.self.index')->with('success', 'Organisasi berhasil dihapus.');
    }

    public function tambahAnggota($id)
    {
        $organisasi = Organisasi::findOrFail($id);

        // Ambil nim mahasiswa yang sudah menjadi anggota
        $anggotaExisting = DB::table('detail_organisasi_mahasiswa')
            ->where('id_organisasi', $id)
            ->pluck('nim')
            ->toArray();

        // Ambil seluruh mahasiswa yang belum menjadi anggota
        $mahasiswa = DB::table('mahasiswas')
            ->whereNotIn('nim', $anggotaExisting)
            ->get();

        return view('tampilan_organisasi.organisasi.tambah_anggota', compact('organisasi', 'mahasiswa'));
    }

    public function storeAnggota(Request $request, $id_organisasi)
    {
        $request->validate([
            'mahasiswa_nim' => 'required|exists:mahasiswas,nim',
            'jabatan' => 'nullable|string|max:255',
            'status_keanggotaan' => 'required|in:aktif,tidak aktif',
        ]);

        // Ambil data organisasi dan mahasiswa
        $organisasi = DB::table('organisasi')->where('id_organisasi', $id_organisasi)->first();
        $mahasiswa = DB::table('mahasiswas')->where('nim', $request->mahasiswa_nim)->first();

        DB::table('detail_organisasi_mahasiswa')->insert([
            'id_organisasi' => $id_organisasi,
            'nama_organisasi' => $organisasi->nama_organisasi,
            'nim' => $request->mahasiswa_nim,
            'nama' => $mahasiswa->nama,
            'jabatan' => $request->jabatan,
            'status_keanggotaan' => $request->status_keanggotaan,
        ]);

        return redirect()->route('organisasi.self.show', $id_organisasi)
                         ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function editAnggota($id_organisasi, $nim)
    {
        $organisasi = Organisasi::findOrFail($id_organisasi);

        $anggota = DB::table('detail_organisasi_mahasiswa')
            ->join('mahasiswas', 'detail_organisasi_mahasiswa.nim', '=', 'mahasiswas.nim')
            ->where('detail_organisasi_mahasiswa.id_organisasi', $id_organisasi)
            ->where('detail_organisasi_mahasiswa.nim', $nim)
            ->select('detail_organisasi_mahasiswa.*', 'mahasiswas.nama')
            ->first();

        return view('tampilan_organisasi.organisasi.edit_anggota', compact('organisasi', 'anggota'));
    }

    public function updateAnggota(Request $request, $id_organisasi, $nim)
    {
        $request->validate([
            'jabatan' => 'nullable|string|max:255',
            'status_keanggotaan' => 'required|in:aktif,tidak aktif',
        ]);

        DB::table('detail_organisasi_mahasiswa')
            ->where('id_organisasi', $id_organisasi)
            ->where('nim', $nim)
            ->update([
                'jabatan' => $request->jabatan,
                'status_keanggotaan' => $request->status_keanggotaan,
            ]);

        return redirect()->route('organisasi.self.show', $id_organisasi)
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function deleteAnggota($id_organisasi, $nim)
    {
        DB::table('detail_organisasi_mahasiswa')
            ->where('id_organisasi', $id_organisasi)
            ->where('nim', $nim)
            ->delete();

        return redirect()->route('organisasi.self.show', $id_organisasi)
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
