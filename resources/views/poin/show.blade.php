@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <h2 class="text-3xl font-extrabold text-blue-600 mb-6">Detail Poin Mahasiswa 🎓</h2>

    <div class="bg-white rounded-lg shadow-lg p-6 space-y-4">
        <p><strong class="text-lg">NIM 🆔:</strong> <span class="text-gray-800">{{ $data->nim }}</span></p>
        <p><strong class="text-lg">Nama 👤:</strong> <span class="text-gray-800">{{ $data->nama }}</span></p>
        <p><strong class="text-lg">Nama Kegiatan 📝:</strong> <span class="text-gray-800">{{ $data->nama_kegiatan }}</span></p>
        <p><strong class="text-lg">Jenis Kegiatan 📚:</strong> <span class="text-gray-800">{{ $data->jenis_kegiatan }}</span></p>
        <p><strong class="text-lg">Tanggal Kegiatan 📅:</strong> <span class="text-gray-800">{{ $data->tanggal_kegiatan }}</span></p>
        <p><strong class="text-lg">Deskripsi 🗣️:</strong> <span class="text-gray-800">{{ $data->deskripsi }}</span></p>
        <p><strong class="text-lg">Poin 🎯:</strong> <span class="text-gray-800">{{ $data->poin }}</span></p>
    </div>

    <div class="mt-6">
        <a href="{{ route('poin.index') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200 ease-in-out">
            🔙 Kembali ke Daftar Poin Mahasiswa
        </a>
    </div>
</div>
@endsection
