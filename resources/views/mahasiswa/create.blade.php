@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4 text-blue-600">Tambah Mahasiswa</h2>

    <form method="POST" action="{{ route('mahasiswa.store') }}">
        @csrf

        <!-- Menampilkan error jika ada -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-4">
            <label class="block font-semibold">Nama Mahasiswa</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">NIM</label>
            <input type="text" name="nim" value="{{ old('nim') }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Tempat Lahir</label>
            <input type="text" name="temp_lahir" value="{{ old('temp_lahir') }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Jenis Kelamin</label>
            <select name="sex" class="w-full border p-2 rounded">
                <option value="L" {{ old('sex') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('sex') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Agama</label>
            <input type="text" name="agama" value="{{ old('agama') }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Hobi</label>
            <input type="text" name="hobi" value="{{ old('hobi') }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Angkatan</label>
            <input type="text" name="angkatan" value="{{ old('angkatan') }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="flex justify-between items-center">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Simpan
            </button>
            <a href="{{ route('mahasiswa.index') }}" class="text-blue-500 hover:underline">← Kembali</a>
        </div>
    </form>
</div>
@endsection
