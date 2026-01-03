@extends('layouts.dashboard_mahasiswa')

@section('content')
<div class="text-gray-800">
    <h1 class="text-3xl font-bold mb-6 text-blue-700">
        Kriteria Poin Mahasiswa
    </h1>

    <div class="bg-blue-50 p-6 rounded-2xl shadow-sm mb-6 border border-blue-100">
        <p class="text-gray-700">
            Halaman ini menampilkan kriteria poin mahasiswa berdasarkan keikutsertaan
            dalam kegiatan dan organisasi.
        </p>
    </div>

    <div class="overflow-x-auto bg-white rounded-2xl shadow-md border border-gray-200">
        <table class="min-w-full">
            <thead class="bg-blue-100">
                <tr>
                    <th class="px-5 py-3 text-left text-sm font-semibold text-blue-700 border-b">
                        No
                    </th>
                    <th class="px-5 py-3 text-left text-sm font-semibold text-blue-700 border-b">
                        Keterangan
                    </th>
                    <th class="px-5 py-3 text-left text-sm font-semibold text-blue-700 border-b">
                        Poin
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse($poin as $item)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-5 py-3 border-b text-sm">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-5 py-3 border-b text-sm">
                            {{ $item->keterangan }}
                        </td>
                        <td class="px-5 py-3 border-b text-sm font-semibold text-green-600">
                            {{ $item->poin }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-5 py-6 text-center text-gray-500">
                            Belum ada data kriteria poin.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $poin->links() }}
    </div>
</div>
@endsection
