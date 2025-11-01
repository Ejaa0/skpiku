@extends('layouts.dashboard_warek_utama')

@section('title', 'Dashboard WR III')

@section('content')
<div class="p-6 space-y-6">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-100 to-blue-200 dark:from-gray-700 dark:to-gray-800 p-6 rounded-2xl shadow-lg flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-800 dark:text-white flex items-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600 dark:text-blue-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9.003 9.003 0 1112 21a9.003 9.003 0 01-6.879-3.196z" />
                </svg>
                Dashboard WR III
            </h1>
            <p class="text-gray-700 dark:text-gray-300">Selamat datang, Wakil Rektor III. Berikut ringkasan aktivitas Anda.</p>
        </div>
        <img src="https://www.svgrepo.com/show/331482/dashboard.svg" alt="Dashboard Illustration" class="w-32 h-32 hidden md:block">
    </div>

    {{-- Cards Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-blue-100 dark:bg-blue-800 p-6 rounded-lg shadow hover:scale-105 transition-transform">
            <p class="text-gray-800 dark:text-white font-semibold">Total Organisasi</p>
            <h2 class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $totalOrganisasi }}</h2>
        </div>
        <div class="bg-green-100 dark:bg-green-800 p-6 rounded-lg shadow hover:scale-105 transition-transform">
            <p class="text-gray-800 dark:text-white font-semibold">Kegiatan Terjadwal</p>
            <h2 class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $totalKegiatan }}</h2>
        </div>
        <div class="bg-yellow-100 dark:bg-yellow-800 p-6 rounded-lg shadow hover:scale-105 transition-transform">
            <p class="text-gray-800 dark:text-white font-semibold">Total Poin Mahasiswa</p>
            <h2 class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $totalPoin ?? 0 }}</h2>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="mt-6 flex flex-wrap gap-4">
        <a href="{{ route('organisasi.index') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">Lihat Organisasi</a>
        <a href="{{ route('kegiatan.index') }}" class="bg-green-600 text-white px-5 py-2 rounded-lg shadow hover:bg-green-700 transition">Lihat Kegiatan</a>
        <a href="{{ route('skpi.index') }}" class="bg-yellow-500 text-white px-5 py-2 rounded-lg shadow hover:bg-yellow-600 transition">SKPI</a>
    </div>

    {{-- Grafik Kegiatan per Bulan --}}
    <div class="mt-6 bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Jumlah Kegiatan per Bulan</h2>
        <canvas id="kegiatanChart"></canvas>
    </div>

</div>

{{-- Chart.js Script --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('kegiatanChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($bulan ?? []) !!}, // array bulan dari controller
            datasets: [{
                label: 'Jumlah Kegiatan',
                data: {!! json_encode($jumlahKegiatan ?? []) !!}, // array jumlah kegiatan per bulan
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
</script>
@endpush

@endsection
