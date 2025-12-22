<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use Illuminate\Support\Facades\DB;

class OrganisasiSelfController extends Controller
{
    // ================== INDEX ==================
    public function index(Request $request)
    {
        $query = Organisasi::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_organisasi', 'like', '%' . $request->search . '%');
        }
        $organisasi = $query->get();
        $search = $request->search ?? '';
        return view('tampilan_organisasi.organisasi.index', compact('organisasi', 'search'));
    }

    // ================== CREATE ==================
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

    // ================== EDIT ORGANISASI ==================
    public function edit($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        return view('tampilan_organisasi.organisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, $id)
    {
        $org = Organisasi::findOrFail($id);

        $request->validate([
            'nama_organisasi' => 'required|string|max:255',
        ]);

        $org->update([
            'nama_organisasi' => $request->nama_organisasi,
        ]);

        return redirect()->route('organisasi.self.index')
                         ->with('success', 'Data organisasi berhasil diperbarui!');
    }

    // ================== SHOW ==================
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

    // ================== DELETE ORGANISASI ==================
    public function destroy($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $organisasi->delete();
        return redirect()->route('organisasi.self.index')->with('success', 'Organisasi berhasil dihapus.');
    }

    // ================== TAMBAH ANGGOTA ==================
    public function tambahAnggota($id)
    {
        $organisasi = Organisasi::findOrFail($id);

        $anggotaExisting = DB::table('detail_organisasi_mahasiswa')
            ->where('id_organisasi', $id)
            ->pluck('nim')
            ->toArray();

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
            'jabatan_lainnya' => 'nullable|string|max:255',
            'status_keanggotaan' => 'required|string',
            'status_lainnya' => 'nullable|string|max:255',
        ]);

        $organisasi = Organisasi::findOrFail($id_organisasi);
        $mahasiswa = DB::table('mahasiswas')->where('nim', $request->mahasiswa_nim)->first();

        $jabatan = $request->jabatan === 'lainnya' ? $request->jabatan_lainnya : $request->jabatan;
        $status  = $request->status_keanggotaan === 'lainnya' ? $request->status_lainnya : $request->status_keanggotaan;

        DB::table('detail_organisasi_mahasiswa')->insert([
            'id_organisasi' => $organisasi->id_organisasi,
            'nama_organisasi' => $organisasi->nama_organisasi,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'jabatan' => $jabatan,
            'status_keanggotaan' => $status,
        ]);

        return redirect()->route('organisasi.self.show', $id_organisasi)
                         ->with('success', 'Anggota berhasil ditambahkan.');
    }

    // ================== EDIT ANGGOTA ==================
    public function editAnggota($id_organisasi, $nim)
    {
        $anggota = DB::table('detail_organisasi_mahasiswa')
            ->where('id_organisasi', $id_organisasi)
            ->where('nim', $nim)
            ->first();

        if (!$anggota) {
            return redirect()->route('organisasi.self.show', $id_organisasi)
                             ->with('error', 'Anggota tidak ditemukan.');
        }

        return view('tampilan_organisasi.organisasi.edit', [
            'anggota' => $anggota,
            'id_organisasi' => $id_organisasi
        ]);
    }

    public function updateAnggota(Request $request, $id_organisasi, $nim)
    {
        $request->validate([
            'jabatan' => 'nullable|string|max:255',
            'jabatan_lainnya' => 'nullable|string|max:255',
            'status_keanggotaan' => 'required|string',
            'status_lainnya' => 'nullable|string|max:255',
        ]);

        $jabatan = $request->jabatan === 'lainnya' ? $request->jabatan_lainnya : $request->jabatan;
        $status  = $request->status_keanggotaan === 'lainnya' ? $request->status_lainnya : $request->status_keanggotaan;

        DB::table('detail_organisasi_mahasiswa')
            ->where('id_organisasi', $id_organisasi)
            ->where('nim', $nim)
            ->update([
                'jabatan' => $jabatan,
                'status_keanggotaan' => $status,
            ]);

        return redirect()->route('organisasi.self.show', $id_organisasi)
                         ->with('success', 'Data anggota berhasil diperbarui.');
    }

    // ================== DELETE ANGGOTA ==================
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
