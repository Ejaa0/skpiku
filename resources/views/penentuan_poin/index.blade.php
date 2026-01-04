@extends('layouts.app')

@section('content')
<div class="text-gray-900 dark:text-gray-100"
     x-data="{ deleteOpen: false, deleteUrl: '' }">

    <h1 class="text-3xl font-bold mb-6">Penentuan Poin Mahasiswa</h1>

    <div class="bg-white dark:bg-gray-700 p-6 rounded-2xl shadow-md mb-6">
        <p class="text-gray-700 dark:text-gray-200">
            Halaman ini digunakan untuk menentukan poin mahasiswa berdasarkan keikutsertaan mereka
            dalam kegiatan dan organisasi.
        </p>
    </div>

    <div class="flex justify-end mb-4">
        <a href="{{ route('penentuan_poin.create') }}"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow">
            + Tambah Poin
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 dark:border-gray-600 rounded-xl overflow-hidden">
            <thead class="bg-gray-200 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Keterangan</th>
                    <th class="px-4 py-3 text-left">Poin</th>
                    <th class="px-4 py-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white dark:bg-gray-700">
                @forelse($poin as $item)
                <tr class="border-b border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $item->keterangan }}</td>
                    <td class="px-4 py-2 font-semibold">{{ $item->poin }}</td>
                    <td class="px-4 py-2 flex gap-2">

                        <a href="{{ route('penentuan_poin.edit', $item->id) }}"
                            class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                            Edit
                        </a>

                        <button
                            @click="deleteOpen = true; deleteUrl='{{ route('penentuan_poin.destroy', $item->id) }}'"
                            class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500 dark:text-gray-300">
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

    <!-- MODAL HAPUS -->
    <div x-show="deleteOpen"
        x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">

        <div @click.outside="deleteOpen = false"
            x-transition.scale
            class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-md p-6 text-center">

            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center">
                <span class="material-icons text-red-600 dark:text-red-400 text-4xl">delete</span>
            </div>

            <h2 class="text-2xl font-bold mb-2">
                Konfirmasi Hapus
            </h2>

            <p class="text-gray-600 dark:text-gray-300 mb-6">
                Data penentuan poin yang dihapus tidak dapat dikembalikan.
                Apakah Anda yakin?
            </p>

            <div class="flex justify-center gap-4">
                <button @click="deleteOpen = false"
                    class="px-5 py-2 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                    Batal
                </button>

                <form :action="deleteUrl" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-5 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white shadow-lg">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
