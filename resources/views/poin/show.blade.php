@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">
        Detail Poin Mahasiswa
    </h1>

    <!-- Info Mahasiswa -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-2xl text-center shadow-md">
            <p class="text-gray-600 dark:text-gray-300 font-semibold">NIM</p>
            <p class="mt-2 text-xl font-bold text-gray-800 dark:text-gray-100">{{ $poin->nim }}</p>
        </div>
        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-2xl text-center shadow-md">
            <p class="text-gray-600 dark:text-gray-300 font-semibold">Nama</p>
            <p class="mt-2 text-xl font-bold text-gray-800 dark:text-gray-100">{{ $poin->nama }}</p>
        </div>
        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-2xl text-center shadow-md relative">
            <p class="text-gray-600 dark:text-gray-300 font-semibold">Total Poin</p>
            <p class="mt-2 text-xl font-bold text-gray-800 dark:text-gray-100">{{ $poin->poin }}</p>
            @if($poin->poin >= 1000)
                <span class="absolute top-0 right-0 mt-2 mr-2 bg-yellow-400 text-gray-900 px-2 py-1 rounded-full text-sm font-semibold shadow-md">
                    🏅 Master
                </span>
            @endif
        </div>
    </div>

    <!-- Tombol Buat SKPI -->
    @if($poin->poin >= 1000)
        <div class="mb-8 text-center">
            <a href="http://127.0.0.1:8000/skpi" 
               class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-2xl shadow-md font-semibold transition transform hover:scale-105">
               🎓 Buat SKPI
            </a>
        </div>
    @endif

    <!-- Tabel Poin Kegiatan (Merah) -->
    <div class="mb-8 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Poin dari Kegiatan</h2>
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700">
                    <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Nama Kegiatan</th>
                    <th class="px-4 py-2 text-right text-gray-700 dark:text-gray-200">Poin</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($kegiatans as $kegiatan)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100 font-medium">{{ $kegiatan->nama_kegiatan }}</td>
                        <td class="px-4 py-2 text-right">
                            <span class="inline-block px-3 py-1 rounded-full font-semibold bg-red-500 text-white">
                                🔴 {{ $kegiatan->poin_kegiatan }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                            Belum ada kegiatan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tabel Poin Organisasi (Hijau) -->
    <div class="mb-8 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Poin dari Organisasi</h2>
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700">
                    <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Nama Organisasi</th>
                    <th class="px-4 py-2 text-right text-gray-700 dark:text-gray-200">Poin</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($organisasis as $organisasi)
                    @php
                        $orgPoin = $organisasi->poin_organisasi ?? 1000;
                    @endphp
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100 font-medium">{{ $organisasi->nama_organisasi }}</td>
                        <td class="px-4 py-2 text-right">
                            <span class="inline-block px-3 py-1 rounded-full font-semibold bg-green-500 text-white">
                                🟢 {{ $orgPoin }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                            Belum ada organisasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mb-8">
        <a href="{{ route('poin.index') }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl shadow-md font-semibold transition transform hover:scale-105">
           ← Kembali
        </a>
    </div>
</div>
@endsection
