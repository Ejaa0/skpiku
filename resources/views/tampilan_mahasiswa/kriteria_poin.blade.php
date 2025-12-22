@extends('layouts.dashboard_mahasiswa')

@section('content')
<div class="text-gray-900 dark:text-gray-100">
    <h1 class="text-3xl font-bold mb-6">Kriteria Poin Mahasiswa</h1>

    <div class="bg-white dark:bg-gray-700 p-6 rounded-2xl shadow-md mb-6">
        <p class="text-gray-700 dark:text-gray-200">
            Halaman ini menampilkan kriteria poin mahasiswa berdasarkan keikutsertaan mereka
            dalam kegiatan dan organisasi.
        </p>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
            <thead class="bg-gray-200 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">No</th>
                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Keterangan</th>
                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Poin</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-700">
                @forelse($poin as $item)
                    <tr class="border-b border-gray-300 dark:border-gray-600">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $item->keterangan }}</td>
                        <td class="px-4 py-2">{{ $item->poin }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-center text-gray-500 dark:text-gray-300">
                            Belum ada data kriteria poin.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $poin->links() }}
    </div>
</div>
@endsection
