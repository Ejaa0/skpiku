@extends('layouts.dashboard_mahasiswa')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Leaderboard Mahasiswa</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">No</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">NIM</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Total Poin</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($mahasiswa as $index => $mhs)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-800">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $mhs['nim'] }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $mhs['nama'] }}</td>
                    <td class="px-6 py-4 font-bold text-gray-900">{{ $mhs['total_poin'] }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
