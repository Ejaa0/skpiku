@extends('layouts.warek') <!-- Layout khusus WR III -->

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Poin Mahasiswa (Versi WR III)</h1>

    <table class="min-w-full bg-white rounded shadow">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-4 py-2">NIM</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Total Poin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($poinMahasiswa as $poin)
                <tr class="hover:bg-blue-50">
                    <td class="px-4 py-2">{{ $poin->nim }}</td>
                    <td class="px-4 py-2">{{ $poin->nama }}</td>
                    <td class="px-4 py-2">{{ $poin->poin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
