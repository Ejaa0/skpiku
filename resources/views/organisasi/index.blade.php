@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-6">
    <div class="bg-white p-6 rounded-lg shadow-xl">
        <h2 class="text-4xl font-extrabold text-blue-600 mb-6 border-b pb-2">Daftar Organisasi</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('organisasi.create') }}" class="inline-block bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg mb-4">
            + Tambah Organisasi
        </a>

        <div class="overflow-x-auto rounded-lg shadow-lg mt-6">
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
                    @foreach($organisasi as $item)
                        <tr>
                            <td class="border-b px-4 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="border-b px-4 py-3">{{ $item->id_organisasi }}</td>
                            <td class="border-b px-4 py-3">{{ $item->nama_organisasi }}</td>
                            <td class="border-b px-4 py-3 text-center">
                                <div class="space-x-3">
                                    {{-- Gunakan id_organisasi agar route show bekerja --}}
                                    <a href="{{ route('organisasi.show', $item->id_organisasi) }}" class="inline-block text-green-600 hover:text-green-800">👁️ Show</a>
                                    <a href="{{ route('organisasi.edit', $item->id_organisasi) }}" class="inline-block text-blue-600 hover:text-blue-800">✏️ Edit</a>
                                    <form action="{{ route('organisasi.destroy', $item->id_organisasi) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus organisasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">🗑️ Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if($organisasi->isEmpty())
                        <tr class="text-center">
                            <td colspan="4" class="text-gray-500 py-6">Belum ada organisasi yang tercatat.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
