@extends('layouts.dashboard_organisasi')

@section('title', 'Edit Anggota Organisasi')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-green-600 mb-6">
        ✏️ Edit Anggota: {{ $anggota->nama }} ({{ $anggota->nim }})
    </h2>

    <form action="{{ route('organisasi.self.update_anggota', [$id_organisasi, $anggota->nim]) }}" method="POST" class="space-y-5 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
        @csrf

        <!-- NIM -->
        <div>
            <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">NIM</label>
            <input type="text" value="{{ $anggota->nim }}" disabled class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
        </div>

        <!-- Nama -->
        <div>
            <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Nama</label>
            <input type="text" value="{{ $anggota->nama }}" disabled class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
        </div>

        <!-- Jabatan / Divisi -->
        <div>
            <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Jabatan / Divisi</label>
            <select name="jabatan" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200">
                @php
                    $roles = [
                        'Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Anggota',
                        'Divisi Akademik', 'Divisi Acara', 'Divisi Olahraga', 'Divisi Multimedia', 
                        'Divisi Humas', 'Divisi Logistik'
                    ];
                @endphp
                @foreach($roles as $role)
                    <option value="{{ $role }}" {{ old('jabatan', $anggota->jabatan) === $role ? 'selected' : '' }}>
                        {{ $role }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status Keanggotaan -->
        <div>
            <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Status Keanggotaan</label>
            <select name="status_keanggotaan" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200">
                <option value="aktif" {{ old('status_keanggotaan', $anggota->status_keanggotaan) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status_keanggotaan', $anggota->status_keanggotaan) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <!-- Tombol -->
        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                💾 Simpan Perubahan
            </button>
            <a href="{{ route('organisasi.self.show', $id_organisasi) }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                ← Kembali
            </a>
        </div>
    </form>
</div>
@endsection
