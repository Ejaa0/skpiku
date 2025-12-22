@extends('layouts.dashboard_organisasi')

@section('title', 'Edit Kegiatan')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Kegiatan</h1>

    <form action="{{ url('kegiatan-self/'.$kegiatan->id.'/update') }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        <!-- jangan pakai @method('PUT'), route pakai POST -->

        <!-- Nama Kegiatan -->
        <div>
            <label class="text-gray-800 font-semibold">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" 
                   value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" 
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
                <option value="Major" {{ old('jenis_kegiatan', $kegiatan->jenis_kegiatan) == 'Major' ? 'selected' : '' }}>Major</option>
                <option value="Reguler" {{ old('jenis_kegiatan', $kegiatan->jenis_kegiatan) == 'Reguler' ? 'selected' : '' }}>Reguler</option>
            </select>
            @error('jenis_kegiatan') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Tanggal Kegiatan -->
        <div>
            <label class="text-gray-800 font-semibold">Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan" 
                   value="{{ old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan) }}" 
                   class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   required>
            @error('tanggal_kegiatan') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Deskripsi -->
        

        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600 text-white">Update</button>
            <a href="{{ route('kegiatan-self.index') }}" class="bg-gray-400 px-4 py-2 rounded hover:bg-gray-500 text-white">Batal</a>
        </div>
    </form>
</div>
@endsection
