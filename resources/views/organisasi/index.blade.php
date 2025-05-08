@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-lg mt-8">
    <h2 class="text-3xl font-semibold mb-6 text-gray-800">Daftar Organisasi</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol Tambah Organisasi --}}
    <div class="mb-6 text-right">
        <a href="{{ route('organisasi.create') }}" class="bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300 transition ease-in-out duration-300">
            + Tambah Organisasi
        </a>
    </div>

    <div class="overflow-x-auto shadow-lg rounded-lg">
        <table class="min-w-full table-auto text-sm text-gray-600">
            <thead class="bg-yellow-200">
                <tr>
                    <th class="px-6 py-3 text-left font-medium">NIM</th>
                    <th class="px-6 py-3 text-left font-medium">Nama</th>
                    <th class="px-6 py-3 text-left font-medium">Nama Organisasi</th>
                    <th class="px-6 py-3 text-left font-medium">Absensi</th>
                    <th class="px-6 py-3 text-left font-medium">Kegiatan</th>
                    <th class="px-6 py-3 text-center font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($organisasis as $organisasi)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $organisasi->nim }}</td>
                        <td class="px-6 py-4">{{ $organisasi->nama }}</td>
                        <td class="px-6 py-4">{{ $organisasi->nama_organisasi }}</td>
                        <td class="px-6 py-4">{{ $organisasi->absensi }}</td>
                        <td class="px-6 py-4">{{ $organisasi->kegiatan->nama_kegiatan }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('organisasi.edit', $organisasi->id) }}" class="text-yellow-600 hover:underline focus:outline-none focus:ring-2 focus:ring-yellow-300">Edit</a>
                            <form action="{{ route('organisasi.destroy', $organisasi->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline focus:outline-none focus:ring-2 focus:ring-red-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
