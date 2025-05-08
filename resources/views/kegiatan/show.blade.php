@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-8 p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4 text-yellow-600">Detail Kegiatan</h2>

    <p><strong>Nama Kegiatan:</strong> {{ $kegiatan->nama_kegiatan }}</p>
    <p><strong>Tanggal Kegiatan:</strong> {{ $kegiatan->tanggal_kegiatan }}</p>

    <a href="{{ route('kegiatan.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">← Kembali ke daftar</a>
</div>
@endsection
