@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">📖 Detail Kegiatan</h1>

    <div class="bg-white shadow rounded p-6 space-y-4">
        <p><strong>Nama:</strong> {{ $kegiatan->nama_kegiatan }}</p>
        <p><strong>Tanggal:</strong> {{ $kegiatan->tanggal_kegiatan }}</p>
        <p><strong>Deskripsi:</strong><br>
            <span class="text-gray-700">{{ $kegiatan->deskripsi ?? 'Tidak ada deskripsi.' }}</span>
        </p>
    </div>

    <div class="mt-4">
        <a href="{{ route('kegiatan.index') }}" class="text-blue-600 hover:underline">← Kembali ke daftar</a>
    </div>
</div>
@endsection
