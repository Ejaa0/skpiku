<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-100">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden" x-cloak>
        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 w-64 bg-white shadow-md transition-transform duration-300 transform z-50 lg:translate-x-0 lg:static lg:inset-0">

            <div class="p-6 border-b">
                <h2 class="text-xl font-bold text-blue-600">SI Mahasiswa</h2>
            </div>

            <nav class="mt-4 px-4 space-y-2">
                <a href="{{ route('mahasiswa.index') }}"
                    class="block py-2 px-3 rounded hover:bg-blue-100 text-gray-800 font-medium">
                    🧑‍🎓 Daftar Mahasiswa
                </a>
                <a href="{{ route('mahasiswa.create') }}"
                    class="block py-2 px-3 rounded hover:bg-blue-100 text-gray-800 font-medium">
                    ➕ Tambah Mahasiswa
                </a>
                <!-- Tambahkan link lain di sini -->
            </nav>
        </div>

        <!-- Overlay (untuk mobile) -->
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"></div>

        <!-- Konten utama -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <!-- Top bar -->
            <header class="flex items-center justify-between px-6 py-4 bg-white shadow-md lg:hidden">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 focus:outline-none">
                    <!-- Hamburger icon -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-lg font-bold text-blue-600">SI Mahasiswa</h1>
            </header>


            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>
