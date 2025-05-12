@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-12 px-6">
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-yellow-300">
        <h2 class="text-3xl font-extrabold text-yellow-600 mb-6 border-b pb-2">📋 Detail Kegiatan</h2>

        <div class="space-y-4 text-base text-gray-800">
            <div class="flex justify-between">
                <span class="font-semibold">🆔 NIM:</span>
                <span>{{ $kegiatan->nim }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold">👤 Nama:</span>
                <span>{{ $kegiatan->nama }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold">🔢 ID Kegiatan:</span>
                <span>{{ $kegiatan->id_kegiatan }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold">🏷️ Jenis Kegiatan:</span>
                <span>{{ $kegiatan->jenis_kegiatan }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold">📌 Nama Kegiatan:</span>
                <span>{{ $kegiatan->nama_kegiatan }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold">📅 Tanggal Kegiatan:</span>
                <span>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d F Y') }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold">✅ Absensi:</span>
                <span>{{ $kegiatan->absensi }}</span>
            </div>
        </div>

        <div class="mt-8 text-right">
            <a href="{{ route('kegiatan.index') }}" class="text-sm bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">← Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection
