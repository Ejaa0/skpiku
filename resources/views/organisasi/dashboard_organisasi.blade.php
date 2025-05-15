<!DOCTYPE html>
<html lang="id" x-data="{ open: false, darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Wakil Rektor III | SKPI UNAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#9333ea', // ungu elegan untuk WR III
                    },
                },
            },
        };
    </script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
</head>

<body class="bg-white text-black dark:bg-gray-900 dark:text-white transition-all min-h-screen flex">

    <!-- Sidebar -->
    <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed z-40 inset-y-0 left-0 w-64 bg-primary text-white transform lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out shadow-xl">
        <div class="flex flex-col h-full p-6 space-y-6">
            <!-- Logo -->
            <div class="text-center mb-6">
                <img src="{{ asset('images/Logo-Unai.png') }}" alt="Logo UNAI" class="mx-auto w-20 h-auto mb-2 drop-shadow-xl" />
                <h1 class="text-xl font-bold tracking-wide">👨‍💼 WR III UNAI</h1>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2 flex flex-col">
                <a href="{{ route('warek.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-purple-700 {{ Request::routeIs('warek.dashboard') ? 'bg-purple-800' : '' }}">
                    <span class="material-icons">dashboard</span>
                    <span class="text-sm font-semibold">Dashboard</span>
                </a>

                <a href="{{ route('mahasiswa.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-purple-700 {{ Request::routeIs('mahasiswa.index') ? 'bg-purple-800' : '' }}">
                    <span class="material-icons">people</span>
                    <span class="text-sm font-semibold">Mahasiswa</span>
                </a>

                <a href="{{ route('kegiatan.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-purple-700 {{ Request::routeIs('kegiatan.index') ? 'bg-purple-800' : '' }}">
                    <span class="material-icons">event</span>
                    <span class="text-sm font-semibold">Kegiatan</span>
                </a>

                <a href="{{ route('organisasi.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-purple-700 {{ Request::routeIs('organisasi.index') ? 'bg-purple-800' : '' }}">
                    <span class="material-icons">groups</span>
                    <span class="text-sm font-semibold">Organisasi</span>
                </a>
            </nav>

            <!-- Sidebar footer -->
            <div class="mt-auto text-xs text-purple-200 text-center">
                &copy; {{ now()->year }} Universitas Advent Indonesia
            </div>
        </div>
    </aside>

    <!-- Overlay for mobile -->
    <div class="fixed inset-0 bg-black bg-opacity-40 z-30 lg:hidden" x-show="open" @click="open = false" x-transition.opacity></div>

    <!-- Main content -->
    <div class="flex-1 flex flex-col min-h-screen ml-0 lg:ml-64">
        <!-- Mobile top bar -->
        <header class="bg-white dark:bg-gray-800 shadow p-4 flex justify-between items-center lg:hidden">
            <button @click="open = !open" class="text-purple-700 dark:text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <span class="font-bold text-lg">Dashboard WR III</span>
        </header>

        <!-- Page content -->
        <main class="p-6 flex-1 bg-white dark:bg-gray-800 rounded-lg shadow-inner overflow-auto">
            @yield('content')
        </main>
    </div>

    <script src="https://unpkg.com/alpinejs" defer></script>
</body>

</html>
