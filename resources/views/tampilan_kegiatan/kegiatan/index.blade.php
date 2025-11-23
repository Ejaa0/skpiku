@extends('layouts.dashboard_organisasi')

@section('content')
<div class="flex flex-col space-y-6">

    {{-- Header & Search --}}
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Daftar Kegiatan</h1>
        <form action="{{ route('kegiatan-self.index') }}" method="GET" class="flex space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kegiatan..."
                   class="px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-400">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">
                Cari
            </button>
        </form>
    </div>

    {{-- Tambah Kegiatan --}}
    <div>
        <a href="{{ route('kegiatan-self.create') }}" 
           class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition">
            + Tambah Kegiatan
        </a>
    </div>

    {{-- Tabel Kegiatan --}}
    <div class="overflow-x-auto bg-white rounded-2xl shadow-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($kegiatans as $kegiatan)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $kegiatan->id_kegiatan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $kegiatan->nama_kegiatan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $kegiatan->tanggal_kegiatan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $kegiatan->jenis_kegiatan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap space-x-2">

                            {{-- Show --}}
                            <a href="{{ route('kegiatan-self.show', $kegiatan->id) }}"
                               class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-400 transition">
                                Lihat
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('kegiatan-self.edit', $kegiatan->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-400 transition">
                                Edit
                            </a>

                            {{-- Hapus --}}
                            <form action="{{ route('kegiatan-self.destroy', $kegiatan->id) }}" 
                                  method="POST" class="inline-block"
                                  onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-500 transition">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Belum ada kegiatan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $kegiatans->links() }}
    </div>
</div>
@endsection
