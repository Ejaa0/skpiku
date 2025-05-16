<!-- resources/views/warek/dashboard_warek_utama.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard WR III</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md p-4">
        <h2 class="text-xl font-semibold mb-6">Menu WR III</h2>
        <ul class="space-y-2">
            <li>
                <a href="{{ route('warek.dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-200">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('organisasi.index') }}" class="block py-2 px-4 rounded hover:bg-gray-200">
                    Data Organisasi
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.index') }}" class="block py-2 px-4 rounded hover:bg-gray-200">
                    Data Mahasiswa
                </a>
            </li>
            <li>
                <a href="{{ route('kegiatan.index') }}" class="block py-2 px-4 rounded hover:bg-gray-200">
                    Data Kegiatan
                </a>
            </li>
            <li>
                <a href="{{ route('poin.index') }}" class="block py-2 px-4 rounded hover:bg-gray-200">
                    Poin Mahasiswa
                </a>
            </li>
            <li>
                <a href="#" onclick="event.preventDefault(); confirmLogout();" class="block py-2 px-4 rounded text-red-600 hover:bg-red-100">
                    Logout
                </a>
            </li>
        </ul>

        <!-- Logout Form -->
        <form id="logout-form" action="{{ route('logout.warek') }}" method="POST" class="hidden">
            @csrf
        </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <h1 class="text-2xl font-bold mb-4">Selamat Datang, Wakil Rektor III</h1>
        {{-- Konten dashboard lainnya di sini --}}
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
