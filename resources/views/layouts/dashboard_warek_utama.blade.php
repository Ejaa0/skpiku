<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard WR III</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
    darkMode: 'class',
    theme: {
        extend: {
            colors: { primary: '#2563eb' },
            keyframes: {
                fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                slideIn: { '0%': { transform: 'translateX(-100%)' }, '100%': { transform: 'translateX(0)' } }
            },
            animation: { fadeIn: 'fadeIn 0.8s ease-out', slideIn: 'slideIn 0.3s ease-out' }
        }
    }
}
</script>
</head>
<body class="flex flex-col md:flex-row min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

<!-- HEADER MOBILE -->
<header class="md:hidden flex items-center justify-between bg-white dark:bg-gray-800 p-4 shadow-md">
    <div class="flex items-center gap-2">
        <button id="btn-sidebar" class="text-2xl font-bold focus:outline-none">☰</button>
        <span class="font-semibold text-primary">WR III Dashboard</span>
    </div>
</header>

<!-- SIDEBAR -->
<aside id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-md p-6 space-y-6 flex flex-col justify-between transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-20">
    <!-- Logo -->
    <div class="flex flex-col items-center mb-6">
        <img src="{{ asset('images/Logo-Unai.png') }}" alt="Logo UNAI" class="w-20 h-20 object-contain mb-2 animate-fadeIn">
        <span class="text-center text-lg font-semibold text-primary">Universitas Advent Indonesia</span>
    </div>

    <!-- Menu WR III -->
    <nav class="flex-1 space-y-2 text-gray-700 dark:text-gray-200 font-medium">
        <h2 class="text-xl font-bold text-primary mb-4 text-center md:text-left">☑️ Menu WR III</h2>
        <a href="{{ route('warek.dashboard') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-100 dark:hover:bg-gray-700 transition">
            🏠 <span class="ml-2">Dashboard</span>
        </a>
        <a href="{{ route('warek.dataorganisasi.index') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-100 dark:hover:bg-gray-700 transition">
            🏢 <span class="ml-2">Data Organisasi</span>
        </a>
        <a href="{{ route('warek.datakegiatan.index') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-100 dark:hover:bg-gray-700 transition">
            📅 <span class="ml-2">Data Kegiatan</span>
        </a>
        <a href="{{ route('warek.poin') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-100 dark:hover:bg-gray-700 transition">
            ⭐ <span class="ml-2">Poin Mahasiswa</span>
        </a>
        <a href="{{ route('skpi.index') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-100 dark:hover:bg-gray-700 transition">
            📄 <span class="ml-2">SKPI</span>
        </a>
    </nav>

    <!-- Logout -->
    <div>
        <a href="#" onclick="event.preventDefault(); confirmLogout();" class="flex items-center py-2 px-4 rounded-lg text-red-600 hover:bg-red-100 dark:hover:bg-red-700 transition">
            🚪 <span class="ml-2">Logout</span>
        </a>
    </div>

    <form id="logout-form" action="{{ route('logout.warek') }}" method="POST" class="hidden">
        @csrf
    </form>
</aside>

<!-- Overlay Mobile -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 hidden z-10 md:hidden"></div>

<!-- Main Content -->
<main class="flex-1 p-6 md:p-10 ml-0 md:ml-64 animate-fadeIn">
    @yield('content')
</main>

<script>
const btnSidebar = document.getElementById('btn-sidebar');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');

btnSidebar.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
});

overlay.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
});

function confirmLogout() {
    if (confirm("Apakah Anda yakin ingin keluar?")) {
        document.getElementById('logout-form').submit();
    }
}
</script>

</body>
</html>
