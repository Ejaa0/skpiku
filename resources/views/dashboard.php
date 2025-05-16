<!DOCTYPE html>
<html lang="id" x-data>
<head>
    <meta charset="UTF-8" />
    <title>Dashboard Utama SKPI UNAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.15); }
        }
        .pulse-emoji {
            animation: pulse 2.5s ease-in-out infinite;
            display: inline-block;
            user-select: none;
        }
        .hover-raise:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        a.card {
            transition: all 0.3s ease;
            will-change: transform, box-shadow;
        }
        body {
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-6 py-12 font-sans">

<div class="max-w-6xl w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

    <!-- Admin -->
    <a href="<?php echo url('/login/admin'); ?>"
       class="card bg-gradient-to-br from-blue-400 to-blue-600 text-white rounded-3xl p-8 flex flex-col items-center justify-center shadow-lg hover-raise">
        <span class="pulse-emoji text-8xl mb-6 select-none">🛠️</span>
        <h2 class="text-2xl font-extrabold tracking-wide drop-shadow-md">Admin</h2>
        <p class="mt-2 text-blue-200 text-center max-w-xs">Login sebagai admin sistem untuk mengelola seluruh sistem</p>
    </a>

    <!-- Organisasi -->
    <a href="<?php echo url('/login/organisasi'); ?>"
       class="card bg-gradient-to-br from-green-400 to-green-600 text-white rounded-3xl p-8 flex flex-col items-center justify-center shadow-lg hover-raise">
        <span class="pulse-emoji text-8xl mb-6 select-none">🏢</span>
        <h2 class="text-2xl font-extrabold tracking-wide drop-shadow-md">Organisasi</h2>
        <p class="mt-2 text-green-200 text-center max-w-xs">Login sebagai organisasi mahasiswa untuk mengelola kegiatan dan info</p>
    </a>

    <!-- Mahasiswa -->
    <a href="<?php echo url('/login/mahasiswa'); ?>"
       class="card bg-gradient-to-br from-purple-500 to-purple-700 text-white rounded-3xl p-8 flex flex-col items-center justify-center shadow-lg hover-raise">
        <span class="pulse-emoji text-8xl mb-6 select-none">🎓</span>
        <h2 class="text-2xl font-extrabold tracking-wide drop-shadow-md">Mahasiswa</h2>
        <p class="mt-2 text-purple-300 text-center max-w-xs">Login sebagai mahasiswa untuk mengakses data dan aktivitas akademik</p>
    </a>

    <!-- Wakil Rektor -->
    <a href="<?php echo url('/login/warek'); ?>"
       class="card bg-gradient-to-br from-pink-500 to-pink-700 text-white rounded-3xl p-8 flex flex-col items-center justify-center shadow-lg hover-raise">
        <span class="pulse-emoji text-8xl mb-6 select-none">👨‍💼</span>
        <h2 class="text-2xl font-extrabold tracking-wide drop-shadow-md">Wakil Rektor III</h2>
        <p class="mt-2 text-pink-300 text-center max-w-xs">Login sebagai Wakil Rektor III untuk mengelola administrasi tinggi</p>
    </a>

</div>

</body>
</html>
