@extends('layouts.dashboard_organisasi')

@section('title', 'Detail Organisasi')

@section('content')
<h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">Detail Organisasi</h2>

<div class="max-w-lg mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
    <div class="mb-4">
        <label class="block text-gray-600 dark:text-gray-300 font-semibold mb-1">ID Organisasi</label>
        <p class="text-gray-800 dark:text-gray-100 text-lg">{{ $organisasi->id_organisasi }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-gray-600 dark:text-gray-300 font-semibold mb-1">Nama Organisasi</label>
        <p class="text-gray-800 dark:text-gray-100 text-lg">{{ $organisasi->nama_organisasi }}</p>
    </div>

    <div class="flex justify-between mt-6">
        <a href="{{ route('organisasi.self.edit', $organisasi->id_organisasi) }}" 
           class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
        <a href="{{ route('organisasi.self.index') }}" 
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Kembali</a>
    </div>
</div>
@endsection
