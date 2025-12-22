<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

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

    <div class="flex flex-1">

        <!-- SIDEBAR -->
        <aside id="sidebar"
            class="fixed md:static inset-y-0 left-0 
                   w-64 md:w-72 lg:w-80 bg-white border-r border-gray-200
                   p-6 transform -translate-x-full md:translate-x-0
                   transition-transform duration-300 z-50 overflow-y-auto">

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

                <!-- Tambahan: Kriteria Poin -->
                <a href="{{ route('mahasiswa.kriteria-poin') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                    <span class="text-lg">📝</span>
                    <span class="font-medium">Kriteria Poin</span>
                </a>

                <hr class="my-4 border-gray-200">

                <!-- Logout Button -->
                <button onclick="openLogoutModal()"
                        class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl
                               bg-red-50 text-red-600 hover:bg-red-100 transition">
                    <span class="text-lg">🚪</span>
                    <span class="font-medium">Logout</span>
                </button>
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

    <!-- LOGOUT MODAL -->
    <div id="logoutModal" class="fixed inset-0 flex items-center justify-center bg-black/50 hidden z-50">
        <div class="bg-white rounded-2xl shadow-lg w-80 max-w-full p-6 text-center">
            <h2 class="text-xl font-bold mb-4">Konfirmasi Logout</h2>
            <p class="mb-6 text-gray-600">Apakah kamu yakin ingin keluar dari akun ini?</p>
            <div class="flex justify-center gap-4">
                <button onclick="closeLogoutModal()"
                        class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                    Batal
                </button>
                <a href="{{ route('mahasiswa.logout') }}"
                   class="px-4 py-2 rounded-xl bg-red-600 text-white hover:bg-red-700 transition">
                    Logout
                </a>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('overlay').classList.toggle('hidden');
        }

        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
    </script>

</body>
</html>
