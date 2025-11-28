<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - SKPI UNAI</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-gradient-to-br from-blue-300 via-indigo-200 to-purple-300 flex items-center justify-center min-h-screen">

    <div class="bg-white/80 backdrop-blur-xl p-10 rounded-3xl shadow-2xl w-96 border border-gray-300">
        
        <!-- Header -->
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-indigo-700">Forgot Password</h2>
            <p class="text-gray-600 text-sm">Masukkan email dan password baru Anda</p>
        </div>

        <!-- Error -->
        @if(session('error'))
        <div class="bg-red-500 text-white p-2 rounded mb-4 text-center shadow-md">
            {{ session('error') }}
        </div>
        @endif

        <!-- Success -->
        @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4 text-center shadow-md">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('forgot-password') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Email</label>
                <div class="relative">
                    <i data-feather="mail" class="absolute left-3 top-3 text-gray-500"></i>
                    <input type="email" 
                        name="email"
                        class="w-full p-3 pl-10 rounded-lg text-black bg-gray-100 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400" 
                        placeholder="Masukkan email" required>
                </div>
            </div>

            <!-- Password Baru -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Password Baru</label>
                <div class="relative">
                    <i data-feather="lock" class="absolute left-3 top-3 text-gray-500"></i>
                    <input type="password" 
                        id="password"
                        name="password"
                        class="w-full p-3 pl-10 pr-10 rounded-lg text-black bg-gray-100 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400" 
                        placeholder="Masukkan password baru" required>
                    <i data-feather="eye" id="togglePassword" class="absolute right-3 top-3 text-gray-500 cursor-pointer"></i>
                </div>
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Konfirmasi Password</label>
                <div class="relative">
                    <i data-feather="lock" class="absolute left-3 top-3 text-gray-500"></i>
                    <input type="password" 
                        id="password_confirmation"
                        name="password_confirmation"
                        class="w-full p-3 pl-10 pr-10 rounded-lg text-black bg-gray-100 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400" 
                        placeholder="Ulangi password baru" required>
                    <i data-feather="eye" id="togglePasswordConfirm" class="absolute right-3 top-3 text-gray-500 cursor-pointer"></i>
                </div>
            </div>

            <!-- Tombol -->
            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 transition-all duration-300 p-3 rounded-lg font-bold text-lg text-white shadow-lg">
                Ganti Password
            </button>
        </form>

        <!-- Kembali ke login -->
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-indigo-700 hover:underline">
                Kembali ke Login
            </a>
        </div>
    </div>

    <!-- Script Feather & Toggle Password -->
    <script>
        feather.replace();

        // Toggle password baru
        document.getElementById("togglePassword").addEventListener("click", function () {
            const input = document.getElementById("password");
            input.type = input.type === "password" ? "text" : "password";
        });

        // Toggle konfirmasi password
        document.getElementById("togglePasswordConfirm").addEventListener("click", function () {
            const input = document.getElementById("password_confirmation");
            input.type = input.type === "password" ? "text" : "password";
        });
    </script>

</body>
</html>
