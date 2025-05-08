<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SKPI UNAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .transition-transform {
            transition: transform 0.3s ease-in-out;
        }

        /* Animasi untuk Sidebar */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }

        /* Animasi menu */
        .nav-link {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .nav-link:hover {
            background-color: #2b6cb0;
            /* Biru lebih gelap untuk hover */
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    <div x-data="{ open: false }" class="flex min-h-screen">

        <!-- Mobile overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-30 transition-opacity lg:hidden" x-show="open"
            @click="open = false" x-transition.opacity></div>

        <!-- Sidebar -->
        <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
            class="fixed z-40 inset-y-0 left-0 w-64 bg-blue-900 text-white transform transition-transform duration-300 lg:static lg:translate-x-0 lg:block sidebar-transition">
            <div class="p-6 space-y-4">
                <h1 class="text-2xl font-bold text-white">🎓 SKPI UNAI</h1>
                <nav class="space-y-2">
                    <a href="{{ route('mahasiswa.index') }}" class="block px-3 py-2 rounded nav-link">👨‍🎓
                        Mahasiswa</a>
                    <a href="{{ route('kegiatan.index') }}" class="block px-3 py-2 rounded nav-link">📅 Kegiatan</a>
                    <a href="{{ route('organisasi.index') }}" class="block px-3 py-2 rounded nav-link">🏢 Organisasi</a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Topbar -->
            <header class="bg-white shadow p-4 flex justify-between items-center lg:hidden">
                <button @click="open = !open" class="text-blue-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="font-bold text-lg">Dashboard</span>
            </header>

            <!-- Page content -->
            <main class="p-6 flex-1 bg-gray-50 rounded-lg shadow-lg">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>
</body>

</html>
