<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoinMahasiswa;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class PoinMahasiswaController extends Controller
{
    /**
     * Menampilkan daftar poin mahasiswa.
     */
    public function index(Request $request)
    {
        // Update poin semua mahasiswa dulu sebelum ambil data untuk tampil
        $mahasiswas = DB::table('mahasiswas')->pluck('nim');

        foreach ($mahasiswas as $nim) {
            $this->updatePoinMahasiswa($nim);
        }

        $search = $request->input('search');

        // Ambil semua data poin mahasiswa dan filter jika ada pencarian
        $mahasiswas = PoinMahasiswa::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%$search%")
                         ->orWhere('nim', 'like', "%$search%");
        })
        ->orderByDesc('poin') // urutkan dari poin tertinggi
        ->get();

        return view('poin.index', compact('mahasiswas', 'search'));
    }

    /**
     * Hitung & update poin mahasiswa berdasarkan nim.
     */
    private function updatePoinMahasiswa($nim)
    {
        $nama = DB::table('mahasiswas')->where('nim', $nim)->value('nama');

        if (!$nama) {
            $nama = DB::table('detail_kegiatan_mahasiswa')->where('mahasiswa_nim', $nim)->value('nama')
                ?? DB::table('detail_organisasi_mahasiswa')->where('nim', $nim)->value('nama');
        }

        if (!$nama) return false;

        $jumlahKegiatan = DB::table('detail_kegiatan_mahasiswa')
            ->where('mahasiswa_nim', $nim)
            ->count();

        $jumlahOrganisasi = DB::table('detail_organisasi_mahasiswa')
            ->where('nim', $nim)
            ->count();

        // Default poin: 100 per kegiatan, 150 per organisasi
        $totalPoin = ($jumlahKegiatan * 100) + ($jumlahOrganisasi * 150);

        PoinMahasiswa::updateOrCreate(
            ['nim' => $nim],
            ['nama' => $nama, 'poin' => $totalPoin]
        );

        return true;
    }

    /**
     * Menampilkan detail poin mahasiswa.
     */
    /**
 * Menampilkan detail poin mahasiswa.
 */
public function show($nim)
{
    // Ambil data mahasiswa
    $mahasiswa = Mahasiswa::findOrFail($nim);

    // Ambil semua kegiatan mahasiswa (tanpa join, karena tidak ada kegiatan_id)
    $kegiatans = DB::table('detail_kegiatan_mahasiswa')
        ->where('mahasiswa_nim', $nim)
        ->get()
        ->map(function ($item) {
            // kalau di tabel ada deskripsi/nama, tampilkan, kalau tidak ya kosong
            $item->nama_kegiatan = $item->nama_kegiatan ?? 'Kegiatan';
            $item->poin_kegiatan = 100; // default poin
            return $item;
        });

    // Ambil semua organisasi mahasiswa (tanpa join, kalau memang tidak ada organisasi_id)
    $organisasis = DB::table('detail_organisasi_mahasiswa')
        ->where('nim', $nim)
        ->get()
        ->map(function ($item) {
            $item->nama_organisasi = $item->nama_organisasi ?? 'Organisasi';
            $item->poin_organisasi = 250; // default poin
            return $item;
        });

    // Hitung total poin
    $totalPoin = $kegiatans->sum('poin_kegiatan') + $organisasis->sum('poin_organisasi');

    // Tambahkan atribut poin ke mahasiswa
    $mahasiswa->poin = $totalPoin;

    return view('poin.show', [
        'poin' => $mahasiswa,
        'kegiatans' => $kegiatans,
        'organisasis' => $organisasis,
    ]);
}

    /**
     * Simpan atau update poin mahasiswa berdasarkan nim.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
        ], [
            'nim.required' => 'Pilih mahasiswa terlebih dahulu.',
            'nim.string'   => 'Format NIM tidak valid.',
            'nim.max'      => 'NIM maksimal 20 karakter.',
        ]);

        $nim = $request->nim;

        $nama = DB::table('mahasiswas')->where('nim', $nim)->value('nama');

        if (!$nama) {
            $nama = DB::table('detail_kegiatan_mahasiswa')->where('mahasiswa_nim', $nim)->value('nama')
                ?? DB::table('detail_organisasi_mahasiswa')->where('nim', $nim)->value('nama');
        }

        if (!$nama) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $jumlahKegiatan = DB::table('detail_kegiatan_mahasiswa')->where('mahasiswa_nim', $nim)->count();
        $jumlahOrganisasi = DB::table('detail_organisasi_mahasiswa')->where('nim', $nim)->count();

        $totalPoin = ($jumlahKegiatan * 100) + ($jumlahOrganisasi * 150);

        PoinMahasiswa::updateOrCreate(
            ['nim' => $nim],
            ['nama' => $nama, 'poin' => $totalPoin]
        );

        return redirect()->route('poin.index')->with('success', 'Poin mahasiswa berhasil disimpan.');
    }

    /**
     * Hapus data poin mahasiswa.
     */
    public function destroy($nim)
    {
        $poin = PoinMahasiswa::findOrFail($nim);
        $poin->delete();

        return redirect()->route('poin.index')->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Ambil data poin terbaru untuk API / JSON.
     */
    public function getAllLatestPoin()
    {
        $data = PoinMahasiswa::select('nim', 'poin')->get();
        return response()->json($data);
    }

    /**
     * Export data ke CSV.
     */
    public function export()
    {
        $mahasiswas = PoinMahasiswa::orderByDesc('poin')->get();

        $filename = 'poin_mahasiswa_' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['NIM', 'Nama', 'Poin'];

        $callback = function() use ($mahasiswas, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($mahasiswas as $mhs) {
                fputcsv($file, [$mhs->nim, $mhs->nama, $mhs->poin]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
