@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-6">
    <div class="bg-white p-6 rounded-lg shadow-xl">
        <h2 class="text-4xl font-bold mb-6">Edit Organisasi</h2>

        <form action="{{ route('organisasi.update', $organisasi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="id_organisasi" class="block text-sm font-semibold">ID Organisasi</label>
                <input type="text" name="id_organisasi" value="{{ $organisasi->id_organisasi }}" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="nama_organisasi" class="block text-sm font-semibold">Nama Organisasi</label>
                <input type="text" name="nama_organisasi" value="{{ $organisasi->nama_organisasi }}" class="w-full p-2 border rounded">
            </div>

            {{-- keanggotaan tidak ditampilkan, tapi dikirim ke controller --}}
            <input type="hidden" name="keanggotaan" value="{{ $organisasi->keanggotaan }}">

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</div>
@endsection
