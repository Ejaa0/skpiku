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
                        primaryHover: '#2563eb',
                        footerBg: '#1e40af',
                        footerText: '#bfdbfe',
                    },
                },
            },
        };
    </script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
</head>

<body class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 transition-all duration-300">

    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Sidebar -->
        @if (!Request::is('login/*'))
            <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
                class="fixed z-40 inset-y-0 left-0 w-64 bg-primary text-white transform lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out shadow-2xl">
                <div class="flex flex-col h-full p-6 space-y-8">
                    <!-- Logo & Admin -->
                    <div class="text-center">
                        <div
                            class="w-24 h-24 rounded-full bg-indigo-600 flex items-center justify-center mx-auto mb-3 text-white text-4xl font-extrabold shadow-lg">
                            {{ strtoupper(substr(session('admin_name') ?? 'A', 0, 1)) }}
                        </div>
                        <p class="font-semibold text-xl tracking-wide truncate">{{ session('admin_name') ?? 'Admin' }}</p>
                        <h1 class="text-2xl font-bold tracking-wider mt-2 select-none">🎓 SKPI UNAI</h1>
                    </div>

                    <!-- Navigation -->
                    <nav class="space-y-3 flex flex-col">
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-4 px-5 py-3 rounded-lg hover:bg-primaryHover transition duration-300
                        {{ Request::routeIs('admin.dashboard') ? 'bg-primaryHover shadow-lg' : '' }}">
                            <span class="text-2xl select-none">🏠</span>
                            <span class="text-lg font-medium">Dashboard</span>
                        </a>
                        <a href="{{ route('mahasiswa.index') }}"
                            class="flex items-center gap-4 px-5 py-3 rounded-lg hover:bg-primaryHover transition duration-300
                        {{ Request::routeIs('mahasiswa.index') ? 'bg-primaryHover shadow-lg' : '' }}">
                            <span class="text-2xl select-none">👨‍🎓</span>
                            <span class="text-lg font-medium">Mahasiswa</span>
                        </a>
                        <a href="{{ route('kegiatan.index') }}"
                            class="flex items-center gap-4 px-5 py-3 rounded-lg hover:bg-primaryHover transition duration-300
                        {{ Request::routeIs('kegiatan.index') ? 'bg-primaryHover shadow-lg' : '' }}">
                            <span class="text-2xl select-none">📅</span>
                            <span class="text-lg font-medium">Kegiatan</span>
                        </a>
                        <a href="{{ route('organisasi.index') }}"
                            class="flex items-center gap-4 px-5 py-3 rounded-lg hover:bg-primaryHover transition duration-300
                        {{ Request::routeIs('organisasi.index') ? 'bg-primaryHover shadow-lg' : '' }}">
                            <span class="text-2xl select-none">🏢</span>
                            <span class="text-lg font-medium">Organisasi</span>
                        </a>
                        <a href="{{ route('poin.index') }}"
                            class="flex items-center gap-4 px-5 py-3 rounded-lg hover:bg-primaryHover transition duration-300
                        {{ Request::routeIs('poin.index') ? 'bg-primaryHover shadow-lg' : '' }}">
                            <span class="text-2xl select-none">🏅</span>
                            <span class="text-lg font-medium">Poin</span>
                        </a>
                    </nav>

                    <!-- Footer Sidebar -->
                    <div class="mt-auto text-center text-sm text-indigo-300 select-none">
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
                <header
                    class="bg-white dark:bg-gray-800 shadow px-6 py-4 flex justify-between items-center sticky top-0 z-20">
                    <div class="lg:hidden">
                        <button @click="open = !open" aria-label="Toggle menu"
                            class="text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-full transition duration-300 transform hover:scale-105 shadow-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <span class="material-icons text-base">logout</span>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </header>
            @endif

            <!-- Main -->
            <main class="p-8 flex-1 bg-white dark:bg-gray-800 rounded-lg shadow-inner transition-colors duration-300">
                @yield('content')
            </main>

            <!-- Footer -->
            @if (!Request::is('login/*'))
                <footer class="bg-footerBg text-footerText mt-16 select-none">
                    <div class="max-w-7xl mx-auto px-8 py-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                        <div>
                            <h3 class="text-2xl font-bold mb-4 flex items-center gap-3">
                                <span class="material-icons text-indigo-200">school</span>
                                Tentang SKPI UNAI
                            </h3>
                            <p class="text-sm leading-relaxed max-w-md">
                                SKPI UNAI adalah sistem pencatatan kegiatan mahasiswa non-akademik sebagai bagian dari Surat Keterangan Pendamping Ijazah di Universitas Advent Indonesia.
                            </p>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4 flex items-center gap-3">
                                <span class="material-icons text-indigo-200">menu_book</span>
                                Navigasi
                            </h3>
                            <ul class="space-y-3 text-sm">
                                <li>
                                    <a href="{{ route('mahasiswa.index') }}"
                                        class="hover:underline hover:text-white transition duration-200">Mahasiswa</a>
                                </li>
                                <li>
                                    <a href="{{ route('kegiatan.index') }}"
                                        class="hover:underline hover:text-white transition duration-200">Kegiatan</a>
                                </li>
                                <li>
                                    <a href="{{ route('organisasi.index') }}"
                                        class="hover:underline hover:text-white transition duration-200">Organisasi</a>
                                </li>
                                <li>
                                    <a href="{{ route('poin.index') }}"
                                        class="hover:underline hover:text-white transition duration-200">Poin</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4 flex items-center gap-3">
                                <span class="material-icons text-indigo-200">contacts</span>
                                Kontak
                            </h3>
                            <p class="text-sm max-w-xs leading-relaxed">
                                Universitas Advent Indonesia<br />
                                Jl. Kolonel Masturi No. 288, Bandung<br />
                                Email: <a href="mailto:info@unai.edu"
                                    class="underline hover:text-white transition duration-200">info@unai.edu</a><br />
                                Telepon: (022) 278-6221
                            </p>
                        </div>
                    </div>
                    <div class="bg-indigo-900 text-center text-xs py-4 border-t border-indigo-700">
                        &copy; {{ now()->year }} SKPI UNAI - Universitas Advent Indonesia. All rights reserved.
                    </div>
                </footer>
            @endif
        </div>
    </div>

    <!-- Tombol Dark Mode -->
    <div class="fixed bottom-4 right-4 z-50">
        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
            class="text-xl focus:outline-none p-3 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-lg transition duration-300 transform hover:scale-110 focus:ring-2 focus:ring-indigo-500">
            <span class="material-icons" x-text="darkMode ? 'dark_mode' : 'light_mode'"></span>
        </button>
    </div>

    <script src="https://unpkg.com/alpinejs" defer></script>
</body>

</html>
