@extends('layouts.dashboard_warek_utama')

@section('title', 'Detail Poin Mahasiswa')

@section('content')
<div class="p-6">

    <a href="{{ route('warek.poin') }}" 
       class="text-blue-400 hover:text-blue-300 mb-4 inline-block">
        ← Kembali ke pencarian
    </a>

    <div class="bg-white dark:bg-gray-800 dark:text-white text-gray-800 
                p-6 rounded-xl shadow-lg transition">

        <h1 class="text-2xl font-bold mb-4">Detail Poin Mahasiswa</h1>

        {{-- Data Mahasiswa --}}
        <div class="mb-6">
            <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
            <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
            
            <p><strong>Total Poin:</strong> 
                <span class="text-green-600 dark:text-green-400 font-bold text-xl">
                    {{ $totalPoin }}
                </span>
            </p>
        </div>

        <hr class="border-gray-300 dark:border-gray-700 my-6">

        {{-- Riwayat Kegiatan --}}
        <h2 class="text-xl font-semibold mb-3">Riwayat Kegiatan</h2>

        @if($kegiatan->count() == 0)
            <p class="text-gray-500 dark:text-gray-400 mb-4">Belum ada kegiatan.</p>
        @else
        <div class="overflow-x-auto mb-6">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="p-3">Nama Kegiatan</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3 text-right">Poin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatan as $k)
                        <tr class="border-b border-gray-300 dark:border-gray-700">
                            <td class="p-3">{{ $k->nama_kegiatan }}</td>
                            <td class="p-3">{{ $k->tanggal_kegiatan }}</td>
                            <td class="p-3 text-green-700 dark:text-green-300 text-right">{{ $k->poin ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <hr class="border-gray-300 dark:border-gray-700 my-6">

        {{-- Riwayat Organisasi --}}
        <h2 class="text-xl font-semibold mb-3">Riwayat Organisasi</h2>

        @if($organisasi->count() == 0)
            <p class="text-gray-500 dark:text-gray-400">Belum ada organisasi.</p>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="p-3">Nama Organisasi</th>
                        <th class="p-3">Jabatan</th>
                        <th class="p-3 text-right">Poin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($organisasi as $o)
                        <tr class="border-b border-gray-300 dark:border-gray-700">
                            <td class="p-3">{{ $o->nama_organisasi }}</td>
                            <td class="p-3">{{ $o->jabatan ?? '-' }}</td>
                            <td class="p-3 text-green-700 dark:text-green-300 text-right">{{ $o->poin ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

    </div>

</div>
@endsection
