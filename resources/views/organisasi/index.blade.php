@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">
    <div class="bg-white shadow-xl rounded-xl p-8">
        <h2 class="text-4xl font-bold text-primary mb-8 border-b pb-4">📋 Daftar Organisasi</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tombol Tambah Organisasi (di kiri) -->
        <div class="mb-6">
            <a href="{{ route('organisasi.create') }}"
                class="inline-block bg-blue-600 hover:bg-blue-800 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 shadow">
                ➕ Tambah Organisasi
            </a>
        </div>

        <!-- Tabel -->
        <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-200">
            <table class="min-w-full bg-white text-sm text-gray-700">
                {{-- Header tabel disesuaikan dengan warna sidebar --}}
                <thead class="bg-blue-600 text-white uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">NIM</th>
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3 text-left">Organisasi</th>
                        <th class="px-6 py-3 text-left">Absensi</th>
                        <th class="px-6 py-3 text-left">Kegiatan</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($organisasis as $organisasi)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="px-6 py-4">{{ $organisasi->nim }}</td>
                            <td class="px-6 py-4">{{ $organisasi->nama }}</td>
                            <td class="px-6 py-4">{{ $organisasi->nama_organisasi }}</td>
                            <td class="px-6 py-4">{{ $organisasi->absensi }}</td>
                            <td class="px-6 py-4">{{ $organisasi->kegiatan->nama_kegiatan }}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('organisasi.edit', $organisasi->id) }}"
                                    class="text-blue-600 hover:text-blue-800 font-semibold transition duration-200"
                                    title="Edit">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('organisasi.destroy', $organisasi->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus organisasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 font-semibold transition duration-200"
                                        title="Hapus">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($organisasis->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center text-gray-400 py-8">
                                Belum ada data organisasi yang terdaftar.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
