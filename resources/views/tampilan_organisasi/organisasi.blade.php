@extends('layouts.dashboard_organisasi')

@section('content')
<div class="flex flex-col">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Daftar Organisasi</h1>
        <a href="{{ route('organisasi.create') }}" class="px-5 py-2 bg-green-500 hover:bg-green-600 text-white rounded shadow">+ Tambah Organisasi</a>
    </div>

    <div class="overflow-x-auto shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-200 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Nama Organisasi</th>
                    <th class="px-4 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($organisasi as $org)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-4 py-2">{{ $org->id }}</td>
                    <td class="px-4 py-2">{{ $org->nama_organisasi }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('organisasi.edit', $org->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('organisasi.destroy', $org->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">Belum ada organisasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
