@extends('layouts.dashboard_organisasi')

@section('title', 'Tambah Organisasi')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Organisasi</h2>

@if ($errors->any())
<div class="mb-4 p-3 bg-red-200 text-red-800 rounded">
    <ul>
        @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('organisasi.self.store') }}" method="POST" class="space-y-4 max-w-lg">
    @csrf
    <div>
        <label class="block mb-1 font-semibold">ID Organisasi</label>
        <input type="text" value="Auto" readonly
               class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Nama Organisasi</label>
        <input type="text" name="nama_organisasi" value="{{ old('nama_organisasi') }}" 
               class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600" required>
    </div>
    <div class="flex gap-2">
        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Simpan</button>
        <a href="{{ route('organisasi.self.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
    </div>
</form>
@endsection
