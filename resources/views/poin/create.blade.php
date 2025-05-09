@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 mt-10 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-yellow-600 border-b pb-2">📝 Tambah Poin Mahasiswa</h2>

    <form action="{{ route('poin.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold mb-1">NIM</label>
            <input type="text" name="nim" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" name="nama" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Jumlah Poin</label>
            <input type="number" name="jumlah_poin" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-yellow-500 text-white font-semibold px-5 py-2 rounded hover:bg-yellow-600 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
