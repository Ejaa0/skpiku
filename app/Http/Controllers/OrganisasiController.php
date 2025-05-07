<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    public function index()
    {
        $organisasi = Organisasi::all();
        return view('organisasi.index', compact('organisasi'));
    }

    public function create()
    {
        return view('organisasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string',
            'id_kegiatan' => 'required|integer',
            'nama_kegiatan' => 'required|string',
            'absensi' => 'required|string',
        ]);

        Organisasi::create($validated);

        return redirect()->route('organisasi.index');
    }

    public function edit($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        return view('organisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nim' => 'required|string',
            'id_kegiatan' => 'required|integer',
            'nama_kegiatan' => 'required|string',
            'absensi' => 'required|string',
        ]);

        $organisasi = Organisasi::findOrFail($id);
        $organisasi->update($validated);

        return redirect()->route('organisasi.index');
    }

    public function destroy($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $organisasi->delete();

        return redirect()->route('organisasi.index');
    }
}
