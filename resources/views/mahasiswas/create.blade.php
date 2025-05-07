@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4 text-blue-600">Tambah Mahasiswa</h2>

    <form method="POST" action="{{ route('mahasiswa.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">Nama Mahasiswa</label>
            <input type="text" name="nama" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">NIM</label>
            <input type="text" name="nim" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Tempat Lahir</label>
            <input type="text" name="temp_lahir" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Jenis Kelamin</label>
            <select name="sex" class="w-full border p-2 rounded">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Agama</label>
            <input type="text" name="agama" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Hobi</label>
            <input type="text" name="hobi" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Angkatan</label>
            <input type
