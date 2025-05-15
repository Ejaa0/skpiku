@extends('layouts.dashboard_organisasi')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8 mt-6 text-center max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-green-600 dark:text-green-300 mb-4">🏛️ Dashboard Organisasi</h1>
    <p class="text-gray-600 dark:text-gray-300 text-lg">
        Selamat datang, perwakilan organisasi! Kamu telah berhasil login ke sistem SKPI.
    </p>

    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Kegiatan -->
        <div
            class="bg-green-100 dark:bg-green-900 p-6 rounded-xl shadow hover:shadow-lg transition duration-300 text-left">
            <div class="flex items-center gap-3 mb-3">
                <div class="text-2xl">📅</div>
                <h2 class="text-xl font-semibold text-green-800 dark:text-green-200">Kelola Kegiatan</h2>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Tambahkan dan pantau kegiatan yang diselenggarakan oleh organisasi kamu.
            </p>
            <a href="{{ route('kegiatan.index') }}"
                class="inline-block mt-4 text-sm font-bold text-green-700 hover:text-green-900 dark:text-green-300 hover:underline">
                → Lihat Data Kegiatan
            </a>
        </div>

        <!-- Poin Mahasiswa -->
        <div
            class="bg-blue-100 dark:bg-blue-900 p-6 rounded-xl shadow hover:shadow-lg transition duration-300 text-left">
            <div class="flex items-center gap-3 mb-3">
                <div class="text-2xl">🏅</div>
                <h2 class="text-xl font-semibold text-blue-800 dark:text-blue-200">Kelola Poin Mahasiswa</h2>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Input dan verifikasi poin mahasiswa yang mengikuti kegiatan organisasi.
            </p>
            <a href="{{ route('poin.index') }}"
                class="inline-block mt-4 text-sm font-bold text-blue-700 hover:text-blue-900 dark:text-blue-300 hover:underline">
                → Lihat Data Poin
            </a>
        </div>
    </div>
</div>
@endsection
