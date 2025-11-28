@extends('dashboard_warek_utama')

@section('title', 'Tambah Anggota Organisasi')

@section('content')
<div class="p-6">

    <h2 class="text-2xl font-bold text-white mb-6">Tambah Anggota Organisasi</h2>

    <div class="bg-gray-800 text-white p-6 rounded-xl shadow-lg">

        <form action="{{ route('detail_organisasi.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- NIM --}}
            <div>
                <label class="block text-sm font-medium mb-1">NIM Mahasiswa</label>
                <input type="text" name="nim"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:ring focus:ring-blue-600"
                    value="{{ old('nim') }}" required>
                @error('nim')
                    <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium mb-1">Nama Mahasiswa</label>
                <input type="text" name="nama"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600"
                    value="{{ old('nama') }}" required>
                @error('nama')
                    <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- ID Organisasi --}}
            <div>
                <label class="block text-sm font-medium mb-1">ID Organisasi</label>
                <input type="text" name="id_organisasi"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600"
                    value="{{ old('id_organisasi') }}" required>
                @error('id_organisasi')
                    <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Organisasi --}}
            <div>
                <label class="block text-sm font-medium mb-1">Nama Organisasi</label>
                <input type="text" name="nama_organisasi"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600"
                    value="{{ old('nama_organisasi') }}" required>
                @error('nama_organisasi')
                    <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Absensi --}}
            <div>
                <label class="block text-sm font-medium mb-1">Absensi / Keikutsertaan</label>
                <input type="number" name="absensi"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600"
                    value="{{ old('absensi') }}" required>
                @error('absensi')
                    <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('detail_organisasi.index') }}"
                    class="px-4 py-2 rounded-lg bg-gray-600 hover:bg-gray-500 transition">
                    Kembali
                </a>

                <button type="submit"
                    class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 transition">
                    Simpan Data
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
