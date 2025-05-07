<!-- resources/views/mahasiswas/edit.blade.php -->

@extends('layouts.app')

@section('content')
<h3>Edit Mahasiswa</h3>

<form action="{{ route('mahasiswas.update', $mahasiswa->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('mahasiswas.form', ['mahasiswa' => $mahasiswa])
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
