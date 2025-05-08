@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-6">
    <div class="bg-white p-6 rounded-lg shadow-lg transition-all duration-300">
        <h2 class="text-3xl font-extrabold text-yellow-600 mb-6 border-b pb-2">📅 Daftar Kegiatan</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded mb-4 animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('kegiatan.create') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-5 py-2 rounded shadow transition-transform transform hover:scale-105">
                + Tambah Kegiatan
            </a>
        </div>

        <div class="overflow-x-auto rounded">
            <table class="min-w-full table-auto border border-gray-300 bg-white">
                <thead class="bg-gray-100 text-gray-700 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 border">No</th>
                        <th class="px-4 py-3 border">Nama Kegiatan</th>
                        <th class="px-4 py-3 border">Tanggal</th>
                        <th class="px-4 py-3 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                    @foreach($kegiatan as $item)
                        <tr class="hover:bg-yellow-50 transition-all duration-200">
                            <td class="border px-4 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-3">{{ $item->nama_kegiatan }}</td>
                            <td class="border px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d F Y') }}</td>
                            <td class="border px-4 py-3 text-center space-x-3">
                                <a href="{{ route('kegiatan.show', $item->id) }}" class="text-green-600 hover:underline font-medium">Lihat</a>
                                <a href="{{ route('kegiatan.edit', $item->id) }}" class="text-blue-600 hover:underline font-medium">Edit</a>
                                <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline font-medium">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($kegiatan->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-6">Belum ada kegiatan yang tercatat.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
