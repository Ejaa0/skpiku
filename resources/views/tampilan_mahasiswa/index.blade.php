@extends('layouts.dashboard_mahasiswa')

@section('content')
<div class="space-y-8">

    <!-- SAPAAN -->
    <div class="bg-white rounded-2xl p-6 shadow border border-gray-200">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
            Hai, <span class="text-blue-600">{{ session('user_nim') ?? 'Mahasiswa' }}</span> 👋
        </h1>
        <p class="text-gray-600 mt-1">
            Selamat datang di Dashboard Mahasiswa SKPI
        </p>
    </div>

    <!-- CARD STATISTIK -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Total Kegiatan -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl p-6 shadow-lg hover:scale-[1.02] transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Total Kegiatan</p>
                    <h2 class="text-4xl font-bold mt-2">
                        {{ $totalKegiatan ?? 0 }}
                    </h2>
                </div>
                <div class="text-4xl opacity-80">
                    📅
                </div>
            </div>
        </div>

        <!-- Total Organisasi -->
        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-2xl p-6 shadow-lg hover:scale-[1.02] transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Total Organisasi</p>
                    <h2 class="text-4xl font-bold mt-2">
                        {{ $totalOrganisasi ?? 0 }}
                    </h2>
                </div>
                <div class="text-4xl opacity-80">
                    🏢
                </div>
            </div>
        </div>

        <!-- Total Poin SKPI -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-2xl p-6 shadow-lg hover:scale-[1.02] transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Total Poin SKPI</p>
                    <h2 class="text-4xl font-bold mt-2">
                        {{ $totalPoin ?? 0 }}
                    </h2>
                </div>
                <div class="text-4xl opacity-80">
                    ⭐
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
