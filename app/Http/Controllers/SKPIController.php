<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Skpi;

class SKPIController extends Controller
{
    // ===============================
    // TAMPIL FORM SKPI
    // ===============================
    public function index()
    {
        // 🔐 Cek login mahasiswa
        if (!session('is_logged_in') || session('user_role') !== 'mahasiswa') {
            return redirect()->route('login');
        }

        // Ambil NIM dari email (misal 7 digit)
        $email = session('user_email');
        $nim   = substr($email, 0, 7);

        // ===============================
        // KEGIATAN MAHASISWA
        // ===============================
        $kegiatan = DB::table('detail_kegiatan_mahasiswa as dkm')
            ->join('kegiatans as k', 'dkm.kegiatan_id_ref', '=', 'k.id')
            ->where('dkm.mahasiswa_nim', $nim)
            ->pluck('k.nama_kegiatan'); // langsung array sederhana

        // ===============================
        // ORGANISASI MAHASISWA
        // ===============================
        $organisasi = DB::table('detail_organisasi_mahasiswa')
            ->where('nim', $nim)
            ->pluck('nama_organisasi');

        // ===============================
        // HITUNG POIN
        // ===============================
        $poinKegiatan   = $kegiatan->count() * 100;
        $poinOrganisasi = $organisasi->count() * 250;
        $totalPoin      = $poinKegiatan + $poinOrganisasi;

        return view('skpi.form', compact(
            'nim',
            'kegiatan',
            'organisasi',
            'poinKegiatan',
            'poinOrganisasi',
            'totalPoin'
        ));
    }

    // ===============================
    // GENERATE SKPI (PDF)
    // ===============================
    public function generate(Request $request)
    {
        $validated = $this->validateSKPI($request);

        $skpi = Skpi::updateOrCreate(
            ['nim' => $validated['nim']],
            $validated
        );

        $base64Logo = $this->getBase64Logo('Logo-Unai.png');
        $garudaBase64 = $this->getBase64Logo('garuda.png');

        // DECODE KEGIATAN & ORGANISASI
        $kegiatanArray   = json_decode($request->kegiatan_list, true) ?? [];
        $organisasiArray = json_decode($request->organisasi_list, true) ?? [];

        $pdf = Pdf::loadView('exports.form_skpi', [
            'skpi'         => $skpi,
            'kegiatan'     => $kegiatanArray,
            'organisasi'   => $organisasiArray,
            'base64'       => $base64Logo,
            'garudaBase64' => $garudaBase64,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('SKPI_' . $skpi->nim . '.pdf');
    }

    // ===============================
    // GENERATE DIPLOMA (PDF)
    // ===============================
    public function generateDiploma(Request $request)
    {
        $validated = $this->validateSKPI($request);

        $skpi = Skpi::updateOrCreate(
            ['nim' => $validated['nim']],
            $validated
        );

        $base64Logo = $this->getBase64Logo('Logo-Unai.png');
        $garudaBase64 = $this->getBase64Logo('garuda.png');

        // DECODE KEGIATAN & ORGANISASI
        $kegiatanArray   = json_decode($request->kegiatan_list, true) ?? [];
        $organisasiArray = json_decode($request->organisasi_list, true) ?? [];

        $pdf = Pdf::loadView('exports.form_skpi_diploma', [
            'skpi'         => $skpi,
            'kegiatan'     => $kegiatanArray,
            'organisasi'   => $organisasiArray,
            'base64'       => $base64Logo,
            'garudaBase64' => $garudaBase64,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('SKPI_Diploma_' . $skpi->nim . '.pdf');
    }

    // ===============================
    // VALIDASI DATA SKPI
    // ===============================
    private function validateSKPI(Request $request)
    {
        return $request->validate([
            'nama'           => 'required|string',
            'ttl'            => 'required|string',
            'nim'            => 'required|string',
            'masuk'          => 'required|string',
            'lulus'          => 'required|string',
            'no_ijazah'      => 'required|string',
            'gelar'          => 'required|string',
            'prodi'          => 'required|string',
            'bahasa'         => 'required|string',
            'jenjang'        => 'required|string',
            'karakter'       => 'required|string',
            'tanggal_surat'  => 'required|date',
            'kegiatan_list'  => 'required|json',
            'organisasi_list'=> 'required|json',
        ]);
    }

    // ===============================
    // HELPER BASE64 LOGO
    // ===============================
    private function getBase64Logo($filename)
    {
        $path = public_path('images/' . $filename);
        return file_exists($path)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($path))
            : '';
    }
}
    