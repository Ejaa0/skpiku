<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SKPI UNAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 text-gray-800">

    <div x-data="{ open: false }" class="flex min-h-screen">
        

        <!-- Overlay (Mobile) -->
        <div class="fixed inset-0 bg-black bg-opacity-40 z-30 lg:hidden" x-show="open" @click="open = false"
            x-transition.opacity></div>

        <!-- Sidebar -->
        <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
            class="fixed z-40 inset-y-0 left-0 w-64 bg-primary text-white transform lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out shadow-xl">

            <div class="flex flex-col h-full p-6 space-y-8">
                <!-- Logo dan Judul -->
                <div class="text-center">
                    <img src="{{ asset('images/Logo-Unai.png') }}" alt="Logo UNAI"
                        class="mx-auto w-20 h-auto mb-2 drop-shadow-xl">
                    <h1 class="text-xl font-bold tracking-wide">🎓 SKPI UNAI</h1>
                </div>

                <!-- Navigasi -->
                <nav class="flex-1 space-y-2">
                    <a href="{{ route('mahasiswa.index') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-700 transition-all
                          {{ Request::routeIs('mahasiswa.index') ? 'bg-blue-800' : '' }}">
                        <span class="text-xl">👨‍🎓</span> <span class="text-sm font-medium">Mahasiswa</span>
                    </a>
                    <a href="{{ route('kegiatan.index') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-700 transition-all
                          {{ Request::routeIs('kegiatan.index') ? 'bg-blue-800' : '' }}">
                        <span class="text-xl">📅</span> <span class="text-sm font-medium">Kegiatan</span>
                    </a>
                    <a href="{{ route('organisasi.index') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-700 transition-all
                          {{ Request::routeIs('organisasi.index') ? 'bg-blue-800' : '' }}">
                        <span class="text-xl">🏢</span> <span class="text-sm font-medium">Organisasi</span>
                    </a>
                </nav>

                <!-- Footer Sidebar -->
                <div class="text-xs text-center text-blue-200 mt-auto">
                    &copy; {{ now()->year }} Universitas Advent Indonesia
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">

            <!-- Topbar (Mobile Only) -->
            <header class="bg-white shadow p-4 flex justify-between items-center lg:hidden">
                <button @click="open = !open" class="text-blue-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="font-bold text-lg">Dashboard</span>
            </header>

            <!-- Halaman Konten -->
            <main class="p-6 flex-1 bg-gray-50 rounded-lg shadow-inner">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>
</body>

</html>
