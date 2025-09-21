@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Daftar Poin Mahasiswa</h1>

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        <table class="min-w-full border border-gray-300 dark:border-gray-700">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700">
                    <th class="px-4 py-2 border dark:border-gray-600">NIM</th>
                    <th class="px-4 py-2 border dark:border-gray-600">Nama</th>
                    <th class="px-4 py-2 border dark:border-gray-600">Total Poin</th>
                    <th class="px-4 py-2 border dark:border-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswas as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-2 border dark:border-gray-600">{{ $item->nim }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600">{{ $item->nama }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600">
                            {{ $item->total_poin ?? 0 }}
                        </td>
                        <td class="px-4 py-2 border dark:border-gray-600 space-x-2">
                            <a href="{{ route('poin.show', $item->nim) }}" 
                               class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                                View
                            </a>

                            <form action="{{ route('poin.destroy', $item->nim) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">
                            Belum ada data poin mahasiswa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('poin.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Tambah Data Poin
        </a>
    </div>
</div>
@endsection
