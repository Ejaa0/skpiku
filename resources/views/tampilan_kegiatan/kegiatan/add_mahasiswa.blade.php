@extends('layouts.dashboard_organisasi')

@section('title', 'Tambah Mahasiswa ke Kegiatan')

@section('content')
<div class="p-6 max-w-xl mx-auto bg-white dark:bg-gray-800 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">
        Tambah Mahasiswa ke {{ $kegiatan->nama_kegiatan }}
    </h1>

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('kegiatan-self.storeMahasiswa', $kegiatan->id) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="mahasiswa_nim" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Pilih Mahasiswa</label>
            <select name="mahasiswa_nim" id="mahasiswa_nim" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-100">
                <option value="">-- Pilih Mahasiswa --</option>
                @foreach($mahasiswas as $mahasiswa)
                    <option value="{{ $mahasiswa->nim }}">
                        {{ $mahasiswa->nim }} - {{ $mahasiswa->nama }}
                    </option>
                @endforeach
            </select>
            @error('mahasiswa_nim')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Tambah Mahasiswa
        </button>
    </form>

    <a href="{{ route('kegiatan-self.show', $kegiatan->id) }}" class="mt-4 inline-block text-blue-600 hover:underline">
        Kembali ke Detail Kegiatan
    </a>
</div>
@endsection
