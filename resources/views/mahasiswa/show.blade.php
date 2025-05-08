@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-blue-600">Detail Mahasiswa</h2>

    <div class="mb-4">
        <strong>Nama:</strong> {{ $mahasiswa->nama }}
    </div>
    <div class="mb-4">
        <strong>NIM:</strong> {{ $mahasiswa->nim }}
    </div>
    <div class="mb-4">
        <strong>Tempat Lahir:</strong> {{ $mahasiswa->temp_lahir }}
    </div>
    <div class="mb-4">
        <strong>Tanggal Lahir:</strong> {{ $mahasiswa->tgl_lahir }}
    </div>
    <div class="mb-4">
        <strong>Jenis Kelamin:</strong> {{ $mahasiswa->sex == 'L' ? 'Laki-laki' : 'Perempuan' }}
    </div>
    <div class="mb-4">
        <strong>Agama:</strong> {{ $mahasiswa->agama }}
    </div>
    <div class="mb-4">
        <strong>Hobi:</strong> {{ $mahasiswa->hobi }}
    </div>
    <div class="mb-4">
        <strong>Angkatan:</strong> {{ $mahasiswa->angkatan }}
    </div>
    <div class="mb-4">
        <strong>Email:</strong> {{ $mahasiswa->email }}
    </div>

    <a href="{{ route('mahasiswa.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kembali</a>
</div>
@endsection
