@extends('layouts.dashboard_organisasi')

@section('title', 'Daftar Organisasi')

@section('content')
<h2 class="text-2xl font-bold mb-4">Daftar Organisasi</h2>

@if (session('success'))
<div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
    {{ session('success') }}
</div>
@endif

<a href="{{ route('organisasi.self.create') }}" 
   class="mb-4 inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
   + Tambah Organisasi
</a>

<div class="overflow-x-auto shadow rounded-lg">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-200 dark:bg-gray-700">
            <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Nama Organisasi</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($organisasi as $org)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-4 py-2">{{ $org->id }}</td>
                <td class="px-4 py-2">{{ $org->nama_organisasi }}</td>
                <td class="px-4 py-2">{{ $org->email }}</td>
                <td class="px-4 py-2 flex gap-2">
                    <a href="{{ route('organisasi.self.edit', $org->id) }}" 
                       class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                    <form action="{{ route('organisasi.self.destroy', $org->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-4 py-6 text-center">Belum ada organisasi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
