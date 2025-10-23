@extends('layouts.dashboard_organisasi')

@section('title', 'Tambah Kegiatan')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Kegiatan</h1>

    <form action="{{ route('kegiatan-self.store') }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
        @csrf

        <!-- ID Kegiatan -->
        <div>
            <label class="text-gray-800 font-semibold">ID Kegiatan</label>
            <input type="number" name="id_kegiatan" value="{{ old('id_kegiatan') }}"
                   class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
            @error('id_kegiatan') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Nama Kegiatan -->
        <div>
            <label class="text-gray-800 font-semibold">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}"
                   class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
            @error('nama_kegiatan') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Jenis Kegiatan -->
        <div>
            <label class="text-gray-800 font-semibold">Jenis Kegiatan</label>
            <select name="jenis_kegiatan"
                    class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Jenis Kegiatan --</option>
                <option value="Major" {{ old('jenis_kegiatan') == 'Major' ? 'selected' : '' }}>Major</option>
                <option value="Reguler" {{ old('jenis_kegiatan') == 'Reguler' ? 'selected' : '' }}>Reguler</option>
            </select>
            @error('jenis_kegiatan') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Tanggal Kegiatan -->
        <div>
            <label class="text-gray-800 font-semibold">Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}"
                   class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
            @error('tanggal_kegiatan') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="text-gray-800 font-semibold">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                      class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600 text-white">Simpan</button>
            <a href="{{ route('kegiatan-self.index') }}" class="bg-gray-400 px-4 py-2 rounded hover:bg-gray-500 text-white">Batal</a>
        </div>
    </form>
</div>
@endsection
