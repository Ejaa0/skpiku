<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard WR III</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg">
            <div class="p-6 text-center border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">WR III SKPI</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Wakil Rektor III</p>
            </div>
            <nav class="mt-4">
                <ul class="space-y-2 px-4">
                    <li>
                        <a href="{{ route('warek.dashboard') }}"
                            class="block py-2 px-4 rounded hover:bg-blue-100 dark:hover:bg-gray-700">
                            📊 Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('organisasi.index') }}"
                            class="block py-2 px-4 rounded hover:bg-blue-100 dark:hover:bg-gray-700">
                            🏢 Data Organisasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mahasiswa.index') }}"
                            class="block py-2 px-4 rounded hover:bg-blue-100 dark:hover:bg-gray-700">
                            🎓 Data Mahasiswa
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kegiatan.index') }}"
                            class="block py-2 px-4 rounded hover:bg-blue-100 dark:hover:bg-gray-700">
                            📆 Kegiatan
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            onclick="event.preventDefault(); confirmLogout();"
                            class="block py-2 px-4 rounded text-red-600 hover:bg-red-100 dark:hover:bg-gray-700">
                            🚪 Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

    <script>
        function confirmLogout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</body>

</html>
