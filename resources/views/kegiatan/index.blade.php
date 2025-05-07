@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-blue-600">Daftar Kegiatan</h1>

    <a href="{{ route('kegiatan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-600">+ Tambah Kegiatan</a>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="border px-4 py-2">Nama Kegiatan</th>
                <th class="border px-4 py-2">Tanggal Kegiatan</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kegiatans as $kegiatan)
                <tr>
                    <td class="border px-4 py-2">{{ $kegiatan->nama_kegiatan }}</td>
                    <td class="border px-4 py-2">{{ $kegiatan->tanggal_kegiatan }}</td>
                    <td class="border px-4 py-2 flex gap-2">
                        <a href="{{ route('kegiatan.show', $kegiatan->id) }}" class="text-blue-600 hover:underline">Lihat</a>
                        <a href="{{ route('kegiatan.edit', $kegiatan->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center p-4">Belum ada data kegiatan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
