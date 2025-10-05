<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use App\Models\DetailOrganisasiMahasiswa;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrganisasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Organisasi::query();

        if ($request->has('search') && $request->search !== null) {
            $search = $request->search;
            $query->where('nama_organisasi', 'like', '%' . $search . '%');
        }

        $organisasi = $query->paginate(10);

        return view('organisasi.index', compact('organisasi'));
    }

    public function create()
    {
        return view('organisasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_organisasi' => 'required|string|unique:organisasi,id_organisasi',
            'nama_organisasi' => 'required|string|max:255',
        ]);

        Organisasi::create($validated);

        return redirect()->route('organisasi.index')->with('success', 'Organisasi baru berhasil ditambahkan.');
    }

    public function edit(string $id_organisasi)
    {
        $organisasi = Organisasi::where('id_organisasi', $id_organisasi)->firstOrFail();
        return view('organisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, string $id_organisasi)
    {
        $validated = $request->validate([
            'nama_organisasi' => 'required|string|max:255',
        ]);

        $organisasi = Organisasi::where('id_organisasi', $id_organisasi)->firstOrFail();
        $organisasi->nama_organisasi = $validated['nama_organisasi'];
        $organisasi->save();

        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil diperbarui.');
    }

    public function destroy(string $id_organisasi)
    {
        $organisasi = Organisasi::where('id_organisasi', $id_organisasi)->firstOrFail();

        // Hapus semua data keanggotaan mahasiswa terkait organisasi ini
        DetailOrganisasiMahasiswa::where('id_organisasi', $id_organisasi)->delete();

        // Hapus organisasi
        $organisasi->delete();

        return redirect()->route('organisasi.index')->with('success', 'Organisasi dan data anggotanya berhasil dihapus.');
    }

    public function show(string $id_organisasi)
    {
        $organisasi = Organisasi::where('id_organisasi', $id_organisasi)->firstOrFail();

        $detailMahasiswa = DetailOrganisasiMahasiswa::where('id_organisasi', $organisasi->id_organisasi)
            ->join('mahasiswas', 'detail_organisasi_mahasiswa.nim', '=', 'mahasiswas.nim')
            ->select(
                'detail_organisasi_mahasiswa.*',
                'mahasiswas.nama'
            )
            ->get();

        return view('organisasi.show', compact('organisasi', 'detailMahasiswa'));
    }

    public function formTambahAnggota(string $id_organisasi)
    {
        $organisasi = Organisasi::where('id_organisasi', $id_organisasi)->firstOrFail();
        $mahasiswa = Mahasiswa::all();

        return view('organisasi.tambah_anggota', compact('organisasi', 'mahasiswa'));
    }

    public function simpanAnggota(Request $request, string $id_organisasi)
    {
        $validated = $request->validate([
            'nim' => 'required|string|exists:mahasiswas,nim',
            'jabatan' => 'required|string|max:100',
            'status_keanggotaan' => 'required|in:aktif,nonaktif',
        ]);

        DetailOrganisasiMahasiswa::create([
            'id_organisasi' => $id_organisasi,
            'nim' => $validated['nim'],
            'jabatan' => $validated['jabatan'],
            'status_keanggotaan' => $validated['status_keanggotaan'],
        ]);

        return redirect()->route('organisasi.show', $id_organisasi)
                        ->with('success', 'Anggota berhasil ditambahkan.');
    }
    public function deleteAnggota($id_organisasi, $nim)
{
    \DB::table('detail_organisasi_mahasiswa')
        ->where('id_organisasi', $id_organisasi)
        ->where('nim', $nim)
        ->delete();

    return redirect()
        ->route('organisasi.self.show', $id_organisasi)
        ->with('success', 'Anggota berhasil dihapus.');
}

}
