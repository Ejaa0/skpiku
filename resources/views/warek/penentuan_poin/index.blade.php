@extends('layouts.dashboard_warek_utama')

@section('title', 'Penentuan Poin Mahasiswa')

@section('content')
<div class="p-6 space-y-6">
    <h1 class="text-2xl font-bold text-primary mb-2">Penentuan Poin Mahasiswa</h1>
    <p class="text-gray-600 dark:text-gray-300 mb-4">
        Halaman ini digunakan untuk menentukan poin mahasiswa berdasarkan keikutsertaan mereka dalam kegiatan dan organisasi.
    </p>

    <a href="{{ route('warek.penentuan-poin.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        ➕ Tambah Poin
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700 rounded-lg shadow-md">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Keterangan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Poin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">1</td>
                    <td class="px-6 py-4 whitespace-nowrap">Mengikuti Kegiatan yang Dilaksanan Oleh Organisasi</td>
                    <td class="px-6 py-4 whitespace-nowrap">100</td>
                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                        <a href="#" class="text-yellow-600 hover:text-yellow-800">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-800">Hapus</a>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">2</td>
                    <td class="px-6 py-4 whitespace-nowrap">Mengikuti Organisasi</td>
                    <td class="px-6 py-4 whitespace-nowrap">250</td>
                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                        <a href="#" class="text-yellow-600 hover:text-yellow-800">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-800">Hapus</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
