@extends('layouts.dashboard_mahasiswa')

@section('content')
<div class="p-6">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Dashboard Mahasiswa
    </h1>

    <!-- CARD INFORMASI -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Card 1 -->
        <div class="bg-white rounded-xl p-5 shadow border border-gray-200">
            <h2 class="text-xl text-gray-700 font-semibold">Total Kegiatan</h2>
            <p class="text-4xl font-bold text-gray-900 mt-2">
                {{ $totalKegiatan ?? 0 }}
            </p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-xl p-5 shadow border border-gray-200">
            <h2 class="text-xl text-gray-700 font-semibold">Total Organisasi</h2>
            <p class="text-4xl font-bold text-gray-900 mt-2">
                {{ $totalOrganisasi ?? 0 }}
            </p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-xl p-5 shadow border border-gray-200">
            <h2 class="text-xl text-gray-700 font-semibold">Total Poin SKPI</h2>
            <p class="text-4xl font-bold text-gray-900 mt-2">
                {{ $totalPoin ?? 0 }}
            </p>
        </div>

    </div>

    <!-- TABEL RIWAYAT -->
    <div class="mt-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Riwayat Kegiatan Terakhir</h2>

        <div class="overflow-x-auto bg-white rounded-xl border border-gray-200 shadow">
            <table class="min-w-full text-gray-800">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-gray-700">Tanggal</th>
                        <th class="px-4 py-3 text-left text-gray-700">Nama Kegiatan</th>
                        <th class="px-4 py-3 text-left text-gray-700">Poin</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($riwayatKegiatan ?? [] as $item)
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-3">{{ $item->tanggal_kegiatan }}</td>
                            <td class="px-4 py-3">{{ $item->nama_kegiatan }}</td>
                            <td class="px-4 py-3">{{ $item->poin }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-3 text-center text-gray-500">
                                Belum ada riwayat kegiatan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
