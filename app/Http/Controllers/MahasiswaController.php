<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        $mahasiswas = Mahasiswa::latest()->paginate(10);
        return view('mahasiswas.index', compact('mahasiswas'));
    }

    public function create(): View
    {
        return view('mahasiswas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'temp_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'sex' => 'required',
            'agama' => 'required',
            'hobi' => 'required',
            'angkatan' => 'required',
            'email' => 'required|email'
        ]);

        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswas.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($id): View
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswas.show', compact('mahasiswa'));
    }

    public function edit($id): View
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswas.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswas.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect()->route('mahasiswas.index')->with('success', 'Data berhasil dihapus.');
    }
}
