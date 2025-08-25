@extends('layouts.app')

@section('content')
<div x-data="dashboard()" :class="darkMode ? 'dark bg-gray-900 text-gray-100' : 'bg-gray-100 text-gray-900'" class="min-h-screen p-8 transition-colors duration-500">

    <!-- Dark Mode Toggle -->
    <div class="flex justify-end mb-6">
        <button @click="darkMode = !darkMode" 
            class="bg-gray-300 dark:bg-gray-700 px-4 py-2 rounded-full focus:outline-none shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition">
            <span x-text="darkMode ? 'Light Mode' : 'Dark Mode'"></span>
        </button>
    </div>

    <!-- Header -->
    <header class="mb-12">
        <h1 class="text-4xl font-extrabold mb-2">🎯 Dashboard Admin</h1>
        <p class="text-lg text-gray-600 dark:text-gray-300">Kelola data mahasiswa, kegiatan, organisasi, dan poin SKPI dengan mudah.</p>
    </header>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

        <!-- Mahasiswa -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg transform transition hover:scale-105 hover:shadow-2xl">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-blue-600 text-white rounded-full text-3xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.877 6.196M12 14v1m0-6v1m6 5h-1m-8 0H7" /></svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Mahasiswa</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Data mahasiswa aktif</p>
                    <p class="mt-2 text-2xl font-bold" x-text="countMahasiswa">0</p>
                </div>
            </div>
            <a href="{{ route('mahasiswa.index') }}" class="block mt-4 text-blue-600 dark:text-blue-400 hover:underline">Lihat Data →</a>
        </div>

        <!-- Kegiatan -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg transform transition hover:scale-105 hover:shadow-2xl">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-green-600 text-white rounded-full text-3xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Kegiatan</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Pantau semua kegiatan</p>
                    <p class="mt-2 text-2xl font-bold" x-text="countKegiatan">0</p>
                </div>
            </div>
            <a href="{{ route('kegiatan.index') }}" class="block mt-4 text-green-600 dark:text-green-400 hover:underline">Lihat Kegiatan →</a>
        </div>

        <!-- Organisasi -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg transform transition hover:scale-105 hover:shadow-2xl">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-yellow-500 text-white rounded-full text-3xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 9 4-18 3 9h4"/></svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Organisasi</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Kelola organisasi mahasiswa</p>
                    <p class="mt-2 text-2xl font-bold" x-text="countOrganisasi">0</p>
                </div>
            </div>
            <a href="{{ route('organisasi.index') }}" class="block mt-4 text-yellow-600 dark:text-yellow-400 hover:underline">Lihat Organisasi →</a>
        </div>

        <!-- Poin -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg transform transition hover:scale-105 hover:shadow-2xl">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-red-600 text-white rounded-full text-3xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Poin SKPI</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Pantau poin mahasiswa</p>
                    <p class="mt-2 text-2xl font-bold" x-text="countPoin">0</p>
                </div>
            </div>
            <a href="{{ route('poin.index') }}" class="block mt-4 text-red-600 dark:text-red-400 hover:underline">Lihat Poin →</a>
        </div>
    </div>

    <!-- Grafik Poin Bulanan -->
    <section class="mt-16 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-center">📊 Statistik Poin Mahasiswa Bulanan</h2>
        <canvas id="poinChart" class="w-full h-64"></canvas>
    </section>

    <!-- Notifikasi -->
    <div class="bg-blue-50 dark:bg-blue-900 border-l-4 border-blue-400 text-blue-700 dark:text-blue-300 p-4 rounded shadow-sm mt-12 max-w-4xl mx-auto">
        <p>📢 <strong>Info:</strong> Pastikan semua data SKPI mahasiswa telah diverifikasi sebelum akhir semester!</p>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function dashboard() {
        return {
            darkMode: false,
            countMahasiswa: 0,
            countKegiatan: 0,
            countOrganisasi: 0,
            countPoin: 0,

            init() {
                // Simulasi fetch data dari server API / DB
                this.countMahasiswa = 3421;
                this.countKegiatan = 128;
                this.countOrganisasi = 27;
                this.countPoin = 9867;

                // Animasi count-up sederhana
                this.animateCount('countMahasiswa', this.countMahasiswa);
                this.animateCount('countKegiatan', this.countKegiatan);
                this.animateCount('countOrganisasi', this.countOrganisasi);
                this.animateCount('countPoin', this.countPoin);

                this.renderChart();
            },

            animateCount(prop, target) {
                let start = 0;
                const step = Math.ceil(target / 100);
                const interval = setInterval(() => {
                    if (this[prop] < target) {
                        this[prop] += step;
                    } else {
                        this[prop] = target;
                        clearInterval(interval);
                    }
                }, 15);
            },

            renderChart() {
                const ctx = document.getElementById('poinChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                        datasets: [{
                            label: 'Poin SKPI',
                            data: [500, 700, 1200, 800, 1400, 900, 1100],
                            backgroundColor: 'rgba(59, 130, 246, 0.7)', // Tailwind blue-500
                            borderRadius: 6,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { beginAtZero: true }
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: true }
                        }
                    }
                });
            }
        }
    }
</script>
@endpush
