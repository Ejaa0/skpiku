@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 px-6">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-blue-600 mb-6">Tambah Kegiatan</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kegiatan.store') }}" method="POST" class="space-y-4">
            @csrf

            
            <div>
                <label for="id_kegiatan" class="block font-semibold">ID Kegiatan</label>
                <input type="text" name="id_kegiatan" id="id_kegiatan" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label for="jenis_kegiatan" class="block font-semibold">Jenis Kegiatan</label>
                <input type="text" name="jenis_kegiatan" id="jenis_kegiatan" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label for="nama_kegiatan" class="block font-semibold">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label for="tanggal_kegiatan" class="block font-semibold">Tanggal Kegiatan</label>
                <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            
            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
