@extends('layouts..dashboard_organisasi')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Kegiatan</h1>

    <a href="{{ route('kegiatan-self.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Tambah Kegiatan</a>

    @if(session('success'))
        <div class="mt-4 bg-green-100 text-green-800 p-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">ID</th>
                <th class="border p-2">Nama Kegiatan</th>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kegiatans as $kegiatan)
                <tr>
                    <td class="border p-2">{{ $loop->iteration }}</td>
                    <td class="border p-2">{{ $kegiatan->nama_kegiatan }}</td>
                    <td class="border p-2">{{ $kegiatan->tanggal_kegiatan }}</td>
                    <td class="border p-2">
                        <a href="{{ route('kegiatan-self.show', $kegiatan->id) }}" class="text-blue-600">Lihat</a> |
                        <a href="{{ route('kegiatan-self.edit', $kegiatan->id) }}" class="text-yellow-600">Edit</a> |
                        <form action="{{ route('kegiatan-self.destroy', $kegiatan->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin hapus?')" class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="border p-2 text-center">Belum ada data kegiatan</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $kegiatans->links() }}
    </div>
</div>
@endsection
