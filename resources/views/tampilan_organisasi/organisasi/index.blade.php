@extends('layouts.dashboard_organisasi')

@section('title', 'Data Organisasi')

@section('content')
<h2 class="text-2xl font-bold mb-4">Data Organisasi</h2>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
@endif

<div class="flex justify-between items-center mb-4">
    <a href="{{ route('organisasi.self.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah Organisasi</a>
    
    <!-- Search Bar -->
    <form method="GET" action="{{ route('organisasi.self.index') }}" class="flex gap-2 flex-1 justify-center max-w-lg">
        <input type="text" name="search" placeholder="Cari nama organisasi..." 
               value="{{ $search ?? '' }}"
               class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600">
        <button type="submit" class="px-3 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cari</button>
    </form>
</div>

<table class="w-full border-collapse border">
    <thead>
        <tr class="bg-gray-200">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Nama Organisasi</th>
            <th class="border px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($organisasi as $org)
        <tr>
            <td class="border px-4 py-2">{{ $org->id_organisasi }}</td>
            <td class="border px-4 py-2">{{ $org->nama_organisasi }}</td>
            <td class="border px-4 py-2 flex gap-2">
                <a href="{{ route('organisasi.self.show', $org->id_organisasi) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Lihat</a>
                <a href="{{ route('organisasi.self.edit', $org->id_organisasi) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                <form action="{{ route('organisasi.self.destroy', $org->id_organisasi) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="border px-4 py-2 text-center">Tidak ada data organisasi.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
