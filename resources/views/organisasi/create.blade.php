@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 mt-10 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-yellow-600 border-b pb-2">📝 Tambah Organisasi</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('organisasi.store') }}" method="POST" class="space-y-4">
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
            <label class="block font-semibold mb-1">Kegiatan</label>
            <input type="text" name="kegiatan" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Nama Organisasi</label>
            <input type="text" name="nama_organisasi" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Absensi</label>
            <select name="absensi" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
                <option value="HADIR">Hadir</option>
                <option value="TIDAK">Tidak Hadir</option>
            </select>
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-yellow-500 text-white font-semibold px-5 py-2 rounded hover:bg-yellow-600 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
