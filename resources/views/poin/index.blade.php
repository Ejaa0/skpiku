@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Daftar Poin Mahasiswa</h1>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md overflow-x-auto">
        <table class="min-w-full border border-gray-300 dark:border-gray-700">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700">
                    <th class="px-4 py-2 border dark:border-gray-600 text-left text-gray-700 dark:text-gray-200">NIM</th>
                    <th class="px-4 py-2 border dark:border-gray-600 text-left text-gray-700 dark:text-gray-200">Nama</th>
                    <th class="px-4 py-2 border dark:border-gray-600 text-right text-gray-700 dark:text-gray-200">Total Poin</th>
                    <th class="px-4 py-2 border dark:border-gray-600 text-left text-gray-700 dark:text-gray-200">Tanggal Dibuat</th>
                    <th class="px-4 py-2 border dark:border-gray-600 text-left text-gray-700 dark:text-gray-200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswas as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-2 border dark:border-gray-600 text-gray-800 dark:text-gray-100">{{ $item->nim }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600 text-gray-800 dark:text-gray-100">{{ $item->nama }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600 text-right text-gray-800 dark:text-gray-100">
                            {{ $item->total_poin ?? 0 }}
                        </td>
                        <td class="px-4 py-2 border dark:border-gray-600 text-gray-600 dark:text-gray-300">
                            {{ $item->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                        </td>
                        <td class="px-4 py-2 border dark:border-gray-600 space-x-2">
                            <a href="{{ route('poin.show', $item->nim) }}" 
                               class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                                View
                            </a>

                            

                            {{-- Tampilkan tombol Buat SKPI jika poin >= 1000 --}}
                            @if(($item->total_poin ?? 0) >= 1000)
                                <a href="{{ url('/skpi') }}" 
                                   class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700 transition">
                                    Buat SKPI
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-400">
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
