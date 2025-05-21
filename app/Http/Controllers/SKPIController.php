<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Skpi;

class SKPIController extends Controller
{
    public function index()
    {
        return view('skpi.form');
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
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

        $skpi = Skpi::updateOrCreate(
            ['nim' => $validated['nim']],
            $validated
        );

        $pdf = Pdf::loadView('exports.form_skpi', compact('skpi'))->setPaper('a4', 'landscape');

        return $pdf->download('skpi_' . $skpi->nim . '.pdf');
    }
}
