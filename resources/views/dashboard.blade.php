<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard Utama | Gamifikasi SKPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom animasi bounce kecil */
        @keyframes bounce-slow {
          0%, 100% {
            transform: translateY(0);
          }
          50% {
            transform: translateY(-8px);
          }
        }
        .animate-bounce-slow {
          animation: bounce-slow 2.5s infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen flex items-center justify-center px-6 py-12">

    <div class="max-w-5xl w-full space-y-10">
        <header class="text-center">
            <h1 class="text-5xl font-extrabold text-blue-800 drop-shadow-lg mb-2 tracking-tight">Dashboard Utama</h1>
            <p class="text-lg text-blue-600 font-semibold">Selamat datang di Aplikasi Gamifikasi SKPI</p>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Card: Login Mahasiswa -->
            <a href="/login/mahasiswa" class="relative group bg-white rounded-3xl shadow-lg p-8 flex flex-col items-center text-center transition-transform duration-300 hover:-translate-y-3 hover:shadow-2xl">
                <div class="text-blue-500 mb-5 text-7xl animate-bounce-slow">🎓</div>
                <h2 class="text-xl font-bold text-blue-700 group-hover:text-blue-900 transition">Login Mahasiswa</h2>
                <p class="mt-1 text-gray-500 group-hover:text-gray-700 transition">Masuk sebagai Mahasiswa UNAI</p>
                <div class="absolute bottom-5 opacity-0 group-hover:opacity-100 left-1/2 transform -translate-x-1/2 w-12 h-1 bg-blue-500 rounded-full transition-opacity"></div>
            </a>

            <!-- Card: Login Organisasi -->
            <a href="/login/organisasi" class="relative group bg-white rounded-3xl shadow-lg p-8 flex flex-col items-center text-center transition-transform duration-300 hover:-translate-y-3 hover:shadow-2xl">
                <div class="text-green-500 mb-5 text-7xl animate-bounce-slow">🏛️</div>
                <h2 class="text-xl font-bold text-green-700 group-hover:text-green-900 transition">Login Organisasi</h2>
                <p class="mt-1 text-gray-500 group-hover:text-gray-700 transition">Masuk sebagai perwakilan organisasi</p>
                <div class="absolute bottom-5 opacity-0 group-hover:opacity-100 left-1/2 transform -translate-x-1/2 w-12 h-1 bg-green-500 rounded-full transition-opacity"></div>
            </a>

            <!-- Card: Login Wakil Rektor III -->
            <a href="/login/warek" class="relative group bg-white rounded-3xl shadow-lg p-8 flex flex-col items-center text-center transition-transform duration-300 hover:-translate-y-3 hover:shadow-2xl">
                <div class="text-yellow-500 mb-5 text-7xl animate-bounce-slow">👨‍💼</div>
                <h2 class="text-xl font-bold text-yellow-600 group-hover:text-yellow-800 transition">Login Wakil Rektor III</h2>
                <p class="mt-1 text-gray-500 group-hover:text-gray-700 transition">Akses sebagai WR III</p>
                <div class="absolute bottom-5 opacity-0 group-hover:opacity-100 left-1/2 transform -translate-x-1/2 w-12 h-1 bg-yellow-500 rounded-full transition-opacity"></div>
            </a>

            <!-- Card: Login Admin -->
            <a href="/login/admin" class="relative group bg-white rounded-3xl shadow-lg p-8 flex flex-col items-center text-center transition-transform duration-300 hover:-translate-y-3 hover:shadow-2xl">
                <div class="text-red-500 mb-5 text-7xl animate-bounce-slow">🛠️</div>
                <h2 class="text-xl font-bold text-red-600 group-hover:text-red-800 transition">Login Admin</h2>
                <p class="mt-1 text-gray-500 group-hover:text-gray-700 transition">Masuk sebagai Admin sistem</p>
                <div class="absolute bottom-5 opacity-0 group-hover:opacity-100 left-1/2 transform -translate-x-1/2 w-12 h-1 bg-red-500 rounded-full transition-opacity"></div>
            </a>
        </div>
    </div>

</body>
</html>
