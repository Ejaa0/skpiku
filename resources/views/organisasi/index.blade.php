@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-6">
    <div class="bg-white p-6 rounded-lg shadow-xl">
        <h2 class="text-4xl font-extrabold text-blue-600 mb-6 border-b pb-2">Daftar Organisasi</h2>

        {{-- Alert sukses --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tombol tambah organisasi --}}
        <a href="{{ route('organisasi.create') }}" class="inline-block bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg mb-4 hover:bg-blue-700">
            + Tambah Organisasi
        </a>

        {{-- Form search --}}
        <form action="{{ route('organisasi.index') }}" method="GET" class="mb-6 mt-2">
            <div class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama organisasi..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Cari
                </button>
            </div>
        </form>

        {{-- Tabel organisasi --}}
        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="min-w-full table-auto border-separate border-spacing-0">
                <thead class="bg-blue-600 text-white text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b">No</th>
                        <th class="px-4 py-3 border-b">ID Organisasi</th>
                        <th class="px-4 py-3 border-b">Nama Organisasi</th>
                        <th class="px-4 py-3 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800 bg-white">
                    @forelse($organisasi as $item)
                        <tr>
                            <td class="border-b px-4 py-3 text-center">{{ ($organisasi->currentPage() - 1) * $organisasi->perPage() + $loop->iteration }}</td>
                            <td class="border-b px-4 py-3">{{ $item->id_organisasi }}</td>
                            <td class="border-b px-4 py-3">{{ $item->nama_organisasi }}</td>
                            <td class="border-b px-4 py-3 text-center">
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('organisasi.show', $item->id_organisasi) }}" class="text-green-600 hover:text-green-800">👁️ Show</a>
                                    <a href="{{ route('organisasi.edit', $item->id_organisasi) }}" class="text-blue-600 hover:text-blue-800">✏️ Edit</a>
                                    <form action="{{ route('organisasi.destroy', $item->id_organisasi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus organisasi ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">🗑️ Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="4" class="text-gray-500 py-6">Belum ada organisasi yang tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $organisasi->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
