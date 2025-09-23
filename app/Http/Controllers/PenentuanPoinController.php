<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenentuanPoin;

class PenentuanPoinController extends Controller
{
    // Tampilkan daftar penentuan poin
    public function index()
    {
        $poin = PenentuanPoin::orderByDesc('id')->paginate(10);
        return view('penentuan_poin.index', compact('poin'));
    }

    // Tampilkan form tambah data (create)
    public function create()
    {
        return view('penentuan_poin.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'poin' => 'required|integer|min:0',
        ]);

        PenentuanPoin::create([
            'keterangan' => $request->keterangan,
            'poin' => $request->poin,
        ]);

        return redirect()->route('penentuan_poin.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        // Pastikan variabel sama dengan yang dipakai di Blade
        $penentuan_poin = PenentuanPoin::findOrFail($id);
        return view('penentuan_poin.edit', compact('penentuan_poin'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'poin' => 'required|integer|min:0',
        ]);

        $penentuan_poin = PenentuanPoin::findOrFail($id);
        $penentuan_poin->update([
            'keterangan' => $request->keterangan,
            'poin' => $request->poin,
        ]);

        return redirect()->route('penentuan_poin.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $penentuan_poin = PenentuanPoin::findOrFail($id);
        $penentuan_poin->delete();

        return redirect()->route('penentuan_poin.index')->with('success', 'Data berhasil dihapus.');
    }
}
