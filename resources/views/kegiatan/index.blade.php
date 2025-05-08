@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4 text-yellow-600">Daftar Kegiatan</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('kegiatan.create') }}" class="mb-4 inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">+ Tambah Kegiatan</a>

    <table class="w-full table-auto border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">#</th>
                <th class="border p-2">Nama Kegiatan</th>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kegiatan as $item)
                <tr>
                    <td class="border p-2">{{ $loop->iteration }}</td>
                    <td class="border p-2">{{ $item->nama_kegiatan }}</td>
                    <td class="border p-2">{{ $item->tanggal_kegiatan }}</td>
                    <td class="border p-2 space-x-2">
                        <a href="{{ route('kegiatan.show', $item->id) }}" class="text-green-500 hover:underline">Show</a>
                        <a href="{{ route('kegiatan.edit', $item->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
