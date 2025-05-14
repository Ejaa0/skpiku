<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Utama | Gamifikasi SKPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-blue-100 to-white min-h-screen flex items-center justify-center px-4">
    <div class="max-w-4xl w-full">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-blue-700">Dashboard Utama</h1>
            <p class="text-gray-600 mt-2">Selamat datang di Aplikasi Gamifikasi SKPI</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card: Login Mahasiswa -->
            <a href="/login/mahasiswa" class="bg-white rounded-2xl shadow hover:shadow-xl p-6 text-center transition">
                <div class="text-blue-500 mb-2">
                    🎓
                </div>
                <h2 class="text-lg font-semibold">Login Mahasiswa</h2>
                <p class="text-sm text-gray-500 mt-1">Masuk sebagai Mahasiswa UNAI</p>
            </a>

            <!-- Card: Login Organisasi -->
            <a href="/login/organisasi" class="bg-white rounded-2xl shadow hover:shadow-xl p-6 text-center transition">
                <div class="text-green-500 mb-2">
                    🏛️
                </div>
                <h2 class="text-lg font-semibold">Login Organisasi</h2>
                <p class="text-sm text-gray-500 mt-1">Masuk sebagai perwakilan organisasi</p>
            </a>

            <!-- Card: Login Wakil Rektor III -->
            <a href="/login/warek" class="bg-white rounded-2xl shadow hover:shadow-xl p-6 text-center transition">
                <div class="text-yellow-500 mb-2">
                    👨‍💼
                </div>
                <h2 class="text-lg font-semibold">Login Wakil Rektor III</h2>
                <p class="text-sm text-gray-500 mt-1">Akses sebagai WR III</p>
            </a>

            <!-- Card: Login Admin -->
            <a href="/login/admin" class="bg-white rounded-2xl shadow hover:shadow-xl p-6 text-center transition">
                <div class="text-red-500 mb-2">
                    🛠️
                </div>
                <h2 class="text-lg font-semibold">Login Admin</h2>
                <p class="text-sm text-gray-500 mt-1">Masuk sebagai Admin sistem</p>
            </a>
        </div>
    </div>
</body>
</html>
