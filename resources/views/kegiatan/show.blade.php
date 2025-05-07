@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4 text-blue-600">Detail Mahasiswa</h2>

    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>NIM:</strong> {{ $mahasiswa->nim }}</li>
        <li class="list-group-item"><strong>Tempat Lahir:</strong> {{ $mahasiswa->temp_lahir }}</li>
        <li class="list-group-item"><strong>Tanggal Lahir:</strong> {{ $mahasiswa->tgl_lahir }}</li>
        <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ $mahasiswa->sex }}</li>
        <li class="list-group-item"><strong>Agama:</strong> {{ $mahasiswa->agama }}</li>
        <li class="list-group-item"><strong>Hobi:</strong> {{ $mahasiswa->hobi }}</li>
        <li class="list-group-item"><strong>Angkatan:</strong> {{ $mahasiswa->angkatan }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $mahasiswa->email }}</li>
    </ul>

    <div class="flex justify-between">
        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
        <a href="{{ route('mahasiswa.index') }}" class="text-blue-500 hover:underline">← Kembali</a>
    </div>
</div>
@endsection
