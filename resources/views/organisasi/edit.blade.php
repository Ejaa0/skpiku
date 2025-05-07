@extends('layouts.app')

@section('content')
    <h1>Edit Organisasi</h1>

    <form action="{{ route('organisasi.update', $organisasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" name="nim" class="form-control" id="nim" value="{{ old('nim', $organisasi->nim) }}" required>
        </div>

        <div class="form-group">
            <label for="id_kegiatan">ID Kegiatan</label>
            <input type="number" name="id_kegiatan" class="form-control" id="id_kegiatan" value="{{ old('id_kegiatan', $organisasi->id_kegiatan) }}" required>
        </div>

        <div class="form-group">
            <label for="nama_kegiatan">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" id="nama_kegiatan" value="{{ old('nama_kegiatan', $organisasi->nama_kegiatan) }}" required>
        </div>

        <div class="form-group">
            <label for="absensi">Absensi</label>
            <input type="text" name="absensi" class="form-control" id="absensi" value="{{ old('absensi', $organisasi->absensi) }}" required>
        </div>

        <button type="submit" class="btn btn-warning mt-3">Update</button>
    </form>
@endsection
