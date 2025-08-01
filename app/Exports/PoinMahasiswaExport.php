<?php

namespace App\Exports;

use App\Models\PoinMahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PoinMahasiswaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return PoinMahasiswa::select('nim', 'nama', 'poin')->get();
    }

    public function headings(): array
    {
        return ['NIM', 'Nama', 'Poin'];
    }
}
