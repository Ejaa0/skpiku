@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-semibold mb-4">Edit Organisasi</h2>

    <form action="{{ route('organisasi.update', $organisasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">NIM</label>
            <input type="text" name="nim" value="{{ $organisasi->nim }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Nama</label>
            <input type="text" name="nama" value="{{ $organisasi->nama }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Kegiatan</label>
            <select name="id_kegiatan" class="w-full border rounded px-3 py-2" required>
                @foreach ($kegiatans as $kegiatan)
                    <option value="{{ $kegiatan->id }}" {{ $organisasi->id_kegiatan == $kegiatan->id ? 'selected' : '' }}>
                        {{ $kegiatan->nama_kegiatan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Nama Organisasi</label>
            <input type="text" name="nama_organisasi" value="{{ $organisasi->nama_organisasi }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Absensi</label>
            <select name="absensi" class="w-full border rounded px-3 py-2">
                <option value="Hadir" {{ $organisasi->absensi == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="Tidak Hadir" {{ $organisasi->absensi == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
    </form>
</div>
@endsection
