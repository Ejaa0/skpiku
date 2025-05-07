@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4 text-blue-600">Tambah Kegiatan</h2>

    <form method="POST" action="{{ route('kegiatan.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan" class="w-full border p-2 rounded" required>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
            <a href="{{ route('kegiatan.index') }}" class="text-blue-500 hover:underline">← Kembali</a>
        </div>
    </form>
</div>
@endsection
