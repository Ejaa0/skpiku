<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use App\Models\DetailOrganisasiMahasiswa;

class WarekOrganisasiController extends Controller
{
    // =======================
    // ORGANISASI
    // =======================
    public function index(Request $request)
    {
        $query = Organisasi::query();
        if ($request->filled('q')) {
            $query->where('nama_organisasi', 'like', '%' . $request->q . '%');
        }
        $organisasis = $query->orderBy('id_organisasi', 'desc')->paginate(10);
        return view('warek.dataorganisasi.index', compact('organisasis'));
    }

    public function show($id_organisasi)
    {
        $organisasi = Organisasi::findOrFail($id_organisasi);
        $anggota = DetailOrganisasiMahasiswa::where('id_organisasi', $id_organisasi)->get();
        return view('warek.dataorganisasi.show', compact('organisasi', 'anggota'));
    }

    public function editOrganisasi($id_organisasi)
    {
        $organisasi = Organisasi::findOrFail($id_organisasi);
        return view('warek.dataorganisasi.edit_organisasi', compact('organisasi'));
    }

    public function updateOrganisasi(Request $request, $id_organisasi)
    {
        $request->validate(['nama_organisasi' => 'required|string|max:255']);
        $organisasi = Organisasi::findOrFail($id_organisasi);
        $organisasi->update(['nama_organisasi' => $request->nama_organisasi]);

        return redirect()->route('warek.dataorganisasi.index')
            ->with('success', 'Data organisasi berhasil diperbarui!');
    }

    // =======================
    // ANGGOTA / DETAIL MAHASISWA
    // =======================
    public function editAnggota($id_detail)
    {
        $detail = DetailOrganisasiMahasiswa::findOrFail($id_detail);
        return view('warek.dataorganisasi.edit_anggota', compact('detail'));
    }

    public function updateAnggota(Request $request, $id_detail)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
        ]);

        $detail = DetailOrganisasiMahasiswa::findOrFail($id_detail);
        $detail->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
        ]);

        return redirect()->route('warek.dataorganisasi.show', $detail->id_organisasi)
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroyOrganisasi($id_organisasi)
    {
        Organisasi::findOrFail($id_organisasi)->delete();
        return redirect()->back()->with('success', 'Data organisasi berhasil dihapus!');
    }

    public function destroyAnggota($id_detail)
    {
        $detail = DetailOrganisasiMahasiswa::findOrFail($id_detail);
        $detail->delete();
        return redirect()->back()->with('success', 'Data anggota berhasil dihapus!');
    }
}
