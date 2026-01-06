<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemanController extends Controller
{
    // Tampilkan daftar teman dan notifikasi
    public function index()
    {
        $nim = session('user_nim'); // NIM mahasiswa login

        // Daftar teman
        $teman = DB::table('temans')
            ->where('mahasiswa_nim', $nim)
            ->orWhere('teman_nim', $nim)
            ->get();

        // Notifikasi permintaan teman pending
        $notifikasi = DB::table('teman_requests')
            ->where('penerima_nim', $nim)
            ->where('status', 'pending')
            ->get();

        return view('tampilan_mahasiswa.index', compact('teman', 'notifikasi'));
    }

    // Kirim permintaan teman
    public function store(Request $request)
    {
        $pengirim = session('user_nim'); // NIM mahasiswa login
        $penerima = $request->nim;

        if (!$pengirim) {
            return redirect()->back()->with('error', 'Session NIM tidak ditemukan!');
        }

        DB::table('teman_requests')->insert([
            'pengirim_nim' => $pengirim,
            'penerima_nim' => $penerima,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Permintaan teman dikirim!');
    }

    // Terima / Tolak permintaan teman
    public function respond(Request $request, $id, $action)
    {
        $requestData = DB::table('teman_requests')->where('id', $id)->first();
        if (!$requestData) {
            return back()->with('error', 'Request tidak ditemukan!');
        }

        // Update status permintaan
        DB::table('teman_requests')->where('id', $id)->update(['status' => $action]);

        if ($action === 'accepted') {
            // Masukkan ke tabel teman sesuai kolom yang benar
            DB::table('temans')->insert([
                'mahasiswa_nim' => $requestData->pengirim_nim,
                'teman_nim'     => $requestData->penerima_nim,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }

        return back()->with('success', 'Permintaan berhasil ' . $action);
    }

    // Hapus teman
    public function destroy($id)
    {
        DB::table('temans')->where('id', $id)->delete();
        return back()->with('success', 'Teman berhasil dihapus!');
    }
}
