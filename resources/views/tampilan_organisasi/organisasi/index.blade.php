@extends('layouts.dashboard_organisasi')

@section('title', 'Data Organisasi')

@section('content')
<h2 class="text-2xl font-bold mb-4">Data Organisasi</h2>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
@endif

<a href="{{ route('organisasi.self.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah Organisasi</a>

<table class="w-full border-collapse border">
    <thead>
        <tr class="bg-gray-200">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Nama Organisasi</th>
            <th class="border px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($organisasi as $org)
        <tr>
            <td class="border px-4 py-2">{{ $org->id_organisasi }}</td>
            <td class="border px-4 py-2">{{ $org->nama_organisasi }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('organisasi.self.edit', $org->id_organisasi) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                <form action="{{ route('organisasi.self.destroy', $org->id_organisasi) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
