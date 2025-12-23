<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenentuanPoin;

class WarekPenentuanPoinController extends Controller
{
    public function index()
    {
        $penentuanPoin = PenentuanPoin::orderBy('id', 'asc')->get();
        return view('warek.penentuan_poin.index', compact('penentuanPoin'));
    }

    public function create()
    {
        return view('warek.penentuan_poin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'poin'       => 'required|integer|min:0',
        ]);

        PenentuanPoin::create([
            'keterangan' => $request->keterangan,
            'poin'       => $request->poin,
        ]);

        return redirect()
            ->route('warek.penentuanpoin.index')
            ->with('success', 'Penentuan poin berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $poin = PenentuanPoin::findOrFail($id);
        return view('warek.penentuan_poin.edit', compact('poin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'poin'       => 'required|integer|min:0',
        ]);

        $poin = PenentuanPoin::findOrFail($id);
        $poin->update([
            'keterangan' => $request->keterangan,
            'poin'       => $request->poin,
        ]);

        return redirect()
            ->route('warek.penentuanpoin.index')
            ->with('success', 'Penentuan poin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        PenentuanPoin::findOrFail($id)->delete();

        return redirect()
            ->route('warek.penentuanpoin.index')
            ->with('success', 'Penentuan poin berhasil dihapus.');
    }
}
