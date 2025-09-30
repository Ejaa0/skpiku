@extends('layouts.dashboard_organisasi')

@section('title', 'Detail Organisasi')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold text-green-600 mb-4">
        Detail Organisasi: {{ $organisasi->nama_organisasi }}
    </h2>

    <!-- Tombol tambah anggota -->
    <a href="{{ route('organisasi.self.tambah_anggota', $organisasi->id_organisasi) }}"
       class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
       ➕ Tambah Anggota
    </a>

    <!-- Tabel anggota -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border-b text-left">NIM</th>
                    <th class="py-2 px-4 border-b text-left">Nama</th>
                    <th class="py-2 px-4 border-b text-left">Jabatan</th>
                    <th class="py-2 px-4 border-b text-left">Status Keanggotaan</th>
                    <th class="py-2 px-4 border-b text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $m)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $m->nim }}</td>
                    <td class="py-2 px-4 border-b">{{ $m->nama }}</td>
                    <td class="py-2 px-4 border-b">{{ $m->jabatan ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">{{ $m->status_keanggotaan ?? '-' }}</td>
                    <td class="py-2 px-4 border-b space-x-2">
                        <a href="{{ route('organisasi.self.edit_anggota', [$organisasi->id_organisasi, $m->nim]) }}"
                           class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                           Edit
                        </a>
                        <form action="{{ route('organisasi.self.delete_anggota', [$organisasi->id_organisasi, $m->nim]) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('organisasi.self.index') }}"
       class="mt-4 inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
       ← Kembali ke Daftar Organisasi
    </a>
</div>
@endsection
