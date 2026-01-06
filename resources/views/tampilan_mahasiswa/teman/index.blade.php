@extends('layouts.dashboard_mahasiswa')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Teman</h1>

<!-- Tombol tambah teman -->
<button
    onclick="document.getElementById('modalTambahTeman').classList.remove('hidden')"
    class="mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
>
    Tambah Teman
</button>

<!-- Modal tambah teman -->
<div id="modalTambahTeman" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-96">
        <h2 class="text-xl font-bold mb-4">Tambah Teman</h2>
        <form action="{{ route('mahasiswa.teman.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="teman_nim" class="block mb-1">NIM Teman</label>
                <input type="text" name="teman_nim" id="teman_nim" class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:text-gray-100" required>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('modalTambahTeman').classList.add('hidden')" class="px-4 py-2 bg-gray-400 rounded hover:bg-gray-500">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah</button>
            </div>
        </form>
    </div>
</div>

<!-- Tabel daftar teman -->
<table class="min-w-full bg-white dark:bg-gray-800 rounded-xl shadow">
    <thead>
        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
            <th class="px-4 py-2">No</th>
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($teman as $item)
        <tr class="border-b border-gray-200 dark:border-gray-700">
            <td class="px-4 py-2">{{ $loop->iteration }}</td>
            <td class="px-4 py-2">{{ $item->nama }}</td>
            <td class="px-4 py-2">{{ $item->email }}</td>
            <td class="px-4 py-2">
                <form action="{{ route('mahasiswa.teman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus teman ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
