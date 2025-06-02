@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <h2 class="text-3xl font-bold text-blue-700 mb-6">Daftar Detail Kegiatan Mahasiswa 🧾</h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto text-left border">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">NIM</th>
                    <th class="px-4 py-2 border">Nama Mahasiswa</th>
                    <th class="px-4 py-2 border">Nama Kegiatan</th>
                    <th class="px-4 py-2 border">Tanggal Kegiatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $item->nim }}</td>
                        <td class="px-4 py-2 border">{{ $item->nama }}</td>
                        <td class="px-4 py-2 border">{{ $item->nama_kegiatan }}</td>
                        <td class="px-4 py-2 border">{{ $item->tanggal_kegiatan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data kegiatan mahasiswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
