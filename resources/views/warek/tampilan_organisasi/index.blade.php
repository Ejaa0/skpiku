@extends('layouts.dashboard_warek_utama')

@section('title', 'Daftar Organisasi')

@section('content')
<div class="p-6 bg-gray-50 dark:bg-gray-800 rounded-2xl shadow-lg">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">Daftar Organisasi</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg overflow-hidden">
            <thead class="bg-gray-200 dark:bg-gray-600">
                <tr>
                    <th class="py-3 px-4 text-left text-gray-800 dark:text-white">ID Organisasi</th>
                    <th class="py-3 px-4 text-left text-gray-800 dark:text-white">Nama Organisasi</th>
                    <th class="py-3 px-4 text-left text-gray-800 dark:text-white">Jumlah Anggota</th>
                    <th class="py-3 px-4 text-left text-gray-800 dark:text-white">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($organisasis as $org)
                <tr class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <td class="py-2 px-4 text-gray-800 dark:text-white">{{ $org->id_organisasi }}</td>
                    <td class="py-2 px-4 text-gray-800 dark:text-white">{{ $org->nama_organisasi }}</td>
                    <td class="py-2 px-4 text-gray-800 dark:text-white">{{ $org->detailOrganisasiMahasiswa->count() }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('detail_organisasi_mahasiswa.index', ['id_organisasi' => $org->id_organisasi]) }}" 
                           class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Lihat Anggota</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500 dark:text-gray-300">
                        Belum ada organisasi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
