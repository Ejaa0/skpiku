@extends('layouts.dashboard_warek_utama')

@section('content')
<div class="bg-gradient-to-r from-blue-100 to-blue-200 dark:from-gray-700 dark:to-gray-800 p-8 rounded-2xl shadow-lg">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-800 dark:text-white mb-2 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-blue-600 dark:text-blue-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9.003 9.003 0 1112 21a9.003 9.003 0 01-6.879-3.196z" />
                </svg>
                Dashboard WR III
            </h1>
            <p class="text-gray-700 dark:text-gray-300">Selamat datang, Wakil Rektor III. Berikut adalah ringkasan aktivitas Anda.</p>
        </div>
        <img src="https://www.svgrepo.com/show/331482/dashboard.svg" alt="Dashboard Illustration" class="w-32 h-32 hidden md:block">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <div class="bg-blue-100 dark:bg-blue-800 p-5 rounded-lg shadow hover:scale-105 transition-transform">
            <p class="text-gray-800 dark:text-white font-semibold">Total Organisasi</p>
            <h2 class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $totalOrganisasi }}</h2>
        </div>
        <div class="bg-green-100 dark:bg-green-800 p-5 rounded-lg shadow hover:scale-105 transition-transform">
            <p class="text-gray-800 dark:text-white font-semibold">Kegiatan Terjadwal</p>
            <h2 class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $totalKegiatan }}</h2>
        </div>
       
    </div>
</div>
@endsection
