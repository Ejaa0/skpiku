@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
        <h2 class="text-2xl font-bold text-yellow-500 mb-6">✏️ Edit Organisasi</h2>

        <form action="{{ route('organisasi.update', $organisasi->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-medium mb-1">NIM</label>
                <input type="text" name="nim" value="{{ old('nim', $organisasi->nim) }}" class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $organisasi->nama) }}" class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Kegiatan</label>
                <input type="text" name="kegiatan" value="{{ old('kegiatan', $organisasi->kegiatan) }}" class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama Organisasi</label>
                <input type="text" name="nama_organisasi" value="{{ old('nama_organisasi', $organisasi->nama_organisasi) }}" class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Absensi</label>
                <select name="absensi" class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
                    <option value="">-- Pilih Absensi --</option>
                    <option value="HADIR" {{ $organisasi->absensi == 'HADIR' ? 'selected' : '' }}>HADIR</option>
                    <option value="TIDAK HADIR" {{ $organisasi->absensi == 'TIDAK HADIR' ? 'selected' : '' }}>TIDAK HADIR</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-yellow-500 text-white py-2 px-4 rounded-xl hover:bg-yellow-600 transition duration-200">
                💾 Update
            </button>
        </form>
    </div>
</div>
@endsection
