@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-6">
    <div class="bg-white p-6 rounded-lg shadow-xl">
        <h2 class="text-4xl font-extrabold text-blue-600 mb-6 border-b pb-2">Tambah Organisasi</h2>

        <form action="{{ route('organisasi.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nim" class="block text-sm font-semibold text-gray-700">NIM</label>
                <input type="text" id="nim" name="nim" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="nama" class="block text-sm font-semibold text-gray-700">Nama</label>
                <input type="text" id="nama" name="nama" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="id_organisasi" class="block text-sm font-semibold text-gray-700">ID Organisasi</label>
                <input type="text" id="id_organisasi" name="id_organisasi" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="nama_organisasi" class="block text-sm font-semibold text-gray-700">Nama Organisasi</label>
                <input type="text" id="nama_organisasi" name="nama_organisasi" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="absensi" class="block text-sm font-semibold text-gray-700">Absensi</label>
                <input type="text" id="absensi" name="absensi" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
