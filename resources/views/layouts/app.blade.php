<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', open: false }" :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SKPI UNAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
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
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                },
            },
        };
    </script>
    <style>
        * {
            transition: all 0.3s ease-in-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.5s ease-out;
        }
    </style>
</head>

<body class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 transition-all duration-300 font-sans">

    <div class="flex flex-col lg:flex-row min-h-screen">
        @if (!Request::is('login/*'))
            <!-- Sidebar -->
            <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
                class="fixed z-40 inset-y-0 left-0 w-64 bg-primary text-white transform lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out shadow-2xl rounded-r-3xl">
                <div class="flex flex-col h-full p-6 space-y-8">
                    <!-- Logo & Admin -->
                    <div class="text-center">
                        <div
                            class="w-24 h-24 rounded-full bg-white text-primary flex items-center justify-center mx-auto mb-3 text-4xl font-extrabold shadow-lg ring-4 ring-white/60">
                            {{ strtoupper(substr(session('admin_name') ?? 'A', 0, 1)) }}
                        </div>
                        <p class="font-semibold text-xl tracking-wide truncate">{{ session('admin_name') ?? 'Admin' }}</p>
                        <h1 class="text-2xl font-bold tracking-wider mt-2">🎓 SKPI UNAI</h1>
                    </div>

                    <!-- Navigation -->
                    <nav class="space-y-3">
                        @php
                            $menu = [
                                ['name' => 'Dashboard', 'icon' => '🏠', 'route' => 'admin.dashboard'],
                                ['name' => 'Mahasiswa', 'icon' => '👨‍🎓', 'route' => 'mahasiswa.index'],
                                ['name' => 'Kegiatan', 'icon' => '📅', 'route' => 'kegiatan.index'],
                                ['name' => 'Organisasi', 'icon' => '🏢', 'route' => 'organisasi.index'],
                                ['name' => 'Poin', 'icon' => '🏅', 'route' => 'poin.index'],
                            ];
                        @endphp
                        @foreach($menu as $item)
                            <a href="{{ route($item['route']) }}"
                                class="flex items-center gap-4 px-5 py-3 rounded-xl hover:bg-primaryHover hover:shadow-lg hover:scale-[1.02]
                                {{ Request::routeIs($item['route']) ? 'bg-primaryHover shadow-lg' : '' }}">
                                <span class="text-2xl">{{ $item['icon'] }}</span>
                                <span class="text-lg font-medium">{{ $item['name'] }}</span>
                            </a>
                        @endforeach
                    </nav>

                    <div class="mt-auto text-center text-sm text-indigo-200 italic">
                        &copy; {{ now()->year }} UNAI
                    </div>
                </div>
            </aside>
        @endif

        <!-- Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden" x-show="open" @click="open = false" x-transition.opacity></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            @if (!Request::is('login/*'))
                <!-- Topbar -->
                <header
                    class="bg-white dark:bg-gray-800 px-6 py-4 flex justify-between items-center shadow-md sticky top-0 z-20 select-none">
                    <div class="lg:hidden">
                        <button @click="open = !open" aria-label="Toggle menu"
                            class="text-primary dark:text-white focus:outline-none">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-full transition hover:shadow-lg hover:scale-105 focus:ring-2 focus:ring-offset-2 focus:ring-red-400">
                            <span class="material-icons text-base">logout</span>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </header>
            @endif

            <!-- Main Section -->
            <main
                class="p-6 sm:p-8 flex-1 bg-white dark:bg-gray-800 rounded-lg shadow-inner transition-colors duration-300 animate-fade-in">
                @yield('content')
            </main>

            <!-- Footer -->
            @if (!Request::is('login/*'))
                <footer class="bg-footerBg text-footerText mt-16">
                    <div class="max-w-7xl mx-auto px-8 py-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                        <div>
                            <h3 class="text-2xl font-bold mb-4 flex items-center gap-2">
                                <span class="material-icons text-indigo-200">school</span> Tentang SKPI UNAI
                            </h3>
                            <p class="text-sm leading-relaxed">
                                SKPI UNAI adalah sistem pencatatan kegiatan non-akademik untuk mendampingi ijazah di Universitas Advent Indonesia.
                            </p>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4 flex items-center gap-2">
                                <span class="material-icons text-indigo-200">menu_book</span> Navigasi
                            </h3>
                            <ul class="space-y-2 text-sm">
                                @foreach($menu as $item)
                                    <li>
                                        <a href="{{ route($item['route']) }}" class="hover:underline hover:text-white transition">
                                            {{ $item['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4 flex items-center gap-2">
                                <span class="material-icons text-indigo-200">contacts</span> Kontak
                            </h3>
                            <p class="text-sm leading-relaxed">
                                Universitas Advent Indonesia<br />
                                Jl. Kolonel Masturi No. 288, Bandung<br />
                                Email: <a href="mailto:info@unai.edu" class="underline hover:text-white">info@unai.edu</a><br />
                                Telepon: (022) 278-6221
                            </p>
                        </div>
                    </div>
                    <div class="bg-indigo-900 text-center text-xs py-4 border-t border-indigo-700 select-none">
                        &copy; {{ now()->year }} SKPI UNAI - Universitas Advent Indonesia. All rights reserved.
                    </div>
                </footer>
            @endif
        </div>
    </div>

    <!-- Dark Mode Button -->
    <div class="fixed bottom-5 right-5 z-50">
        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
            class="text-xl p-3 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl transition transform hover:scale-110 focus:ring-2 focus:ring-indigo-500">
            <template x-if="darkMode">
                <span class="material-icons">dark_mode</span>
            </template>
            <template x-if="!darkMode">
                <span class="material-icons">light_mode</span>
            </template>
        </button>
    </div>

    <script src="https://unpkg.com/alpinejs" defer></script>
</body>

</html>
