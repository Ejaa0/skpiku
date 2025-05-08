@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow mt-8">
    <h2 class="text-2xl font-bold mb-4">Tambah Organisasi</h2>

    <form method="POST" action="{{ route('organisasi.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">NIM</label>
            <input type="text" name="nim" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Nama</label>
            <input type="text" name="nama" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Nama Organisasi</label>
            <input type="text" name="nama_organisasi" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Absensi</label>
            <input type="text" name="absensi" class="w-full border p-2 rounded" required>
        </div>

        <!-- Dropdown untuk memilih id_kegiatan -->
        <div class="mb-4">
            <label class="block font-semibold">Kegiatan</label>
            <select name="id_kegiatan" class="w-full border p-2 rounded" required>
                @foreach ($kegiatans as $kegiatan)
                    <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama_kegiatan }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Simpan</button>
            <a href="{{ route('organisasi.index') }}" class="text-blue-500 hover:underline">← Kembali</a>
        </div>
    </form>
</div>
@endsection
