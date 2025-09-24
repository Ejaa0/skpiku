<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;

class OrganisasiSelfController extends Controller
{
    public function index()
    {
        $organisasi = Organisasi::all();
        return view('tampilan_organisasi.organisasi.index', compact('organisasi'));
    }

    public function create()
    {
        return view('tampilan_organisasi.organisasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        Organisasi::create($request->all());
        return redirect()->route('organisasi.self.index')->with('success', 'Organisasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        return view('tampilan_organisasi.organisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $organisasi = Organisasi::findOrFail($id);
        $organisasi->update($request->all());
        return redirect()->route('organisasi.self.index')->with('success', 'Organisasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $organisasi->delete();
        return redirect()->route('organisasi.self.index')->with('success', 'Organisasi berhasil dihapus.');
    }
}
