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

    <!-- Slideshow Event UNAI -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-4">🔥 Event Terbaru di UNAI</h2>

        <div class="relative w-full overflow-hidden rounded-xl shadow-lg max-h-[500px]">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('images/capping.jpg') }}" alt="Capping Day" class="w-full object-cover h-[500px]" />
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/maxresdefault.jpg') }}" alt="UNAI Event" class="w-full object-cover h-[500px]" />
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/UPACARA-WISUDA-KE-79.jpg') }}" alt="Wisuda" class="w-full object-cover h-[500px]" />
                    </div>
                </div>
                <!-- Tombol Navigasi -->
                <div class="swiper-button-next text-white"></div>
                <div class="swiper-button-prev text-white"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <!-- Notifikasi Informasi -->
    <div class="bg-blue-50 border-l-4 border-blue-400 text-blue-700 p-4 rounded shadow-sm mt-8">
        <p>📢 Info: Pastikan semua data SKPI mahasiswa telah diverifikasi sebelum akhir semester!</p>
    </div>

</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
@endpush
