<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoinMahasiswa;

class WarekPoinController extends Controller
{
    public function index(Request $request)
    {
        $query = PoinMahasiswa::query();

        // Search berdasarkan NIM atau Nama
        if ($request->has('q') && $request->q != '') {
            $q = $request->q;
            $query->where('nim', 'like', "%$q%")
                  ->orWhere('nama', 'like', "%$q%");
        }

        $poinMahasiswa = $query->orderBy('poin', 'desc')->paginate(20);

        return view('warek.poin.index', compact('poinMahasiswa'));
    }
}
