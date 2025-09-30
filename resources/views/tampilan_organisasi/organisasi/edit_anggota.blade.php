@extends('layouts.app')

@section('title', 'Edit Anggota Organisasi')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-green-600 mb-6">
        Edit Anggota: {{ $anggota->nim }}
    </h2>

    <form action="{{ route('organisasi.self.update_anggota', [$organisasi->id_organisasi, $anggota->nim]) }}" method="POST" class="bg-white shadow rounded p-6">
        @csrf
        @method('PUT')

        <!-- NIM -->
        <div class="mb-4">
            <label for="nim" class="block text-gray-700 font-medium mb-1">NIM</label>
            <input type="text" name="nim" id="nim" value="{{ $anggota->nim }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-300" readonly>
        </div>

        <!-- Nama -->
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 font-medium mb-1">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ $anggota->nama }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-300" readonly>
        </div>

        <!-- Jabatan -->
        <div class="mb-4">
            <label for="jabatan" class="block text-gray-700 font-medium mb-1">Jabatan</label>
            <select name="jabatan" id="jabatan" class="border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400">
                @php
                    $jabatanOptions = [
                        'Ketua', 'Wakil', 'Sekretaris', 'Bendahara',
                        'Divisi Akademik', 'Divisi Acara', 'Divisi Olahraga',
                        'Divisi Multimedia', 'Divisi Logistik', 'Divisi Humas', 'Divisi Kerohanian'
                    ];
                @endphp
                @foreach($jabatanOptions as $jabatan)
                    <option value="{{ $jabatan }}" {{ $anggota->jabatan == $jabatan ? 'selected' : '' }}>{{ $jabatan }}</option>
                @endforeach
            </select>
        </div>

        <!-- Status Keanggotaan -->
        <div class="mb-4">
            <label for="status_keanggotaan" class="block text-gray-700 font-medium mb-1">Status Keanggotaan</label>
            <select name="status_keanggotaan" id="status_keanggotaan" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-300">
                <option value="aktif" {{ $anggota->status_keanggotaan == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak aktif" {{ $anggota->status_keanggotaan == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('organisasi.self.show', $organisasi->id_organisasi) }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>
@endsection
