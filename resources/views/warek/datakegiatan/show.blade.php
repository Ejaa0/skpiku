@extends('layouts.dashboard_warek_utama')

@section('title', 'Detail Kegiatan')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">📋 Detail Kegiatan</h1>

    <div class="bg-white p-6 rounded shadow mb-6">
        <p class="mb-2">🔢 <strong>ID Kegiatan:</strong> {{ $kegiatan->id }}</p>
        <p class="mb-2">🏷️ <strong>Jenis Kegiatan:</strong> {{ $kegiatan->jenis_kegiatan }}</p>
        <p class="mb-2">📌 <strong>Nama Kegiatan:</strong> {{ $kegiatan->nama_kegiatan }}</p>
        <p class="mb-2">📅 <strong>Tanggal Kegiatan:</strong> {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d F Y') }}</p>

        <!-- Tombol tambah mahasiswa -->
        <a href="{{ route('warek.datakegiatan.tambahanggota.create', $kegiatan->id) }}" 
           class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
           + Tambah Mahasiswa
        </a>
    </div>

    <h2 class="text-xl font-semibold mb-2">Daftar Mahasiswa yang Mengikuti</h2>

    @if($kegiatan->mahasiswa->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b">No</th>
                        <th class="px-4 py-2 border-b">NIM</th>
                        <th class="px-4 py-2 border-b">Nama Mahasiswa</th>
                        <th class="px-4 py-2 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kegiatan->mahasiswa as $index => $mhs)
                        <tr class="text-center">
                            <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border-b">{{ $mhs->nim }}</td>
                            <td class="px-4 py-2 border-b">{{ $mhs->nama }}</td>
                            <td class="px-4 py-2 border-b">
                                <form action="{{ route('warek.datakegiatan.tambahanggota.destroy', [$kegiatan->id, $mhs->nim]) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini dari kegiatan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>Belum ada mahasiswa yang mengikuti kegiatan ini.</p>
    @endif

    <a href="{{ route('warek.datakegiatan.index') }}" 
       class="inline-block mt-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
       ← Kembali ke Daftar
    </a>
</div>
@endsection
