@extends('layouts.app')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">📅 Daftar Kegiatan</h1>
    <a href="{{ route('kegiatan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah</a>
</div>

@if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
    <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
        <tr>
            <th class="px-6 py-3">Nama</th>
            <th class="px-6 py-3">Tanggal</th>
            <th class="px-6 py-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kegiatans as $kegiatan)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-6 py-4">{{ $kegiatan->nama_kegiatan }}</td>
                <td class="px-6 py-4">{{ $kegiatan->tanggal_kegiatan }}</td>
                <td class="px-6 py-4 flex space-x-2">
                    <a href="{{ route('kegiatan.show', $kegiatan) }}" class="text-blue-600">Lihat</a>
                    <a href="{{ route('kegiatan.edit', $kegiatan) }}" class="text-yellow-500">Edit</a>
                    <form action="{{ route('kegiatan.destroy', $kegiatan) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3" class="px-6 py-4 text-gray-500 text-center">Belum ada kegiatan.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
