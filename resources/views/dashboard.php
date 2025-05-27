<!DOCTYPE html>
<html lang="id">

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
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        a.card {
            transition: all 0.3s ease;
            will-change: transform, box-shadow;
        }
        body {
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
        }
        /* Style untuk tombol WhatsApp di kiri bawah */
        #help-center {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #25D366; /* Hijau WhatsApp */
            width: 56px;
            height: 56px;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
            cursor: pointer;
            z-index: 1000;
        }
        #help-center:hover {
            transform: scale(1.15);
        }
        #help-center svg {
            width: 28px;
            height: 28px;
            fill: white;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center px-6 py-12 font-sans">

    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800">
            Selamat Datang di <span class="text-blue-700">UNAI Gamification!</span>
        </h1>
        <p class="text-gray-600 mt-2">Silakan pilih role login sesuai dengan peran Anda di sistem SKPI</p>
    </div>

    <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-3 gap-10">

        <a href="<?php echo url('/login/mahasiswa'); ?>"
            class="card bg-gradient-to-br from-purple-500 to-purple-700 text-white rounded-3xl p-8 flex flex-col items-center justify-center shadow-lg hover-raise">
            <span class="pulse-emoji text-8xl mb-6">🎓</span>
            <h2 class="text-2xl font-extrabold tracking-wide drop-shadow-md">Mahasiswa</h2>
            <p class="mt-2 text-purple-300 text-center max-w-xs">Login sebagai mahasiswa untuk mengakses data dan aktivitas akademik</p>
        </a>

        <a href="<?php echo url('/login/organisasi'); ?>"
            class="card bg-gradient-to-br from-green-400 to-green-600 text-white rounded-3xl p-8 flex flex-col items-center justify-center shadow-lg hover-raise">
            <span class="pulse-emoji text-8xl mb-6">🏢</span>
            <h2 class="text-2xl font-extrabold tracking-wide drop-shadow-md">Organisasi</h2>
            <p class="mt-2 text-green-200 text-center max-w-xs">Login sebagai organisasi mahasiswa untuk mengelola kegiatan dan info</p>
        </a>

        <a href="<?php echo url('/login/warek'); ?>"
            class="card bg-gradient-to-br from-pink-500 to-pink-700 text-white rounded-3xl p-8 flex flex-col items-center justify-center shadow-lg hover-raise">
            <span class="pulse-emoji text-8xl mb-6">👨‍💼</span>
            <h2 class="text-2xl font-extrabold tracking-wide drop-shadow-md">Wakil Rektor III</h2>
            <p class="mt-2 text-pink-300 text-center max-w-xs">Login sebagai Wakil Rektor III untuk mengelola administrasi tinggi</p>
        </a>

    </div>

    <a id="help-center" href="https://wa.me/6281223236894" target="_blank" rel="noopener" aria-label="Help Center WhatsApp">
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M20.52 3.48A11.868 11.868 0 0 0 12 0C5.372 0 0 5.372 0 12c0 2.12.555 4.146 1.608 5.935L0 24l6.292-1.582A11.922 11.922 0 0 0 12 24c6.627 0 12-5.372 12-12 0-3.21-1.254-6.22-3.48-8.52zm-1.834 13.3c-.278.78-1.504 1.49-2.077 1.6-.553.11-1.202.16-3.328-.766-3.021-1.178-4.976-4.61-5.132-4.857-.156-.246-1.27-1.676-1.27-3.2 0-1.524.806-2.28 1.092-2.596.288-.317.63-.4.84-.4.21 0 .425 0 .61.003.196.002.46-.074.704.553.245.627.837 2.18.91 2.34.074.16.12.353.015.57-.104.216-.156.35-.31.55-.156.2-.33.45-.47.61-.156.157-.316.335-.14.64.176.3.78 1.27 1.67 2.06 1.16 1.18 2.134 1.57 2.45 1.75.31.177.492.15.67-.09.178-.245.62-.72.795-.968.176-.246.352-.205.6-.123.246.08 1.56.735 1.83.866.27.127.45.19.514.297.066.11.066.63-.21 1.41z"></path>
        </svg>
    </a>

</body>

</html>