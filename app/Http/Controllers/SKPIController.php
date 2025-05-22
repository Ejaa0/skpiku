<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Skpi;

class SKPIController extends Controller
{
    // Menampilkan form SKPI
    public function index()
    {
        return view('skpi.form');
    }

    // Generate PDF untuk jenjang Sarjana
    public function generate(Request $request)
    {
        $validated = $this->validateSKPI($request);

        $skpi = Skpi::updateOrCreate(
            ['nim' => $validated['nim']],
            $validated
        );

        $base64Logo = $this->imageToBase64(public_path('images/Logo-Unai.png'));
        $base64Garuda = $this->imageToBase64(public_path('images/garuda.png'));

        $pdf = Pdf::loadView('exports.form_skpi', [
            'skpi' => $skpi,
            'base64' => $base64Logo,
            'garudaBase64' => $base64Garuda,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('skpi_' . $skpi->nim . '.pdf');
    }

    // Generate PDF untuk jenjang Diploma
    public function generateDiploma(Request $request)
    {
        $validated = $this->validateSKPI($request);

        $skpi = Skpi::updateOrCreate(
            ['nim' => $validated['nim']],
            $validated
        );

        $base64Logo = $this->imageToBase64(public_path('images/Logo-Unai.png'));
        $base64Garuda = $this->imageToBase64(public_path('images/garuda.png'));

        $pdf = Pdf::loadView('exports.form_skpi_diploma', [
            'skpi' => $skpi,
            'base64' => $base64Logo,
            'garudaBase64' => $base64Garuda,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('skpi_diploma_' . $skpi->nim . '.pdf');
    }

    // Fungsi validasi input
    private function validateSKPI(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'ttl' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'masuk' => 'required|string|max:255',
            'lulus' => 'required|string|max:255',
            'no_ijazah' => 'required|string|max:255',
            'gelar' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'bahasa' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
            'karakter' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
        ]);
    }

    // Fungsi konversi gambar ke base64
    private function imageToBase64($path)
    {
        if (!file_exists($path)) {
            return '';
        }

        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}
