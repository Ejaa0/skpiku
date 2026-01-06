@extends('layouts.dashboard_mahasiswa')

@section('content')
<div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-md animate-fadeIn">
    <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Leaderboard Teman</h1>

    @if($allNim->isEmpty())
        <p class="text-gray-700 dark:text-gray-200">Belum ada data teman.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700">
                        <th class="px-6 py-3 border text-left text-gray-700 dark:text-gray-200">Peringkat</th>
                        <th class="px-6 py-3 border text-left text-gray-700 dark:text-gray-200">NIM</th>
                        <th class="px-6 py-3 border text-left text-gray-700 dark:text-gray-200">Jumlah Teman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allNim as $index => $data)
                        <tr class="{{ $index % 2 == 0 ? 'bg-gray-50 dark:bg-gray-900' : '' }}">
                            <td class="px-6 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-6 py-2 border">{{ $data['nim'] }}</td>
                            <td class="px-6 py-2 border">{{ $data['jumlah_teman'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
