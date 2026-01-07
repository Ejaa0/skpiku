<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemanController extends Controller
{
    // ====================== HALAMAN TEMAN ======================
    public function index()
    {
        $nim = session('user_nim');

        // Ambil teman online/offline
        $temanOnline = DB::table('temans')
            ->join('mahasiswas', 'mahasiswas.nim', '=', 'temans.teman_nim')
            ->where('temans.mahasiswa_nim', $nim)
            ->select('mahasiswas.nim', 'mahasiswas.nama', 'mahasiswas.online')
            ->get();

        // Notifikasi permintaan teman
        $notifikasi = DB::table('teman_requests')
            ->where('penerima_nim', $nim)
            ->where('status', 'pending')
            ->get();

        return view('tampilan_mahasiswa.index', compact('temanOnline', 'notifikasi'));
    }

    // ====================== LIST TEMAN ONLINE (JSON) ======================
    public function listOnline()
    {
        $nim = session('user_nim');

        $temanOnline = DB::table('temans')
            ->join('mahasiswas', 'mahasiswas.nim', '=', 'temans.teman_nim')
            ->where('temans.mahasiswa_nim', $nim)
            ->select('mahasiswas.nim', 'mahasiswas.nama', 'mahasiswas.online')
            ->get();

        return response()->json($temanOnline);
    }

    // ====================== TAMBAH TEMAN ======================
    public function store(Request $request)
    {
        $pengirim = session('user_nim');
        $penerima = $request->nim_tujuan;

        // Cek apakah permintaan sudah ada
        $exists = DB::table('teman_requests')
            ->where('pengirim_nim', $pengirim)
            ->where('penerima_nim', $penerima)
            ->where('status', 'pending')
            ->exists();

        if ($exists) {
            return response()->json(['error'=>'Permintaan teman sudah dikirim'], 400);
        }

        DB::table('teman_requests')->insert([
            'pengirim_nim' => $pengirim,
            'penerima_nim' => $penerima,
            'status'       => 'pending',
            'created_at'   => now(),
            'updated_at'   => now()
        ]);

        return response()->json(['success'=>'Permintaan teman dikirim']);
    }

    // ====================== TERIMA / TOLAK PERMINTAAN ======================
    public function respond($id, $action)
{
    $requestData = DB::table('teman_requests')->where('id', $id)->first();
    if(!$requestData){
        return response()->json(['error'=>'Request tidak ditemukan'], 404);
    }

    if(!in_array($action, ['accepted','rejected'])){
        return response()->json(['error'=>'Action tidak valid'], 400);
    }

    // Update status permintaan
    DB::table('teman_requests')->where('id', $id)->update(['status' => $action, 'updated_at'=>now()]);

    if($action === 'accepted'){
        // Tambahkan teman dua arah
        DB::table('temans')->insert([
            ['mahasiswa_nim'=>$requestData->pengirim_nim,'teman_nim'=>$requestData->penerima_nim,'created_at'=>now(),'updated_at'=>now()],
            ['mahasiswa_nim'=>$requestData->penerima_nim,'teman_nim'=>$requestData->pengirim_nim,'created_at'=>now(),'updated_at'=>now()]
        ]);
    }

    return response()->json(['success'=>'Permintaan berhasil '.$action]);
}


    // ====================== HAPUS TEMAN ======================
    public function destroy($temanNim)
    {
        $nim = session('user_nim');

        // Hapus teman dua arah
        DB::table('temans')
            ->where(function($q) use ($nim, $temanNim){
                $q->where('mahasiswa_nim', $nim)->where('teman_nim', $temanNim);
            })
            ->orWhere(function($q) use ($nim, $temanNim){
                $q->where('mahasiswa_nim', $temanNim)->where('teman_nim', $nim);
            })
            ->delete();

        return response()->json(['success'=>'Teman berhasil dihapus']);
    }
}
