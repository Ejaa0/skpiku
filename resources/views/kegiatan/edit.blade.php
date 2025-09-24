@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4 text-yellow-600">Edit Kegiatan</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('kegiatan.update', $kegiatan->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold">ID Kegiatan</label>
            <input type="text" name="id_kegiatan" value="{{ old('id_kegiatan', $kegiatan->id_kegiatan) }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Jenis Kegiatan</label>
            <select name="jenis_kegiatan" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Jenis Kegiatan --</option>
                <option value="Major" {{ old('jenis_kegiatan', $kegiatan->jenis_kegiatan) == 'Major' ? 'selected' : '' }}>Major</option>
                <option value="Reguler" {{ old('jenis_kegiatan', $kegiatan->jenis_kegiatan) == 'Reguler' ? 'selected' : '' }}>Reguler</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan) }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
            <a href="{{ route('kegiatan.index') }}" class="text-blue-500 hover:underline">← Batal</a>
        </div>
    </form>
</div>
@endsection
