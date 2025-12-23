@extends('layouts.dashboard_warek_utama')

@section('title', 'Edit Organisasi')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-6">Edit Organisasi</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('warek.dataorganisasi.update', $organisasi->id_organisasi) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_organisasi" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Organisasi</label>
            <input type="text" name="nama_organisasi" id="nama_organisasi"
                   value="{{ old('nama_organisasi', $organisasi->nama_organisasi) }}"
                   class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200">
            @error('nama_organisasi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex space-x-2">
            <button type="submit"
                    class="px-4 py-2 bg-primary text-white rounded hover:bg-primary/80">Simpan</button>
            <a href="{{ route('warek.dataorganisasi.index') }}"
               class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</a>
        </div>
    </form>
</div>
@endsection
