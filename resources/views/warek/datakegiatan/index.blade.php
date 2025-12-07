@extends('layouts.dashboard_warek_utama')

@section('content')
<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md animate-fadeIn">
    <h1 class="text-2xl font-bold text-primary mb-4">Data Kegiatan WR III</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Nama Kegiatan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Tanggal Kegiatan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Deskripsi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($kegiatan as $index => $item)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama_kegiatan }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d-m-Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $item->deskripsi }}</td>
                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                    <a href="{{ route('warek.datakegiatan.show', $item->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Lihat</a>
                    <a href="{{ route('warek.datakegiatan.edit', $item->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                    <form action="{{ route('warek.datakegiatan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
