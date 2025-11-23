<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use App\Models\DetailOrganisasiMahasiswa;

class WarekOrganisasiController extends Controller
{
    // Tampilkan daftar organisasi
    public function index(Request $request)
    {
        $query = Organisasi::query();

        if ($request->has('q') && $request->q != '') {
            $query->where('nama_organisasi', 'like', '%'.$request->q.'%');
        }

        // Gunakan paginate, misal 10 data per halaman
        $organisasis = $query->orderBy('id_organisasi', 'desc')->paginate(10);

        return view('warek.dataorganisasi.index', compact('organisasis'));
    }

    // Tampilkan detail organisasi beserta anggota
    public function show($id)
    {
        // Ambil data organisasi
        $organisasi = Organisasi::findOrFail($id);

        // Ambil semua anggota organisasi
        $anggota = DetailOrganisasiMahasiswa::where('id_organisasi', $id)->get();

        return view('warek.dataorganisasi.show', compact('organisasi', 'anggota'));
    }
}
