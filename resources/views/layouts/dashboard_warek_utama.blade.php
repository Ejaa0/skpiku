<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard WR III</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(0)' },
                        }
                    },
                    animation: {
                        fadeIn: 'fadeIn 0.8s ease-out',
                        slideIn: 'slideIn 0.5s ease-out',
                    }
                }
            }
        }
    </script>
</head>
<body class="flex flex-col md:flex-row min-h-screen bg-gray-100 text-gray-800">

    <!-- Sidebar -->
    <aside class="w-full md:w-64 bg-white shadow-md p-6 space-y-4 animation-slideIn z-10">
        <!-- Logo UNAI -->
        <div class="flex flex-col items-center mb-4">
            <img src="{{ asset('images/Logo-Unai.png') }}" alt="Logo UNAI" class="w-20 h-20 object-contain mb-2 animate-fadeIn">
            <span class="text-center text-lg font-semibold text-primary">Universitas Advent Indonesia</span>
        </div>

        <h2 class="text-xl font-bold text-primary mt-4 mb-6 text-center md:text-left">☑️ Menu WR III</h2>

        <nav class="space-y-2 text-gray-700 font-medium">
            <a href="{{ route('warek.dashboard') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-100 transition">
                🏠 <span class="ml-2">Dashboard</span>
            </a>
            <a href="{{ route('organisasi.index') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-100 transition">
                🏢 <span class="ml-2">Data Organisasi</span>
            </a>
            <a href="{{ url('/mahasiswa/data') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-100 transition">
                🎓 <span class="ml-2">Data Mahasiswa</span>
            </a>
            <a href="{{ route('kegiatan.index') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-100 transition">
                📅 <span class="ml-2">Data Kegiatan</span>
            </a>
            <a href="{{ route('poin.index') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-100 transition">
                ⭐ <span class="ml-2">Poin Mahasiswa</span>
            </a>
            <a href="{{ route('skpi.index') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-100 transition">
                📄 <span class="ml-2">SKPI</span>
            </a>
            <a href="#" onclick="event.preventDefault(); confirmLogout();" class="flex items-center py-2 px-4 rounded-lg text-red-600 hover:bg-red-100 transition">
                🚪 <span class="ml-2">Logout</span>
            </a>
        </nav>

        <!-- Logout Form -->
        <form id="logout-form" action="{{ route('logout.warek') }}" method="POST" class="hidden">
            @csrf
        </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 md:p-10 bg-gray-50 animate-fadeIn">
        <div class="bg-white p-6 md:p-8 rounded-xl shadow-md">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">👋 Selamat Datang, Wakil Rektor III</h1>
            <p class="text-gray-600 mb-6">Anda berada di halaman utama sistem informasi kegiatan organisasi mahasiswa.</p>

            <!-- Statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-blue-100 p-5 rounded-lg shadow hover:scale-105 transition-transform">
                    <p class="text-gray-800 font-semibold">Total Organisasi</p>
                    <h2 class="text-2xl font-bold text-blue-600">{{ $totalOrganisasi }}</h2>
                </div>
                <div class="bg-green-100 p-5 rounded-lg shadow hover:scale-105 transition-transform">
                    <p class="text-gray-800 font-semibold">Kegiatan Terjadwal</p>
                    <h2 class="text-2xl font-bold text-green-600">{{ $totalKegiatan }}</h2>
                </div>
                <div class="bg-yellow-100 p-5 rounded-lg shadow hover:scale-105 transition-transform">
                    <p class="text-gray-800 font-semibold">Laporan Masuk</p>
                    <h2 class="text-2xl font-bold text-yellow-600">{{ $laporanMasuk }}</h2>
                </div>
            </div>
        </div>
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
