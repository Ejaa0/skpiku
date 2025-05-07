<!-- resources/views/mahasiswas/show.blade.php -->

@extends('layouts.app')

@section('content')
<h3>Detail Mahasiswa</h3>

<ul class="list-group">
    <li class="list-group-item"><strong>NIM:</strong> {{ $mahasiswa->nim }}</li>
    <li class="list-group-item"><strong>Tempat Lahir:</strong> {{ $mahasiswa->temp_lahir }}</li>
    <li class="list-group-item"><strong>Tanggal Lahir:</strong> {{ $mahasiswa->tgl_lahir }}</li>
    <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ $mahasiswa->sex }}</li>
    <li class="list-group-item"><strong>Agama:</strong> {{ $mahasiswa->agama }}</li>
    <li class="list-group-item"><strong>Hobi:</strong> {{ $mahasiswa->hobi }}</li>
    <li class="list-group-item"><strong>Angkatan:</strong> {{ $mahasiswa->angkatan }}</li>
    <li class="list-group-item"><strong>Email:</strong> {{ $mahasiswa->email }}</li>
</ul>
@endsection
