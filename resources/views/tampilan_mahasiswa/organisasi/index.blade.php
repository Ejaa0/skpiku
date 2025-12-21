@extends('layouts.dashboard_mahasiswa')

@section('content')

<h1 class="text-2xl font-bold mb-1">Organisasi Mahasiswa</h1>
<p class="text-gray-600 mb-6">
    NIM: <span class="font-semibold">{{ $nim }}</span>
</p>

{{-- ================== TABEL ORGANISASI ================== --}}
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h2 class="text-lg font-semibold mb-4">Daftar Organisasi</h2>

    <table class="w-full text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 w-16 text-center">No</th>
                <th class="border px-4 py-2 text-left">Nama Organisasi</th>
                <th class="border px-4 py-2 text-left">Jabatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($organisasi as $item)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2 text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="border px-4 py-2">
                        {{ $item->nama_organisasi }}
                    </td>
                    <td class="border px-4 py-2">
                        {{ ucfirst($item->jabatan) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">
                        Belum mengikuti organisasi
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ================== TABEL POIN ================== --}}
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold mb-4">Poin Organisasi</h2>

    <table class="w-full text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">Keterangan</th>
                <th class="border px-4 py-2 w-32 text-center">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border px-4 py-2">Total Organisasi Diikuti</td>
                <td class="border px-4 py-2 text-center">
                    {{ $organisasi->count() }}
                </td>
            </tr>
            <tr>
                <td class="border px-4 py-2 font-semibold">Total Poin</td>
                <td class="border px-4 py-2 text-center font-bold text-blue-600">
                    {{ $totalPoin ?? 0 }}
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
