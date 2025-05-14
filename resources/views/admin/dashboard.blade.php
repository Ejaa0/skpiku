@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white p-8 rounded-xl shadow-lg">
        <h1 class="text-3xl font-bold mb-2">🎯 Dashboard Admin</h1>
        <p class="text-sm text-blue-100">Selamat datang kembali, Admin. Kelola data mahasiswa, kegiatan, organisasi, dan poin SKPI di sini.</p>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Mahasiswa -->
        <div class="bg-white border-t-4 border-blue-600 rounded-xl p-6 shadow hover:shadow-xl transition">
            <div class="flex items-center space-x-4">
                <div class="text-4xl">👨‍🎓</div>
                <div>
                    <h3 class="text-lg font-semibold">Mahasiswa</h3>
                    <p class="text-sm text-gray-500">Kelola data mahasiswa aktif</p>
                </div>
            </div>
            <a href="{{ route('mahasiswa.index') }}" class="block mt-4 text-sm text-blue-600 hover:underline">Lihat Data →</a>
        </div>

        <!-- Kegiatan -->
        <div class="bg-white border-t-4 border-green-500 rounded-xl p-6 shadow hover:shadow-xl transition">
            <div class="flex items-center space-x-4">
                <div class="text-4xl">📅</div>
                <div>
                    <h3 class="text-lg font-semibold">Kegiatan</h3>
                    <p class="text-sm text-gray-500">Pantau semua kegiatan aktif</p>
                </div>
            </div>
            <a href="{{ route('kegiatan.index') }}" class="block mt-4 text-sm text-green-600 hover:underline">Lihat Kegiatan →</a>
        </div>

        <!-- Organisasi -->
        <div class="bg-white border-t-4 border-yellow-400 rounded-xl p-6 shadow hover:shadow-xl transition">
            <div class="flex items-center space-x-4">
                <div class="text-4xl">🏢</div>
                <div>
                    <h3 class="text-lg font-semibold">Organisasi</h3>
                    <p class="text-sm text-gray-500">Kelola data organisasi mahasiswa</p>
                </div>
            </div>
            <a href="{{ route('organisasi.index') }}" class="block mt-4 text-sm text-yellow-600 hover:underline">Lihat Organisasi →</a>
        </div>

        <!-- Poin -->
        <div class="bg-white border-t-4 border-red-500 rounded-xl p-6 shadow hover:shadow-xl transition">
            <div class="flex items-center space-x-4">
                <div class="text-4xl">🏅</div>
                <div>
                    <h3 class="text-lg font-semibold">Poin SKPI</h3>
                    <p class="text-sm text-gray-500">Pantau dan atur poin mahasiswa</p>
                </div>
            </div>
            <a href="{{ route('poin.index') }}" class="block mt-4 text-sm text-red-600 hover:underline">Lihat Poin →</a>
        </div>
    </div>

    <!-- Notifikasi Informasi (Opsional) -->
    <div class="bg-blue-50 border-l-4 border-blue-400 text-blue-700 p-4 rounded shadow-sm">
        <p>📢 Info: Pastikan semua data SKPI mahasiswa telah diverifikasi sebelum akhir semester!</p>
    </div>

</div>
@endsection