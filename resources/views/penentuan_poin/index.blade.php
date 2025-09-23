@extends('layouts.app')

@section('content')
<div class="text-gray-900 dark:text-gray-100">
    <h1 class="text-3xl font-bold mb-6">Penentuan Poin Mahasiswa</h1>

    <div class="bg-white dark:bg-gray-700 p-6 rounded-2xl shadow-md mb-6">
        <p class="text-gray-700 dark:text-gray-200">
            Halaman ini digunakan untuk menentukan poin mahasiswa berdasarkan keikutsertaan mereka
            dalam kegiatan dan organisasi.
        </p>
    </div>

    <div class="flex justify-end mb-4">
        <a href="{{ route('penentuan_poin.create') }}"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Tambah Poin</a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600 dark:text-green-400">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
            <thead class="bg-gray-200 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">No</th>
                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Keterangan</th>
                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Poin</th>
                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-700">
                @forelse($poin as $item)
                    <tr class="border-b border-gray-300 dark:border-gray-600">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $item->keterangan }}</td>
                        <td class="px-4 py-2">{{ $item->poin }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('penentuan_poin.edit', $item->id) }}"
                                class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('penentuan_poin.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                    onclick="return confirm('Yakin ingin dihapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500 dark:text-gray-300">
                            Belum ada data penentuan poin.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $poin->links() }}
    </div>
</div>
@endsection
