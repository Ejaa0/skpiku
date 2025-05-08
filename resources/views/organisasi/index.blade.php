@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow mt-8">
    <h2 class="text-2xl font-bold mb-4">Tambah Organisasi</h2>

    <form action="{{ route('organisasi.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-bold mb-1">NIM</label>
            <input type="text" name="nim" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-1">Nama</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-1">ID Kegiatan</label>
            <input type="number" name="id_kegiatan" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-1">Nama Organisasi</label>
            <input type="text" name="nama_organisasi" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-1">Absensi</label>
            <select name="absensi" class="w-full border rounded px-3 py-2" required>
                <option value="HADIR">Hadir</option>
                <option value="TIDAK">Tidak Hadir</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </form>
</div>
@endsection
