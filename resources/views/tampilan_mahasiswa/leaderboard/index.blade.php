@extends('layouts.dashboard_mahasiswa') <!-- pastikan layout ada -->

@section('title', 'Leaderboard Mahasiswa')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Leaderboard Mahasiswa</h1>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b">Rank</th>
                <th class="px-4 py-2 border-b">Nama</th>
                <th class="px-4 py-2 border-b">Poin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $index => $m)
            <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : '' }}">
                <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                <td class="px-4 py-2 border-b">{{ $m->name }}</td>
                <td class="px-4 py-2 border-b">{{ $m->poin }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
