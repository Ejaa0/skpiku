@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Mahasiswa</h3>
    <form action="{{ route('mahasiswas.store') }}" method="POST">
        @csrf
        
        <input type="text" name="nim" placeholder="NIM" class="form-control mb-2">
        <input type="text" name="temp_lahir" placeholder="Tempat Lahir" class="form-control mb-2">
        <input type="date" name="tgl_lahir" class="form-control mb-2">
        <select name="sex" class="form-control mb-2">
            <option>Laki-laki</option>
            <option>Perempuan</option>
        </select>
        <input type="text" name="agama" placeholder="Agama" class="form-control mb-2">
        <input type="text" name="hobi" placeholder="Hobi" class="form-control mb-2">
        <input type="text" name="angkatan" placeholder="Angkatan" class="form-control mb-2">
        <input type="email" name="email" placeholder="Email" class="form-control mb-2">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection