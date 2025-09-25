@extends('layouts.dashboard_organisasi')

@section('title', 'Tambah Mahasiswa ke Organisasi')

@section('content')
<h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">Tambah Mahasiswa</h2>

<div class="max-w-lg mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
    <form action="{{ route('detail-organisasi-mahasiswa.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="organisasi_id" value="{{ $organisasi->id_organisasi }}">

        <div>
            <label for="mahasiswa_nim" class="block text-gray-600 dark:text-gray-300 font-semibold mb-1">NIM Mahasiswa</label>
            <input type="text" id="mahasiswa_nim" name="mahasiswa_nim" 
                   class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600" required>
        </div>

        <div>
            <label for="nama_mahasiswa" class="block text-gray-600 dark:text-gray-300 font-semibold mb-1">Nama Mahasiswa</label>
            <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" 
                   class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600" required>
        </div>

        <div>
            <label for="jabatan" class="block text-gray-600 dark:text-gray-300 font-semibold mb-1">Jabatan</label>
            <input type="text" id="jabatan" name="jabatan" 
                   class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600">
        </div>

        <div>
            <label for="status_keanggotaan" class="block text-gray-600 dark:text-gray-300 font-semibold mb-1">Status Keanggotaan</label>
            <select id="status_keanggotaan" name="status_keanggotaan" 
                    class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600">
                <option value="Aktif">Aktif</option>
                <option value="Non-Aktif">Non-Aktif</option>
            </select>
        </div>

        <div class="flex justify-between mt-6">
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Simpan</button>
            <a href="{{ route('organisasi.self.show', $organisasi->id_organisasi) }}" 
               class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
        </div>
    </form>
</div>
@endsection
