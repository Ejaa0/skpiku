@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-12 px-6">
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-yellow-300">
        <h2 class="text-3xl font-extrabold text-yellow-600 mb-6 border-b pb-2">📋 Detail Kegiatan</h2>

        <div class="flex justify-between mb-4">
            <span class="font-semibold">🔢 ID Kegiatan:</span>
            <span>{{ $kegiatan->id_kegiatan }}</span>
        </div>

        <div class="flex justify-between mb-4">
            <span class="font-semibold">🏷️ Jenis Kegiatan:</span>
            <span>{{ $kegiatan->jenis_kegiatan }}</span>
        </div>

        <div class="flex justify-between mb-4">
            <span class="font-semibold">📌 Nama Kegiatan:</span>
            <span>{{ $kegiatan->nama_kegiatan }}</span>
        </div>

        <div class="flex justify-between">
            <span class="font-semibold">📅 Tanggal Kegiatan:</span>
            <span>{{ optional(\Carbon\Carbon::parse($kegiatan->tanggal_kegiatan))->translatedFormat('d F Y') }}</span>
        </div>
    </div>

    {{-- Tombol Tambah Mahasiswa --}}
    <div class="mt-8 flex justify-end">
        <a href="{{ route('kegiatan.tambahMahasiswaForm', $kegiatan->id_kegiatan) }}"
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
           + Tambah Mahasiswa
        </a>
    </div>

    {{-- DAFTAR MAHASISWA --}}
    <div class="mt-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Mahasiswa yang Mengikuti</h3>
        @if($data->isEmpty())
            <p class="text-gray-500">Belum ada mahasiswa yang mengikuti kegiatan ini.</p>
        @else
            <table class="min-w-full border rounded-lg overflow-hidden shadow">
                <thead class="bg-yellow-100 text-yellow-800">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">NIM</th>
                        <th class="px-4 py-2 border">Nama Mahasiswa</th>
                        <th class="px-4 py-2 border">Aksi</th> {{-- Kolom untuk tombol hapus --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $index => $mhs)
                    <tr class="@if($index % 2 == 0) bg-yellow-50 @endif">
                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $mhs->nim }}</td>
                        <td class="px-4 py-2 border">{{ $mhs->nama }}</td>
                        <td class="px-4 py-2 border">
                            <form action="{{ route('kegiatan.hapusMahasiswa', [$kegiatan->id_kegiatan, $mhs->nim]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini dari kegiatan?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 flex items-center gap-1">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="mt-8 text-right">
        <a href="{{ route('kegiatan.index') }}" class="text-sm bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">← Kembali ke Daftar</a>
    </div>
</div>
@endsection
