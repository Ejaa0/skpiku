<!DOCTYPE html>
<html lang="id"
    x-data="{
        darkMode: localStorage.getItem('darkMode') === 'true',
        open: false,
        logoutOpen: false
    }"
    :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SKPI UNAI</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

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
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeInUp 0.5s ease-out;
        }
    </style>
</head>

<body class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 font-sans">

<div class="flex min-h-screen">

@if (!Request::is('login/*'))
<!-- SIDEBAR -->
<aside :class="open ? 'translate-x-0' : '-translate-x-full'"
    class="fixed lg:static z-40 inset-y-0 left-0 w-64 bg-primary text-white transform lg:translate-x-0 transition shadow-2xl rounded-r-3xl">

    <div class="flex flex-col h-full p-6 space-y-8">
        <div class="text-center">
            <div
                class="w-24 h-24 rounded-full bg-white text-primary flex items-center justify-center mx-auto mb-3 text-4xl font-extrabold shadow-lg">
                {{ strtoupper(substr(session('admin_name') ?? 'A', 0, 1)) }}
            </div>
            <p class="font-semibold text-xl truncate">{{ session('admin_name') ?? 'Admin' }}</p>
            <h1 class="text-2xl font-bold mt-2">🎓 SKPI UNAI</h1>
        </div>

        @php
            $menu = [
                ['name' => 'Dashboard', 'icon' => '🏠', 'route' => 'admin.dashboard'],
                ['name' => 'Mahasiswa', 'icon' => '👨‍🎓', 'route' => 'mahasiswa.index'],
                ['name' => 'Kegiatan', 'icon' => '📅', 'route' => 'kegiatan.index'],
                ['name' => 'Organisasi', 'icon' => '🏢', 'route' => 'organisasi.index'],
                ['name' => 'Poin', 'icon' => '🏅', 'route' => 'poin.index'],
                ['name' => 'Penentuan Poin', 'icon' => '⚖️', 'route' => 'penentuan-poin.index'],
            ];
        @endphp

        <nav class="space-y-3">
            @foreach($menu as $item)
                <a href="{{ route($item['route']) }}"
                    class="flex items-center gap-4 px-5 py-3 rounded-xl hover:bg-primaryHover
                    {{ Request::routeIs($item['route']) ? 'bg-primaryHover shadow-lg' : '' }}">
                    <span class="text-2xl">{{ $item['icon'] }}</span>
                    <span class="text-lg">{{ $item['name'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="mt-auto text-center text-sm text-indigo-200">
            &copy; {{ now()->year }} UNAI
        </div>
    </div>
</aside>
@endif

<!-- OVERLAY -->
<div x-show="open" class="fixed inset-0 bg-black/50 z-30 lg:hidden"
    @click="open=false" x-transition.opacity></div>

<!-- MAIN -->
<div class="flex-1 flex flex-col">

@if (!Request::is('login/*'))
<!-- TOPBAR -->
<header class="bg-white dark:bg-gray-800 px-6 py-4 flex justify-between items-center shadow sticky top-0 z-20">
    <button @click="open = !open" class="lg:hidden">
        <span class="material-icons text-3xl">menu</span>
    </button>

    <!-- LOGOUT BUTTON -->
    <button @click="logoutOpen = true"
        class="flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-full shadow">
        <span class="material-icons">logout</span>
        Logout
    </button>
</header>
@endif

<main class="flex-1 p-6 bg-white dark:bg-gray-800 animate-fade-in">
    @yield('content')
</main>

</div>
</div>

<!-- DARK MODE BUTTON -->
<button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
    class="fixed bottom-5 right-5 p-3 rounded-full bg-indigo-600 text-white shadow-xl z-50">
    <span class="material-icons" x-text="darkMode ? 'dark_mode' : 'light_mode'"></span>
</button>

<!-- LOGOUT MODAL -->
<div x-show="logoutOpen"
    x-transition.opacity
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">

    <div @click.outside="logoutOpen = false"
        x-transition.scale
        class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-md p-6 text-center">

        <div class="w-16 h-16 mx-auto mb-4 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
            <span class="material-icons text-red-600 text-4xl">logout</span>
        </div>

        <h2 class="text-2xl font-bold mb-2">Konfirmasi Logout</h2>
        <p class="text-gray-600 dark:text-gray-300 mb-6">
            Apakah Anda yakin ingin keluar dari sistem?
        </p>

        <div class="flex justify-center gap-4">
            <button @click="logoutOpen=false"
                class="px-5 py-2 bg-gray-200 dark:bg-gray-700 rounded-xl">
                Batal
            </button>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow">
                    Ya, Logout
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
