@extends('layouts.dashboard_warek_utama')

@section('title', 'Tambah Anggota Organisasi')

@section('content')
<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">➕ Tambah Anggota</h1>

    <form action="{{ route('warek.dataorganisasi.anggota.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_organisasi" value="{{ $organisasi->id_organisasi }}">

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300">Pilih Mahasiswa</label>
            <select name="nim" class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200">
                @foreach($mahasiswa as $m)
                    <option value="{{ $m->nim }}">{{ $m->nim }} - {{ $m->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300">Jabatan</label>
            <input type="text" name="jabatan" class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300">Status Keanggotaan</label>
            <select name="status_keanggotaan" class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-400 text-white px-4 py-2 rounded-lg">
            Tambah Anggota
        </button>
    </form>
</div>
@endsection
