@extends('layouts.dashboard_organisasi')

@section('title', 'Detail Organisasi')

@section('content')
<div class="p-6">
    <!-- Header -->
    <h2 class="text-3xl font-bold text-green-600 mb-6">
        Detail Organisasi: {{ $organisasi->nama_organisasi }}
    </h2>

    <!-- Tombol tambah anggota -->
    <div class="mb-6">
        <a href="{{ route('organisasi.self.tambah_anggota', $organisasi->id_organisasi) }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
           ➕ Tambah Anggota
        </a>
    </div>

    <!-- Tabel anggota -->
    <div class="overflow-x-auto shadow-md rounded-lg">
        <table class="min-w-full bg-white dark:bg-gray-800 divide-y divide-gray-200">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3 text-left">NIM</th>
                    <th class="px-6 py-3 text-left">Nama</th>
                    <th class="px-6 py-3 text-left">Jabatan</th>
                    <th class="px-6 py-3 text-left">Status Keanggotaan</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 dark:text-gray-300">
                @forelse($mahasiswa as $m)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4">{{ $m->nim }}</td>
                    <td class="px-6 py-4">{{ $m->nama }}</td>
                    <td class="px-6 py-4">{{ $m->jabatan ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $m->status_keanggotaan ?? '-' }}</td>
                    <td class="px-6 py-4 flex gap-2">
                        <a href="{{ route('organisasi.self.edit_anggota', [$organisasi->id_organisasi, $m->nim]) }}"
                           class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                           Edit
                        </a>
                        <form action="{{ route('organisasi.self.delete_anggota', [$organisasi->id_organisasi, $m->nim]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                        Tidak ada anggota di organisasi ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tombol kembali -->
    <div class="mt-6">
        <a href="{{ route('organisasi.self.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
           ← Kembali ke Daftar Organisasi
        </a>
    </div>
</div>
@endsection
