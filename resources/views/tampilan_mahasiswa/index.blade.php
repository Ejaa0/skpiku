@extends('layouts.dashboard_mahasiswa')

@section('content')
<div class="p-6">

    <!-- SAPAAN -->
    <h1 class="text-3xl font-bold text-gray-800 mb-2">
        Hai, {{ session('user_nim') ?? 'Mahasiswa' }}
    </h1>
    <h2 class="text-xl text-gray-700 mb-6">
        Selamat datang di Dashboard Mahasiswa
    </h2>

    <!-- CARD INFORMASI -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Card 1: Total Kegiatan -->
        <div class="bg-white rounded-xl p-5 shadow border border-gray-200">
            <h2 class="text-xl text-gray-700 font-semibold">Total Kegiatan</h2>
            <p class="text-4xl font-bold text-gray-900 mt-2">
                {{ $totalKegiatan ?? 0 }}
            </p>
        </div>

        <!-- Card 2: Total Organisasi -->
        <div class="bg-white rounded-xl p-5 shadow border border-gray-200">
            <h2 class="text-xl text-gray-700 font-semibold">Total Organisasi</h2>
            <p class="text-4xl font-bold text-gray-900 mt-2">
                {{ $totalOrganisasi ?? 0 }}
            </p>
        </div>

        <!-- Card 3: Total Poin SKPI -->
        <div class="bg-white rounded-xl p-5 shadow border border-gray-200">
            <h2 class="text-xl text-gray-700 font-semibold">Total Poin SKPI</h2>
            <p class="text-4xl font-bold text-gray-900 mt-2">
                {{ $totalPoin ?? 0 }}
            </p>
        </div>

    </div>

    

</div>
@endsection
