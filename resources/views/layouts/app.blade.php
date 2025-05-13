<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SKPI UNAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a',
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-gray-100 text-gray-800">
    
    <div x-data="{ open: false }" class="flex flex-col lg:flex-row min-h-screen">
        <!-- Sidebar -->
        <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
            class="fixed z-40 inset-y-0 left-0 w-64 bg-primary text-white transform lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out shadow-xl">
            <div class="flex flex-col h-full p-6 space-y-6">
                <!-- Logo -->
                <div class="text-center">
                    <img src="{{ asset('images/Logo-Unai.png') }}" alt="Logo UNAI"
                        class="mx-auto w-20 h-auto mb-2 drop-shadow-xl">
                    <h1 class="text-xl font-bold tracking-wide">🎓 SKPI UNAI</h1>
                </div>

                <!-- Navigation -->
                <nav class="space-y-2">
                    <a href="{{ route('mahasiswa.index') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-700 {{ Request::routeIs('mahasiswa.index') ? 'bg-blue-800' : '' }}">
                        <span class="text-xl">👨‍🎓</span><span class="text-sm">Mahasiswa</span>
                    </a>
                    <a href="{{ route('kegiatan.index') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-700 {{ Request::routeIs('kegiatan.index') ? 'bg-blue-800' : '' }}">
                        <span class="text-xl">📅</span><span class="text-sm">Kegiatan</span>
                    </a>
                    <a href="{{ route('organisasi.index') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-700 {{ Request::routeIs('organisasi.index') ? 'bg-blue-800' : '' }}">
                        <span class="text-xl">🏢</span><span class="text-sm">Organisasi</span>
                    </a>
                    <!-- Menu Poin yang baru ditambahkan -->
                    <a href="{{ route('poin.index') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-700 {{ Request::routeIs('poin.index') ? 'bg-blue-800' : '' }}">
                        <span class="text-xl">🏅</span><span class="text-sm">Poin</span>
                    </a>
                </nav>

                <!-- Sidebar Footer -->
                <div class="text-xs text-center text-blue-200 mt-auto">
                    &copy; {{ now()->year }} Universitas Advent Indonesia
                </div>
            </div>
        </aside>

        <!-- Overlay (Mobile) -->
        <div class="fixed inset-0 bg-black bg-opacity-40 z-30 lg:hidden" x-show="open" @click="open = false"
            x-transition.opacity></div>

        <!-- Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Mobile Topbar -->
            <header class="bg-white shadow p-4 flex justify-between items-center lg:hidden">
                <button @click="open = !open" class="text-blue-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="font-bold text-lg">Dashboard</span>
            </header>

            <!-- Main Page Content -->
            <main class="p-6 flex-1 bg-gray-50 rounded-lg shadow-inner">
                <!-- Search Bar (centered) -->
                <div class="flex justify-center mb-6">
                    <div class="w-full max-w-md">
                        <div class="relative">
                            <input
                                type="text"
                                placeholder="Cari mahasiswa, kegiatan, dll..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1116.65 2.5a7.5 7.5 0 010 15z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-primary text-white mt-12">
                <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    <!-- Tentang -->
                    <div>
                        <h3 class="text-xl font-bold mb-4 flex items-center gap-2">🎓 <span>Tentang SKPI UNAI</span>
                        </h3>
                        <p class="text-sm text-blue-100 leading-relaxed">
                            SKPI UNAI adalah sistem pencatatan kegiatan mahasiswa non-akademik sebagai bagian dari Surat
                            Keterangan Pendamping Ijazah di Universitas Advent Indonesia.
                        </p>
                    </div>

                    <!-- Navigasi -->
                    <div>
                        <h3 class="text-xl font-bold mb-4 flex items-center gap-2">📂 <span>Navigasi</span></h3>
                        <ul class="space-y-2 text-sm text-blue-100">
                            <li><a href="{{ route('mahasiswa.index') }}"
                                    class="hover:underline hover:text-white">Mahasiswa</a></li>
                            <li><a href="{{ route('kegiatan.index') }}"
                                    class="hover:underline hover:text-white">Kegiatan</a></li>
                            <li><a href="{{ route('organisasi.index') }}"
                                    class="hover:underline hover:text-white">Organisasi</a></li>
                            <li><a href="{{ route('poin.index') }}"
                                    class="hover:underline hover:text-white">Poin</a></li>
                        </ul>
                    </div>

                    <!-- Kontak -->
                    <div>
                        <h3 class="text-xl font-bold mb-4 flex items-center gap-2">📞 <span>Kontak</span></h3>
                        <p class="text-sm text-blue-100">Universitas Advent Indonesia</p>
                        <p class="text-sm text-blue-100">Jl. Kolonel Masturi No. 288, Bandung</p>
                        <p class="text-sm text-blue-100 mt-2">Email: <a href="mailto:info@unai.edu"
                                class="underline hover:text-white">info@unai.edu</a></p>
                        <p class="text-sm text-blue-100">Telepon: (022) 278-6221</p>
                    </div>
                </div>

                <div class="bg-blue-900 text-center text-xs py-4 border-t border-blue-700">
                    &copy; {{ now()->year }} SKPI UNAI - Universitas Advent Indonesia. All rights reserved.
                </div>
            </footer>
        </div>
    </div>

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>
</body>

</html>
