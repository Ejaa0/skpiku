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
                    animation: { fadeIn: 'fadeIn 0.8s ease-out', slideIn: 'slideIn 0.5s ease-out' }
                }
            }
        }
    </script>
</head>
<body class="flex flex-col md:flex-row min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

   <!-- Sidebar -->
<aside class="w-full md:w-64 bg-white dark:bg-gray-800 shadow-md p-6 space-y-4 animate-slideIn z-10">
    <div class="flex flex-col items-center mb-4">
        <img src="{{ asset('images/Logo-Unai.png') }}" alt="Logo UNAI" class="w-20 h-20 object-contain mb-2 animate-fadeIn">
        <span class="text-center text-lg font-semibold text-primary">Universitas Advent Indonesia</span>
    </div>

    <h2 class="text-xl font-bold text-primary mt-4 mb-6 text-center md:text-left">☑️ Menu WR III</h2>

    <nav class="space-y-2 text-gray-700 dark:text-gray-200 font-medium">
        <a href="{{ route('warek.dashboard') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-100 dark:hover:bg-gray-700 transition">
            🏠 <span class="ml-2">Dashboard</span>
        </a>
        <!-- Perbaikan route menu Data Organisasi WR III -->
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
        <a href="#" onclick="event.preventDefault(); confirmLogout();" class="flex items-center py-2 px-4 rounded-lg text-red-600 hover:bg-red-100 dark:hover:bg-red-700 transition">
            🚪 <span class="ml-2">Logout</span>
        </a>
    </nav>

    <form id="logout-form" action="{{ route('logout.warek') }}" method="POST" class="hidden">
        @csrf
    </form>
</aside>

<!-- Main Content -->
<main class="flex-1 p-6 md:p-10 animate-fadeIn">
    @yield('content')
</main>

<script>
    function confirmLogout() {
        if (confirm("Apakah Anda yakin ingin keluar?")) {
            document.getElementById('logout-form').submit();
        }
    }
</script>
</body>
</html>
