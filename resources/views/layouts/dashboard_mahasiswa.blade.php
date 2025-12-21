<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-white border-r border-gray-200 min-h-screen p-6">
        <h2 class="text-2xl font-bold mb-8 text-gray-800">Mahasiswa</h2>

        <nav class="space-y-3">

            <a href="/mahasiswa/dashboard"
               class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-200">
               Dashboard
            </a>

            <a href="/mahasiswa/kegiatan"
               class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-200">
               Kegiatan
            </a>

            <a href="/mahasiswa/organisasi"
               class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-200">
               Organisasi
            </a>

            <a href="{{ route('mahasiswa.klaim-poin') }}"
   class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-200">
   Poin SKPI
</a>


          <a href="{{ route('mahasiswa.logout') }}"
   class="block px-4 py-2 bg-red-500 rounded-lg hover:bg-red-600 text-white mt-10">
   Logout
</a>


        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-10">
        @yield('content')
    </main>

</body>
</html>
