@extends('layouts.dashboard_organisasi')

@section('title', 'Data Organisasi')

@section('content')
<div class="p-6">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">Data Organisasi</h2>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Bar -->
    <div class="mb-6 flex justify-center">
        <form method="GET" action="{{ route('organisasi.self.index') }}" class="flex w-full max-w-lg">
            <input 
                type="text" 
                name="search" 
                placeholder="Cari nama organisasi..." 
                value="{{ $search ?? '' }}"
                class="flex-1 px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
            >
            <button 
                type="submit" 
                class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-r-lg hover:bg-blue-600 transition"
            >
                Cari
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto shadow-md rounded-lg">
        <table class="w-full table-auto border-collapse bg-white dark:bg-gray-800">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3 border-b">ID</th>
                    <th class="px-6 py-3 border-b">Nama Organisasi</th>
                    <th class="px-6 py-3 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 dark:text-gray-300">
                @forelse($organisasi as $org)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4 border-b">{{ $org->id_organisasi }}</td>
                    <td class="px-6 py-4 border-b">{{ $org->nama_organisasi }}</td>
                    <td class="px-6 py-4 border-b flex gap-2">
                        <a href="{{ route('organisasi.self.show', $org->id_organisasi) }}" 
                           class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Lihat</a>
                        
                        <form action="{{ route('organisasi.self.destroy', $org->id_organisasi) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500 dark:text-gray-400">Tidak ada data organisasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
