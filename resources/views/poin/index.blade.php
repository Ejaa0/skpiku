@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Poin Mahasiswa</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('poin.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Data</a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border">NIM</th>
                <th class="py-2 px-4 border">Nama</th>
                <th class="py-2 px-4 border">Tipe</th>
                <th class="py-2 px-4 border">Poin</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr class="text-center">
                    <td class="py-2 px-4 border">{{ $item->nim }}</td>
                    <td class="py-2 px-4 border">{{ $item->nama }}</td>
                    <td class="py-2 px-4 border capitalize">{{ $item->tipe }}</td>
                    <td class="py-2 px-4 border">{{ $item->poin }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('poin.show', $item->id) }}" class="text-blue-600 hover:underline">Detail</a> |
                        <a href="{{ route('poin.edit', $item->id) }}" class="text-yellow-600 hover:underline">Edit</a> |
                        <form action="{{ route('poin.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-4 text-center">Belum ada data poin mahasiswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
