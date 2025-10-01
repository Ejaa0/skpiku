@extends('layouts.dashboard_organisasi')

@section('title', 'Daftar Kegiatan | SKPI UNAI')
@section('page-title', 'Daftar Kegiatan')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Daftar Kegiatan</h1>
        <a href="{{ route('kegiatan-self.create') }}"
           class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
            + Tambah Kegiatan
        </a>
    </div>

    <form action="{{ route('kegiatan-self.index') }}" method="GET" class="mb-4">
        <div class="flex">
            <input type="text" name="search" placeholder="Cari kegiatan..."
                   value="{{ request('search') }}"
                   class="w-full px-4 py-2 border rounded-l-lg focus:ring-2 focus:ring-green-400 dark:bg-gray-800 dark:text-gray-100">
            <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-r-lg hover:bg-green-700">
                Cari
            </button>
        </div>
    </form>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                    <th class="px-4 py-3 border-b">#</th>
                    <th class="px-4 py-3 border-b">NIM</th>
                    <th class="px-4 py-3 border-b">Nama</th>
                    <th class="px-4 py-3 border-b">Tanggal</th>
                    <th class="px-4 py-3 border-b">Nama Kegiatan</th>
                    <th class="px-4 py-3 border-b">Deskripsi</th>
                    <th class="px-4 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kegiatans as $kegiatan)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="px-4 py-2 border-b">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border-b">{{ $kegiatan->nim }}</td>
                        <td class="px-4 py-2 border-b">{{ $kegiatan->nama }}</td>
                        <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d-m-Y') }}</td>
                        <td class="px-4 py-2 border-b">{{ $kegiatan->nama_kegiatan }}</td>
                        <td class="px-4 py-2 border-b">{{ $kegiatan->deskripsi }}</td>
                        <td class="px-4 py-2 border-b text-center space-x-2">
                            <a href="{{ route('kegiatan-self.show', $kegiatan->id) }}"
                               class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm">Detail</a>
                            <a href="{{ route('kegiatan-self.edit', $kegiatan->id) }}"
                               class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm">Edit</a>
                            <form action="{{ route('kegiatan-self.destroy', $kegiatan->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-3 text-center text-gray-600 dark:text-gray-300">
                            Tidak ada data kegiatan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $kegiatans->links() }}
    </div>
</div>
@endsection
