<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-400 via-indigo-500 to-purple-600 min-h-screen flex">

    <!-- Sidebar -->
    <aside id="sidebar" class="bg-indigo-900 text-indigo-100 w-64 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out md:translate-x-0 -translate-x-full fixed md:static inset-y-0 left-0 z-30">
        <div class="flex items-center justify-between px-6 py-4 border-b border-indigo-700">
            <h1 class="text-xl font-bold tracking-wide">SKPI UNAI</h1>
            <button id="closeSidebarBtn" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6 text-indigo-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav class="flex flex-col mt-6 px-4 space-y-2">
            <a href="#" class="py-3 px-4 rounded-lg hover:bg-indigo-700 transition flex items-center space-x-3 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 6h18M3 18h18" />
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="http://127.0.0.1:8000/mahasiswa/data" class="py-3 px-4 rounded-lg hover:bg-indigo-700 transition flex items-center space-x-3 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M3 11h18M3 16h18M5 21h14" />
                </svg>
                <span>Data Mahasiswa</span>
            </a>
            <a href="#" class="py-3 px-4 rounded-lg hover:bg-indigo-700 transition flex items-center space-x-3 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 10-8 0v2m12 0v-2a4 4 0 118 0v2m-6 4h6" />
                </svg>
                <span>Profil</span>
            </a>
            <a href="#" class="py-3 px-4 rounded-lg hover:bg-indigo-700 transition flex items-center space-x-3 font-semibold mt-auto mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                <span>Logout</span>
            </a>
        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex flex-col flex-grow ml-0 md:ml-64 transition-all duration-300 ease-in-out">
        <!-- Navbar Mobile -->
        <header class="bg-white shadow-md md:hidden flex items-center justify-between px-4 py-3 sticky top-0 z-20">
            <button id="openSidebarBtn" class="focus:outline-none">
                <svg class="w-6 h-6 text-indigo-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h1 class="text-indigo-700 font-bold text-lg">Dashboard Mahasiswa</h1>
            <div></div>
        </header>

        <main class="p-8 flex-grow bg-white bg-opacity-90 rounded-tl-3xl rounded-tr-3xl shadow-xl min-h-screen">
            <h2 class="text-3xl font-bold mb-6 text-indigo-900">🎓 Selamat Datang, Mahasiswa!</h2>
            <p class="mb-8 text-indigo-700 max-w-xl">
                Kelola data dan informasi mahasiswa dengan mudah dan cepat melalui dashboard ini.
            </p>
            <a href="http://127.0.0.1:8000/mahasiswa/data" 
               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-full shadow-lg transition duration-300 ease-in-out">
                📋 Lihat Data Mahasiswa
            </a>
        </main>

        <footer class="text-center py-6 text-indigo-700 font-semibold select-none">
            &copy; 2025 Sistem SKPI UNAI • Dashboard Mahasiswa
        </footer>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('openSidebarBtn');
        const closeBtn = document.getElementById('closeSidebarBtn');

        openBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
        });

        closeBtn.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });
    </script>

</body>
</html>
