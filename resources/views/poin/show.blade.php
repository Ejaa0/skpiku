@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Detail Poin Mahasiswa</h1>

    <div class="bg-white p-6 rounded shadow space-y-3">
        <p><strong>NIM:</strong> {{ $poin->nim }}</p>
        <p><strong>Nama:</strong> {{ $poin->nama }}</p>
        <p><strong>Poin:</strong> {{ $poin->poin }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('poin.index') }}" class="text-blue-600 hover:underline">← Kembali</a>
    </div>
</div>
@endsection
