<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi; // pastikan modelnya benar

class OrganisasiSelfController extends Controller
{
    public function index()
    {
        // Ambil semua data organisasi dari database
        $organisasi = Organisasi::all();

        // Kirim data ke view
        return view('tampilan_organisasi.organisasi', compact('organisasi'));
    }
}
