<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use App\Models\DetailOrganisasiMahasiswa;

class WarekOrganisasiController extends Controller
{
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

    public function edit($id_organisasi)
    {
        $organisasi = Organisasi::findOrFail($id_organisasi);
        return view('warek.dataorganisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, $id_organisasi)
    {
        $request->validate(['nama_organisasi' => 'required|string|max:255']);
        $organisasi = Organisasi::findOrFail($id_organisasi);
        $organisasi->update(['nama_organisasi' => $request->nama_organisasi]);

        return redirect()->route('warek.dataorganisasi.index')
            ->with('success', 'Data organisasi berhasil diperbarui!');
    }

    public function destroy($id_organisasi)
    {
        Organisasi::findOrFail($id_organisasi)->delete();
        return redirect()->back()->with('success', 'Data organisasi berhasil dihapus!');
    }
}
