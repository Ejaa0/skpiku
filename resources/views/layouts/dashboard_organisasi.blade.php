<!DOCTYPE html>
<html lang="id"
      x-data="{ open: false, darkMode: localStorage.getItem('darkMode') === 'true' }"
      :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Organisasi | SKPI UNAI')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a',
                        secondary: '#2563eb',
                    },
                },
            },
        };
    </script>

    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-white text-black dark:bg-gray-900 dark:text-white transition-all min-h-screen flex">

    <!-- SIDEBAR -->
    <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
           class="fixed z-40 inset-y-0 left-0 w-64 bg-primary text-white transform lg:translate-x-0 lg:static
                  transition-transform duration-300 ease-in-out shadow-xl flex flex-col">

        <!-- Logo -->
        <div class="p-6 text-center border-b border-blue-700">
            <img src="{{ asset('images/Logo-Unai.png') }}" alt="Logo UNAI"
                 class="mx-auto w-20 h-auto mb-2 drop-shadow-xl" />
            <h1 class="text-xl font-bold tracking-wide">🏢 Organisasi</h1>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('organisasi.self.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-md transition 
                      {{ Request::routeIs('organisasi.self.*') ? 'bg-blue-800' : 'hover:bg-blue-700' }}">
                <span class="material-icons">groups</span>
                <span class="text-sm font-semibold">Organisasi</span>
            </a>

            <a href="{{ route('kegiatan-self.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-md transition 
                      {{ Request::routeIs('kegiatan-self.*') ? 'bg-blue-800' : 'hover:bg-blue-700' }}">
                <span class="material-icons">event</span>
                <span class="text-sm font-semibold">Kegiatan</span>
            </a>
        </nav>

        <!-- Footer -->
        <div class="p-4 text-center text-xs text-blue-200 border-t border-blue-700">
            &copy; {{ now()->year }} Universitas Advent Indonesia
        </div>
    </aside>

    <!-- Overlay (Mobile) -->
    <div class="fixed inset-0 bg-black bg-opacity-40 z-30 lg:hidden"
         x-show="open" @click="open = false" x-transition.opacity></div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col min-h-screen ml-0 lg:ml-64">

        <!-- Topbar (Mobile) -->
        <header class="bg-white dark:bg-gray-800 shadow p-4 flex justify-between items-center lg:hidden">
            <button @click="open = !open" class="text-blue-700 dark:text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <span class="font-bold text-lg">@yield('page-title', 'Dashboard Organisasi')</span>
        </header>

        <!-- Content Area -->
        <main class="p-6 flex-1 bg-gray-50 dark:bg-gray-800 rounded-lg shadow-inner overflow-auto">
            @yield('content')
        </main>
    </div>

</body>
</html>
