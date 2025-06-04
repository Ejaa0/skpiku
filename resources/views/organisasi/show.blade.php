@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-6">

    {{-- Bagian Detail Organisasi --}}
    <div class="bg-white p-8 rounded-xl shadow-lg mb-12">
        <h2 class="text-3xl font-extrabold text-blue-700 mb-6 flex items-center gap-2">
            📄 Detail Organisasi
        </h2>

        <div class="space-y-4 text-gray-800 text-lg">
            <div class="flex items-center gap-2">
                <span class="font-semibold">🆔 ID Organisasi:</span>
                <span>{{ $organisasi->id_organisasi }}</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="font-semibold">🏢 Nama Organisasi:</span>
                <span>{{ $organisasi->nama_organisasi }}</span>
            </div>
        </div>
    </div>

    {{-- Bagian Daftar Anggota Mahasiswa --}}
    <div class="bg-white p-8 rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                👥 Daftar Anggota Mahasiswa
            </h3>

            {{-- Tombol Tambah Anggota --}}
            <a href="{{ route('detail_organisasi_mahasiswa.create', ['id_organisasi' => $organisasi->id_organisasi]) }}"
               class="inline-flex items-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
               ➕ Tambah Anggota
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left border border-gray-300 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">NIM</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Jabatan</th>
                        <th class="px-4 py-2 border">Status Keanggotaan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($detailMahasiswa as $anggota)
                        <tr>
                            <td class="px-4 py-2 border">{{ $anggota->mahasiswa_nim }}</td>
                            <td class="px-4 py-2 border">{{ $anggota->nama }}</td>
                            <td class="px-4 py-2 border">{{ $anggota->jabatan ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $anggota->status_keanggotaan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center px-4 py-4 text-gray-500">Belum ada anggota terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-8 text-center">
        <a href="{{ route('organisasi.index') }}"
           class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
           ← 🔙 Kembali ke daftar
        </a>
    </div>

</div>
@endsection
