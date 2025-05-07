@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4 text-yellow-600">Edit Kegiatan</h2>

    <form method="POST" action="{{ route('kegiatan.update', $kegiatan->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan" value="{{ $kegiatan->tanggal_kegiatan }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
            <a href="{{ route('kegiatan.index') }}" class="text-blue-500 hover:underline">← Batal</a>
        </div>
    </form>
</div>
@endsection
