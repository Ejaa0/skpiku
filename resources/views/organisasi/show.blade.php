@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-blue-600">Detail Organisasi</h2>

    <div class="space-y-3">
        <p><strong>NIM:</strong> {{ $organisasi->nim }}</p>
        <p><strong>Nama:</strong> {{ $organisasi->nama }}</p>
        <p><strong>Nama Organisasi:</strong> {{ $organisasi->nama_organisasi }}</p>
        <p><strong>ID Kegiatan:</strong> {{ $organisasi->id_kegiatan }}</p>
        <p><strong>Absensi:</strong> {{ $organisasi->absensi }}</p>
    </div>

    <a href="{{ route('organisasi.index') }}" class="inline-block mt-6 text-blue-500 hover:underline">
        ← Kembali ke daftar
    </a>
</div>
@endsection
