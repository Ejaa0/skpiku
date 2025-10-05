@extends('layouts.dashboard_organisasi')

@section('title', 'Edit Anggota Organisasi')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-green-600 mb-6">
        Edit Anggota: {{ $anggota->nama }} ({{ $anggota->nim }})
    </h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-200 text-red-800 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('organisasi.self.update_anggota', [$organisasi->id_organisasi, $anggota->nim]) }}" method="POST" class="bg-white shadow rounded p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-semibold">Nama Anggota</label>
            <input type="text" value="{{ $anggota->nama }}" class="w-full px-3 py-2 border rounded bg-gray-100" disabled>
        </div>

        <div>
            <label class="block mb-1 font-semibold">NIM</label>
            <input type="text" value="{{ $anggota->nim }}" class="w-full px-3 py-2 border rounded bg-gray-100" disabled>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Jabatan</label>
            <input type="text" name="jabatan" value="{{ old('jabatan', $anggota->jabatan) }}" class="w-full px-3 py-2 border rounded" placeholder="Masukkan jabatan">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Status Keanggotaan</label>
            <select name="status_keanggotaan" class="w-full px-3 py-2 border rounded">
                <option value="aktif" {{ old('status_keanggotaan', $anggota->status_keanggotaan) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak aktif" {{ old('status_keanggotaan', $anggota->status_keanggotaan) == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Update</button>
            <a href="{{ route('organisasi.self.show', $organisasi->id_organisasi) }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
        </div>
    </form>
</div>
@endsection
