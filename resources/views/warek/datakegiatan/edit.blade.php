@extends('layouts.dashboard_warek_utama')

@section('content')

<div class="p-6 bg-white text-gray-900 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Edit Kegiatan</h1>

    <form action="{{ route('warek.datakegiatan.update', $kegiatan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="jenis_kegiatan" class="block mb-1 font-semibold">Jenis Kegiatan</label>
            <select name="jenis_kegiatan" id="jenis_kegiatan" class="w-full p-2 rounded border border-gray-300 bg-white">
                <option value="Reguler" {{ $kegiatan->jenis_kegiatan == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                <option value="Non-Reguler" {{ $kegiatan->jenis_kegiatan == 'Non-Reguler' ? 'selected' : '' }}>Non-Reguler</option>
            </select>
            @error('jenis_kegiatan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="nama_kegiatan" class="block mb-1 font-semibold">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" class="w-full p-2 rounded border border-gray-300 bg-white">
            @error('nama_kegiatan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="tanggal_kegiatan" class="block mb-1 font-semibold">Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan) }}" class="w-full p-2 rounded border border-gray-300 bg-white">
            @error('tanggal_kegiatan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center space-x-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded text-white font-semibold">Simpan Perubahan</button>
            <a href="{{ route('warek.datakegiatan.index') }}" class="px-4 py-2 bg-gray-400 hover:bg-gray-500 rounded text-white font-semibold">Kembali</a>
        </div>
    </form>

</div>
@endsection
