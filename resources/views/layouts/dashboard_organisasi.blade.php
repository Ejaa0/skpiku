<!DOCTYPE html>
<html lang="id"
    x-data="{ open: false, darkMode: localStorage.getItem('darkMode') === 'true' }"
    :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Organisasi | SKPI UNAI')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: { primary: '#1e3a8a' },
                },
            },
        };
    </script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-black dark:text-white min-h-screen">

    <!-- SIDEBAR -->
    <aside
        class="fixed inset-y-0 left-0 z-40 w-64 bg-primary text-white transform
               -translate-x-full lg:translate-x-0 transition-transform duration-300"
        :class="{ 'translate-x-0': open }">

        <div class="flex flex-col h-full p-6 space-y-6">
            <!-- Logo -->
            <div class="text-center">
                <img src="{{ asset('images/Logo-Unai.png') }}"
                     class="mx-auto w-20 mb-2" />
                <h1 class="text-lg font-bold">🏢 Organisasi</h1>
            </div>

            <!-- Menu -->
            <nav class="space-y-2">
                <a href="{{ route('organisasi.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-700
                   {{ Request::routeIs('organisasi.dashboard') ? 'bg-blue-800' : '' }}">
                    <span class="material-icons">dashboard</span>
                    Dashboard
                </a>

                <a href="{{ route('organisasi.self.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-700
                   {{ Request::routeIs('organisasi.self.*') ? 'bg-blue-800' : '' }}">
                    <span class="material-icons">groups</span>
                    Organisasi
                </a>

                <a href="{{ route('kegiatan-self.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-700
                   {{ Request::routeIs('kegiatan-self.*') ? 'bg-blue-800' : '' }}">
                    <span class="material-icons">event</span>
                    Kegiatan
                </a>
            </nav>

            <!-- Logout -->
            <div class="mt-auto">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-full flex justify-center items-center gap-2 py-2 bg-red-500 rounded-md hover:bg-red-600">
                        <span class="material-icons">logout</span> Logout
                    </button>
                </form>
            </div>

            <p class="text-xs text-center text-blue-200">
                © {{ now()->year }} Universitas Advent Indonesia
            </p>
        </div>
    </aside>

    <!-- OVERLAY MOBILE -->
    <div x-show="open" @click="open = false"
         class="fixed inset-0 bg-black/40 z-30 lg:hidden"></div>

    <!-- CONTENT WRAPPER -->
    <div class="lg:pl-64 min-h-screen flex flex-col">

        <!-- HEADER MOBILE -->
        <header class="lg:hidden bg-white dark:bg-gray-800 p-4 shadow flex items-center justify-between">
            <button @click="open = true">
                <span class="material-icons text-2xl">menu</span>
            </button>
            <span class="font-bold">@yield('title', 'Dashboard')</span>
        </header>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-4 md:p-6">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/alpinejs" defer></script>
</body>
</html>
