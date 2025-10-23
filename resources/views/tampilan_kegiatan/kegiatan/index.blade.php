@extends('layouts.dashboard_organisasi')

@section('title', 'Daftar Kegiatan')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Kegiatan</h1>
        <a href="{{ route('kegiatan-self.create') }}" 
           class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600 text-white">Tambah Kegiatan</a>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full table-auto border-collapse min-w-[600px]">
            <thead>
                <tr class="bg-gray-200 text-gray-800">
                    <th class="px-4 py-2 border">Nama Kegiatan</th>
                    <th class="px-4 py-2 border">Jenis</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Deskripsi</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kegiatans as $kegiatan)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ $kegiatan->nama_kegiatan }}</td>
                        <td class="px-4 py-2 border">{{ $kegiatan->jenis_kegiatan ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $kegiatan->tanggal_kegiatan }}</td>
                        <td class="px-4 py-2 border">{{ $kegiatan->deskripsi ?? '-' }}</td>
                        <td class="px-4 py-2 border flex gap-2">
                            <a href="{{ route('kegiatan-self.show', $kegiatan->id) }}"
                               class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Detail</a>
                            <a href="{{ url('kegiatan-self/'.$kegiatan->id.'/edit') }}"
                               class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ url('kegiatan-self/'.$kegiatan->id.'/destroy') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center px-4 py-2 border text-gray-800">Belum ada kegiatan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $kegiatans->links('pagination::tailwind') }}
    </div>

</div>
@endsection
