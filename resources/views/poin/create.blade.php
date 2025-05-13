@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-6">
    <h2 class="text-xl font-semibold mb-4">Tambah Poin Mahasiswa</h2>

    <form action="{{ route('poin.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @include('poin.form')
        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan</button>
            <a href="{{ route('poin.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
        </div>
    </form>
</div>
@endsection
