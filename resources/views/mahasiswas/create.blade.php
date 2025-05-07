<!-- resources/views/mahasiswas/create.blade.php -->

@extends('layouts.app')

@section('content')
<h3>Tambah Mahasiswa UNAI</h3>

<form action="{{ route('mahasiswas.store') }}" method="POST">
    @csrf
    @include('mahasiswas.form')
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
