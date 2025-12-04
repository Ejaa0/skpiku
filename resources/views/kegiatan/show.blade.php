@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto mt-12 px-4 sm:px-6 lg:px-8">

    {{-- Detail Kegiatan --}}
    <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 border border-yellow-300">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-yellow-600 mb-6 border-b pb-2">📋 Detail Kegiatan</h2>

        <div class="space-y-4 sm:space-y-0 sm:flex sm:justify-between sm:gap-6 mb-6">
            <div class="flex justify-between sm:flex-col sm:items-start w-full sm:w-auto">
                <span class="font-semibold">🔢 ID Kegiatan:</span>
                <span>{{ $kegiatan->id_kegiatan }}</span>
            </div>
            <div class="flex justify-between sm:flex-col sm:items-start w-full sm:w-auto">
                <span class="font-semibold">🏷️ Jenis Kegiatan:</span>
                <span>{{ $kegiatan->jenis_kegiatan }}</span>
            </div>
            <div class="flex justify-between sm:flex-col sm:items-start w-full sm:w-auto">
                <span class="font-semibold">📌 Nama Kegiatan:</span>
                <span>{{ $kegiatan->nama_kegiatan }}</span>
            </div>
            <div class="flex justify-between sm:flex-col sm:items-start w-full sm:w-auto">
                <span class="font-semibold">📅 Tanggal Kegiatan:</span>
                <span>{{ optional(\Carbon\Carbon::parse($kegiatan->tanggal_kegiatan))->translatedFormat('d F Y') }}</span>
            </div>
        </div>
    </div>

    {{-- Tombol Tambah Mahasiswa --}}
    <div class="mt-8 flex justify-end">
        <a href="{{ route('kegiatan.tambahMahasiswaForm', ['id' => $kegiatan->id]) }}"
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            + Tambah Mahasiswa
        </a>
    </div>

    {{-- Daftar Mahasiswa --}}
    <div class="mt-6">
        <h3 class="text-xl sm:text-2xl font-semibold text-gray-700 mb-4">Daftar Mahasiswa yang Mengikuti</h3>

        @if ($data->isEmpty())
            <p class="text-gray-500">Belum ada mahasiswa yang mengikuti kegiatan ini.</p>
        @else
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden text-sm sm:text-base">
                    <thead class="bg-yellow-500 text-white uppercase tracking-wider text-xs sm:text-sm">
                        <tr>
                            <th class="px-4 sm:px-6 py-3 text-left">No</th>
                            <th class="px-4 sm:px-6 py-3 text-left">NIM</th>
                            <th class="px-4 sm:px-6 py-3 text-left">Nama Mahasiswa</th>
                            <th class="px-4 sm:px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-gray-700">
                        @foreach ($data as $index => $mhs)
                            <tr class="hover:bg-yellow-50 transition duration-150">
                                <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $mhs->nim }}</td>
                                <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $mhs->nama }}</td>
                                <td class="px-4 sm:px-6 py-3 text-center space-x-2">
                                    {{-- Form Hapus Mahasiswa --}}
                                    <form action="{{ route('kegiatan.hapusMahasiswa', ['id' => $kegiatan->id, 'nim' => $mhs->nim]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini dari kegiatan?');"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 flex items-center gap-1 text-sm font-medium">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-8 text-right">
        <a href="{{ route('kegiatan.index') }}"
           class="text-sm bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            ← Kembali ke Daftar
        </a>
    </div>

</div>
@endsection
