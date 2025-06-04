@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h1 class="text-2xl font-semibold mb-6">Daftar Anggota Organisasi Mahasiswa</h1>

    @if (session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">NIM</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Organisasi</th>
                <th class="border px-4 py-2">Jabatan</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->mahasiswa_nim }}</td>
                    <td class="border px-4 py-2">{{ $item->nama }}</td>
                    <td class="border px-4 py-2">{{ $item->nama_organisasi }}</td>
                    <td class="border px-4 py-2">{{ $item->jabatan }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('detail_organisasi_mahasiswa.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
