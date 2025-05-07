<!-- resources/views/mahasiswas/index.blade.php -->

@extends('layouts.app')

@section('content')
<h2 class="text-center mb-4">Data Mahasiswa</h2>

<a href="{{ route('mahasiswas.create') }}" class="btn btn-success mb-3">Tambah Mahasiswa</a>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>NIM</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Hobi</th>
            <th>Angkatan</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mahasiswas as $m)
        <tr>
            <td>{{ $m->nim }}</td>
            <td>{{ $m->temp_lahir }}</td>
            <td>{{ $m->tgl_lahir }}</td>
            <td>{{ $m->sex }}</td>
            <td>{{ $m->agama }}</td>
            <td>{{ $m->hobi }}</td>
            <td>{{ $m->angkatan }}</td>
            <td>{{ $m->email }}</td>
            <td>
                <a href="{{ route('mahasiswas.show', $m->id) }}" class="btn btn-info btn-sm">Lihat</a>
                <a href="{{ route('mahasiswas.edit', $m->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('mahasiswas.destroy', $m->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $mahasiswas->links() }}
@endsection
