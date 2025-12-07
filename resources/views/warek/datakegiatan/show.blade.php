@extends('layouts.dashboard_warek_utama') <!-- sesuaikan layout -->

@section('title', 'Detail Kegiatan')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">📋 Detail Kegiatan</h1>

    <div class="bg-white p-6 rounded shadow mb-6">
        <p class="mb-2">🔢 <strong>ID Kegiatan:</strong> {{ $kegiatan->id }}</p>
        <p class="mb-2">🏷️ <strong>Jenis Kegiatan:</strong> {{ $kegiatan->jenis_kegiatan }}</p>
        <p class="mb-2">📌 <strong>Nama Kegiatan:</strong> {{ $kegiatan->nama_kegiatan }}</p>
        <p class="mb-2">📅 <strong>Tanggal Kegiatan:</strong> {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d F Y') }}</p>

        <a href="{{ route('kegiatan-self.addMahasiswa', $kegiatan->id) }}" 
           class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
           + Tambah Mahasiswa
        </a>
    </div>

    <h2 class="text-xl font-semibold mb-2">Daftar Mahasiswa yang Mengikuti</h2>
    @if($kegiatan->mahasiswa->count() > 0)
        <ul class="list-disc pl-5">
            @foreach($kegiatan->mahasiswa as $mhs)
                <li>{{ $mhs->nama }} ({{ $mhs->nim }})</li>
            @endforeach
        </ul>
    @else
        <p>Belum ada mahasiswa yang mengikuti kegiatan ini.</p>
    @endif

    <a href="{{ route('warek.datakegiatan.index') }}" 
       class="inline-block mt-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
       ← Kembali ke Daftar
    </a>
</div>
@endsection
