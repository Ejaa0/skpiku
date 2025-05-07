@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">➕ Tambah Kegiatan</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded shadow">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kegiatan.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        <div>
            <label class="block mb-1 font-medium">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-blue-500" required>
        </div>
        <div>
            <label class="block mb-1 font-medium">Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan" class="w-full border border-gray-300 rounded px-4 py-2" required>
        </div>
        <div>
            <label class="block mb-1 font-medium">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded px-4 py-2"></textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>
    </form>
</div>
@endsection
