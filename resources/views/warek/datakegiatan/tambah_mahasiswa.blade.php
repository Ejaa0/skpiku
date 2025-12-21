@extends('layouts.dashboard_warek_utama')

@section('title', 'Tambah Mahasiswa ke Kegiatan')

@section('content')

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">🔍 Cari Mahasiswa untuk Kegiatan: {{ $kegiatan->nama_kegiatan }}</h1>

    <!-- Form Search -->
    <form action="{{ route('warek.datakegiatan.tambahanggota.create', $kegiatan->id) }}" method="GET" class="mb-4">
        <input type="text" name="search" placeholder="Cari berdasarkan NIM atau Nama"
               value="{{ request('search') }}"
               class="w-full p-2 rounded border border-gray-300">
    </form>

    <!-- Pesan sukses / error -->
    @if(session('success'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-2 bg-red-200 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="mb-4 p-2 bg-red-200 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tabel Mahasiswa -->
    <div class="bg-white p-6 rounded shadow">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b p-2">NIM</th>
                    <th class="border-b p-2">Nama</th>
                    <th class="border-b p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $search = request('search');
                    $filteredMahasiswa = $mahasiswa->filter(function($m) use ($search) {
                        return !$search || str_contains($m->nim, $search) || str_contains(strtolower($m->nama), strtolower($search));
                    });
                @endphp

                @forelse($filteredMahasiswa as $m)
                    <tr>
                        <td class="border-b p-2">{{ $m->nim }}</td>
                        <td class="border-b p-2">{{ $m->nama }}</td>
                        <td class="border-b p-2">
                            @if($kegiatan->mahasiswa->contains('nim', $m->nim))
                                <span class="text-green-600 font-semibold">✔ Sudah ditambahkan</span>
                            @else
                                <form action="{{ route('warek.datakegiatan.tambahanggota.store', $kegiatan->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="nim" value="{{ $m->nim }}">
                                    <button type="submit" 
                                            class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
                                            onclick="return confirm('Yakin ingin menambahkan mahasiswa ini ke kegiatan?')">
                                        ➕ Tambah
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-2">Tidak ada mahasiswa ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('warek.datakegiatan.show', $kegiatan->id) }}"
       class="inline-block mt-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
       ← Kembali ke Detail Kegiatan
    </a>
</div>
@endsection
