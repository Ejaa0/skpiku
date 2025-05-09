@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow mt-8">
    <h2 class="text-2xl font-bold mb-4">Daftar Poin Mahasiswa</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol Tambah Poin Mahasiswa --}}
    <div class="mb-4">
        <a href="{{ route('poin.create') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
            + Tambah Poin Mahasiswa
        </a>
    </div>

    <table class="min-w-full table-auto">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">NIM</th>
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">Nama Kegiatan</th>
                <th class="px-4 py-2 border">Jumlah Poin</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($poinMahasiswa as $poin)
                <tr>
                    <td class="px-4 py-2 border">{{ $poin->nim }}</td>
                    <td class="px-4 py-2 border">{{ $poin->nama }}</td>
                    <td class="px-4 py-2 border">{{ $poin->nama_kegiatan }}</td>
                    <td class="px-4 py-2 border">{{ $poin->jumlah_poin }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('poin.show', $poin->id) }}" class="text-blue-500 hover:underline">Detail</a> |
                        <a href="{{ route('poin.edit', $poin->id) }}" class="text-yellow-500 hover:underline">Edit</a> |
                        <form action="{{ route('poin.destroy', $poin->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
