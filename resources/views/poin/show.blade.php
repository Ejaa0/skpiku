@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">
        Detail Poin Mahasiswa
    </h1>

    <!-- Data Mahasiswa -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md space-y-3">
        <p class="text-gray-700 dark:text-gray-200">
            <strong class="font-semibold">NIM:</strong> {{ $poin->nim }}
        </p>
        <p class="text-gray-700 dark:text-gray-200">
            <strong class="font-semibold">Nama:</strong> {{ $poin->nama }}
        </p>
        <p class="text-gray-700 dark:text-gray-200">
            <strong class="font-semibold">Total Poin:</strong> {{ $poin->poin }}
        </p>
    </div>

    <!-- Daftar Kegiatan -->
    <div class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md">
        <h2 class="font-semibold text-xl mb-3 text-gray-800 dark:text-gray-100">
            Poin dari Kegiatan:
        </h2>
        <ul class="list-disc ml-6 space-y-1">
            @forelse($kegiatans as $kegiatan)
                <li class="text-gray-700 dark:text-gray-200">
                    {{ $kegiatan->nama_kegiatan }} - 
                    <span class="font-medium">{{ $kegiatan->poin_kegiatan }} poin</span>
                </li>
            @empty
                <li class="text-gray-500 dark:text-gray-400">Belum ada kegiatan.</li>
            @endforelse
        </ul>
    </div>

    <!-- Daftar Organisasi -->
    <div class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md">
        <h2 class="font-semibold text-xl mb-3 text-gray-800 dark:text-gray-100">
            Poin dari Organisasi:
        </h2>
        <ul class="list-disc ml-6 space-y-1">
            @forelse($organisasis as $organisasi)
                <li class="text-gray-700 dark:text-gray-200">
                    {{ $organisasi->nama_organisasi }} - 
                    <span class="font-medium">{{ $organisasi->poin_organisasi ?? 200 }} poin</span>
                </li>
            @empty
                <li class="text-gray-500 dark:text-gray-400">Belum ada organisasi.</li>
            @endforelse
        </ul>
    </div>

    <!-- Tombol kembali -->
    <div class="mt-6">
        <a href="{{ route('poin.index') }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition">
            ← Kembali
        </a>
    </div>
</div>
@endsection
