@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4 text-blue-600">Edit Mahasiswa</h2>

    <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold">Nama Mahasiswa</label>
            <input type="text" name="nama" class="w-full border p-2 rounded" value="{{ $mahasiswa->nama }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">NIM</label>
            <input type="text" name="nim" class="w-full border p-2 rounded" value="{{ $mahasiswa->nim }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Tempat Lahir</label>
            <input type="text" name="temp_lahir" class="w-full border p-2 rounded" value="{{ $mahasiswa->temp_lahir }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="w-full border p-2 rounded" value="{{ $mahasiswa->tgl_lahir }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Jenis Kelamin</label>
            <select name="sex" class="w-full border p-2 rounded">
                <option value="L" {{ $mahasiswa->sex == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $mahasiswa->sex == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Agama</label>
            <input type="text" name="agama" class="w-full border p-2 rounded" value="{{ $mahasiswa->agama }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Hobi</label>
            <input type="text" name="hobi" class="w-full border p-2 rounded" value="{{ $mahasiswa->hobi }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Angkatan</label>
            <input type="text" name="angkatan" class="w-full border p-2 rounded" value="{{ $mahasiswa->angkatan }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded" value="{{ $mahasiswa->email }}" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Perbarui</button>
    </form>
</div>
@endsection
