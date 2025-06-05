@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-6">

    {{-- Bagian Detail Organisasi --}}
    <div class="bg-white p-8 rounded-xl shadow-lg mb-12">
        <h2 class="text-3xl font-extrabold text-blue-700 mb-6 flex items-center gap-3">
            <span class="text-4xl">📄</span> Detail Organisasi
        </h2>

        <div class="space-y-5 text-gray-800 text-lg border border-gray-200 rounded-lg p-6 bg-blue-50">
            <div class="flex items-center gap-3">
                <span class="font-semibold text-blue-900">🆔 ID Organisasi:</span>
                <span class="text-blue-800">{{ $organisasi->id_organisasi }}</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="font-semibold text-blue-900">🏢 Nama Organisasi:</span>
                <span class="text-blue-800">{{ $organisasi->nama_organisasi }}</span>
            </div>
        </div>
    </div>

    {{-- Bagian Daftar Anggota Mahasiswa --}}
    <div class="bg-white p-8 rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-gray-800 flex items-center gap-3">
                <span class="text-3xl">👥</span> Daftar Anggota Mahasiswa
            </h3>

            {{-- Tombol Tambah Anggota --}}
            <a href="{{ route('detail_organisasi_mahasiswa.create', ['id_organisasi' => $organisasi->id_organisasi]) }}"
               class="inline-flex items-center bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition">
               ➕ Tambah Anggota
            </a>
        </div>

        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full text-left text-sm divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 font-medium border-b">NIM</th>
                        <th class="px-6 py-3 font-medium border-b">Nama</th>
                        <th class="px-6 py-3 font-medium border-b">Jabatan</th>
                        <th class="px-6 py-3 font-medium border-b">Status Keanggotaan</th>
                        <th class="px-6 py-3 font-medium border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($detailMahasiswa as $anggota)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">{{ $anggota->nim }}</td>
                            <td class="px-6 py-4 border-b">{{ $anggota->nama }}</td>
                            <td class="px-6 py-4 border-b">{{ $anggota->jabatan ?? '-' }}</td>
                            <td class="px-6 py-4 border-b">{{ $anggota->status_keanggotaan ?? '-' }}</td>
                            <td class="px-6 py-4 border-b text-center">
                                {{-- Tombol Edit Anggota --}}
                                <a href="{{ route('detail_organisasi_mahasiswa.edit', $anggota->id) }}"
                                   class="inline-block bg-yellow-500 text-white px-4 py-1 rounded hover:bg-yellow-600 transition text-sm mr-2">
                                    ✏️ Edit
                                </a>

                                {{-- Tombol Delete Anggota --}}
                                <form action="{{ route('detail_organisasi_mahasiswa.destroy', $anggota->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus anggota ini?');"
                                      class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 transition text-sm">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center px-6 py-6 text-gray-500 italic">Belum ada anggota terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-10 text-center">
        <a href="{{ route('organisasi.index') }}"
           class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition text-lg font-semibold">
           ← 🔙 Kembali ke daftar
        </a>
    </div>

</div>
@endsection
