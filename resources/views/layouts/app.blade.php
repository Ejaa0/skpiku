<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', open: false }" :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SKPI UNAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a',
                    },
                },
            },
        };
    </script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="bg-white text-black dark:bg-gray-900 dark:text-white transition-all">

    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Sidebar -->
        @if (!Request::is('login/*'))
            <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
                class="fixed z-40 inset-y-0 left-0 w-64 bg-primary text-white transform lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out shadow-xl">
                <div class="flex flex-col h-full p-6 space-y-6">
                    <!-- Logo & Admin -->
                    <div class="text-center">
                        <div
                            class="w-24 h-24 rounded-full bg-gray-400 flex items-center justify-center mx-auto mb-2 text-white text-3xl font-bold">
                            {{ strtoupper(substr(session('admin_name') ?? 'A', 0, 1)) }}
                        </div>
                        <p class="text-center font-semibold text-white text-lg">{{ session('admin_name') ?? 'Admin' }}
                        </p>
                        <h1 class="text-xl font-bold tracking-wide mt-2">🎓 SKPI UNAI</h1>
                    </div>

                    <!-- Navigation -->
                    <nav class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-700 {{ Request::routeIs('admin.dashboard') ? 'bg-blue-800' : '' }}">
                            <span class="text-xl">🏠</span><span class="text-sm">Dashboard</span>
                        </a>
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
                        <a href="{{ route('poin.index') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-700 {{ Request::routeIs('poin.index') ? 'bg-blue-800' : '' }}">
                            <span class="text-xl">🏅</span><span class="text-sm">Poin</span>
                        </a>
                    </nav>

                    <!-- Footer Sidebar -->
                    <div class="mt-auto text-xs text-center text-blue-200">
                        &copy; {{ now()->year }} Universitas Advent Indonesia
                    </div>
                </div>
            </aside>
        @endif

        <!-- Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-40 z-30 lg:hidden" x-show="open" @click="open = false"
            x-transition.opacity></div>

        <!-- Konten Utama -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Topbar -->
            @if (!Request::is('login/*'))
                <header class="bg-white dark:bg-gray-800 shadow px-4 py-3 flex justify-between items-center">
                    <div class="lg:hidden">
                        <button @click="open = !open" class="text-blue-700 dark:text-white focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>

                    <div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold rounded-full transition duration-300 transform hover:scale-105 shadow">
                                <span class="material-icons text-sm">logout</span>
                                <span class="hidden sm:inline">Logout</span>
                            </button>
                        </form>
                    </div>
                </header>
            @endif

            <!-- Main -->
            <main class="p-6 flex-1 bg-white dark:bg-gray-800 rounded-lg shadow-inner">
                @yield('content')
            </main>

            <!-- Footer -->
            @if (!Request::is('login/*'))
                <footer class="bg-primary text-white mt-12">
                    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                        <div>
                            <h3 class="text-xl font-bold mb-4 flex items-center gap-2">🎓 <span>Tentang SKPI UNAI</span>
                            </h3>
                            <p class="text-sm text-blue-100 leading-relaxed">
                                SKPI UNAI adalah sistem pencatatan kegiatan mahasiswa non-akademik sebagai bagian dari
                                Surat Keterangan Pendamping Ijazah di Universitas Advent Indonesia.
                            </p>
                        </div>
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
            @endif
        </div>
    </div>

    <!-- Tombol Dark Mode -->
    <div class="fixed bottom-4 right-4 z-50">
        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
            class="text-xl focus:outline-none p-3 rounded-full bg-indigo-500 hover:bg-indigo-700 text-white shadow-lg transition duration-300 transform hover:scale-110">
            <span class="material-icons" x-text="darkMode ? 'dark_mode' : 'light_mode'"></span>
        </button>
    </div>

    <script src="https://unpkg.com/alpinejs" defer></script>
</body>

</html>
