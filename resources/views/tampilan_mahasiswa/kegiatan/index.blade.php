@extends('layouts.dashboard_mahasiswa')

@section('content')

<h1 class="text-2xl font-bold mb-1">Kegiatan Mahasiswa</h1>
<p class="text-gray-600 mb-6">
    NIM: <span class="font-semibold">{{ $nim }}</span>
</p>

{{-- ================== TABEL KEGIATAN ================== --}}
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h2 class="text-lg font-semibold mb-4">Daftar Kegiatan</h2>

    <table class="w-full text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 w-16 text-center">No</th>
                <th class="border px-4 py-2 text-left">Nama Kegiatan</th>
                <th class="border px-4 py-2 text-left">Tanggal</th>
                <th class="border px-4 py-2 w-32 text-center">Poin</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kegiatans as $item)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $item->nama_kegiatan }}</td>
                    <td class="border px-4 py-2">
                        {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}
                    </td>
                    <td class="border px-4 py-2 text-center font-semibold text-green-600">
                        {{ $item->poin }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">
                        Belum mengikuti kegiatan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ================== TABEL TOTAL POIN ================== --}}
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold mb-4">Poin Kegiatan</h2>

    <table class="w-full text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">Keterangan</th>
                <th class="border px-4 py-2 w-32 text-center">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border px-4 py-2">Total Kegiatan Diikuti</td>
                <td class="border px-4 py-2 text-center">
                    {{ $kegiatans->count() }}
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
