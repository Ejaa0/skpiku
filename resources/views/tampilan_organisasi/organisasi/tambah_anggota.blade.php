@extends('layouts.dashboard_organisasi')

@section('title', 'Tambah Anggota Organisasi')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-green-600 mb-6">
        ➕ Tambah Anggota: {{ $organisasi->nama_organisasi }}
    </h2>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="py-3 px-4">NIM</th>
                    <th class="py-3 px-4">Nama</th>
                    <th class="py-3 px-4">Jabatan</th>
                    <th class="py-3 px-4">Status Keanggotaan</th>
                    <th class="py-3 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswa as $m)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $m->nim }}</td>
                    <td class="py-2 px-4">{{ $m->nama }}</td>
                    <td class="py-2 px-4">
                        <form action="{{ route('organisasi.self.store_anggota', $organisasi->id_organisasi) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            <input type="hidden" name="mahasiswa_nim" value="{{ $m->nim }}">
                            <select name="jabatan" class="border border-gray-300 rounded px-2 py-1">
                                <option value="Ketua">Ketua</option>
                                <option value="Wakil">Wakil</option>
                                <option value="Sekretaris">Sekretaris</option>
                                <option value="Bendahara">Bendahara</option>
                                <option value="Divisi Akademik">Divisi Akademik</option>
                                <option value="Divisi Acara">Divisi Acara</option>
                                <option value="Divisi Olahraga">Divisi Olahraga</option>
                                <option value="Divisi Multimedia">Divisi Multimedia</option>
                                <option value="Divisi Logistik">Divisi Logistik</option>
                                <option value="Divisi Humas">Divisi Humas</option>
                                <option value="Divisi Kerohanian">Divisi Kerohanian</option>
                            </select>
                    </td>
                    <td class="py-2 px-4">
                            <select name="status_keanggotaan" class="border border-gray-300 rounded px-2 py-1">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Tidak Aktif</option>
                            </select>
                    </td>
                    <td class="py-2 px-4">
                            <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition duration-200">
                                Tambah
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">Semua mahasiswa sudah menjadi anggota.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('organisasi.self.show', $organisasi->id_organisasi) }}"
       class="mt-6 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200">
       ← Kembali ke Detail Organisasi
    </a>
</div>
@endsection
