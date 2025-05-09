@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
        <h2 class="text-2xl font-bold text-blue-600 mb-6">📝 Tambah Organisasi</h2>

        <form action="{{ route('organisasi.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium mb-1">NIM</label>
                <input type="text" name="nim" class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama</label>
                <input type="text" name="nama" class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Kegiatan</label>
                <input type="text" name="kegiatan" class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama Organisasi</label>
                <input type="text" name="nama_organisasi" class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Absensi</label>
                <select name="absensi" class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">-- Pilih Absensi --</option>
                    <option value="HADIR">HADIR</option>
                    <option value="TIDAK HADIR">TIDAK HADIR</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-xl hover:bg-blue-700 transition duration-200">
                ✅ Simpan
            </button>
        </form>
    </div>
</div>
@endsection
