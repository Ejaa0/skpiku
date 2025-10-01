<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class KegiatanSelfController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        if ($request->filled('search')) {
            $query->where('nama_kegiatan', 'like', '%' . $request->search . '%');
        }

        $kegiatans = $query->orderBy('tanggal_kegiatan', 'desc')->paginate(10)->withQueryString();

        return view('tampilan_kegiatan.kegiatan.index', [
            'kegiatans' => $kegiatans
        ]);
    }

    public function create()
    {
        return view('tampilan_kegiatan.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'tanggal_kegiatan' => 'required|date',
            'nama_kegiatan' => 'required',
            'deskripsi' => 'nullable'
        ]);

        Kegiatan::create($request->all());

        return redirect()->route('kegiatan-self.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('tampilan_kegiatan.kegiatan.show', compact('kegiatan'));
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('tampilan_kegiatan.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'tanggal_kegiatan' => 'required|date',
            'nama_kegiatan' => 'required',
            'deskripsi' => 'nullable'
        ]);

        $kegiatan->update($request->all());

        return redirect()->route('kegiatan-self.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('kegiatan-self.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
