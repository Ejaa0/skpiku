@extends('layouts.dashboard_warek_utama')

@section('title', 'Edit Organisasi')

@section('content')
<div class="max-w-md mx-auto bg-gray-800 p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold text-white mb-4">Edit Organisasi</h1>

    <form action="{{ route('warek.dataorganisasi.update', $organisasi->id_organisasi) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- ID Organisasi --}}
        <div class="mb-4">
            <label class="block text-gray-300 mb-1">ID Organisasi</label>
            <input type="text" name="id_organisasi" 
                   value="{{ $organisasi->id_organisasi }}" 
                   class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
        </div>

        {{-- Nama Organisasi --}}
        <div class="mb-4">
            <label class="block text-gray-300 mb-1">Nama Organisasi</label>
            <input type="text" name="nama_organisasi" 
                   value="{{ $organisasi->nama_organisasi }}" 
                   class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
        </div>

        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>
</div>
@endsection
