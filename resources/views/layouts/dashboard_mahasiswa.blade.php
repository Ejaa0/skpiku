<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<!-- HEADER MOBILE -->
<header class="md:hidden flex items-center justify-between bg-white border-b px-4 py-3 shadow-sm">
    <div>
        <h2 class="text-lg font-bold text-gray-800">Mahasiswa</h2>
        <p class="text-xs text-gray-500">Dashboard SKPI</p>
    </div>
    <button onclick="toggleSidebar()" class="text-2xl text-gray-700">
        ☰
    </button>
</header>

<div class="flex">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="fixed md:static inset-y-0 left-0 w-72 bg-white border-r border-gray-200
               p-6 transform -translate-x-full md:translate-x-0
               transition-transform duration-300 z-50">

        <!-- BRAND -->
        <div class="mb-10 hidden md:block">
            <h2 class="text-2xl font-bold text-gray-800">Mahasiswa</h2>
            <p class="text-sm text-gray-500">Dashboard SKPI</p>
        </div>

        <!-- MENU -->
        <nav class="space-y-1">

            <a href="/mahasiswa/dashboard"
               class="flex items-center gap-3 px-4 py-3 rounded-xl
                      text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                <span class="text-lg">🏠</span>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="/mahasiswa/kegiatan"
               class="flex items-center gap-3 px-4 py-3 rounded-xl
                      text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                <span class="text-lg">📅</span>
                <span class="font-medium">Kegiatan</span>
            </a>

            <a href="/mahasiswa/organisasi"
               class="flex items-center gap-3 px-4 py-3 rounded-xl
                      text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                <span class="text-lg">🏢</span>
                <span class="font-medium">Organisasi</span>
            </a>

            <a href="{{ route('mahasiswa.klaim-poin') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl
                      text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                <span class="text-lg">⭐</span>
                <span class="font-medium">Poin SKPI</span>
            </a>

            <hr class="my-4 border-gray-200">

            <a href="{{ route('mahasiswa.logout') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl
                      bg-red-50 text-red-600 hover:bg-red-100 transition">
                <span class="text-lg">🚪</span>
                <span class="font-medium">Logout</span>
            </a>

        </nav>
    </aside>

    <!-- OVERLAY MOBILE -->
    <div id="overlay"
         onclick="toggleSidebar()"
         class="fixed inset-0 bg-black/40 hidden z-40 md:hidden">
    </div>

    <!-- CONTENT -->
    <main class="flex-1 p-6 md:p-10">
        @yield('content')
    </main>

</div>

<!-- SCRIPT -->
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
        document.getElementById('overlay').classList.toggle('hidden');
    }
</script>

</body>
</html>
