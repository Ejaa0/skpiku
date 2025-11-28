<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SKPI UNAI</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @keyframes subtle-glow {
            0%, 100% { box-shadow: 0 0 15px rgba(59, 130, 246, 0.25); }
            50%     { box-shadow: 0 0 25px rgba(37, 99, 235, 0.45); }
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <!-- Container -->
    <div class="bg-white p-10 rounded-3xl shadow-xl w-96 border border-gray-200">

        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-4xl font-extrabold tracking-wide text-blue-600 drop-shadow-sm">
                SKPI UNAI
            </h2>
            <p class="text-gray-600 text-sm mt-2">Masuk untuk mengakses dashboard</p>
        </div>

        <!-- Error -->
        @if(session('error'))
        <div class="bg-red-500 text-white p-2 rounded-lg mb-4 text-center shadow-md">
            {{ session('error') }}
        </div>
        @endif

        <!-- Form -->
        <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Input Email -->
            <div>
                <label class="block mb-2 font-semibold tracking-wide text-gray-700">Email</label>

                <div class="relative">
                    <!-- Icon Email -->
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </span>

                    <!-- Input -->
                    <input type="email" 
                        name="email"
                        class="w-full p-3 pl-11 rounded-lg text-black bg-gray-100 border border-gray-300
                               focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                        placeholder="Masukkan email"
                        required>
                </div>
            </div>

            <!-- Input Password -->
            <div>
                <label class="block mb-2 font-semibold tracking-wide text-gray-700">Password</label>

                <div class="relative">
                    <!-- Icon Lock -->
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-5a2 2 0 00-2-2H6a2 2 0 00-2 2v5a2 2 0 002 2zm10-9V7a4 4 0 10-8 0v5"/>
                        </svg>
                    </span>

                    <!-- Input -->
                    <input type="password"
                        id="passwordField"
                        name="password"
                        class="w-full p-3 pl-11 pr-11 rounded-lg text-black bg-gray-100 border border-gray-300
                               focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                        placeholder="Masukkan password"
                        required>

                    <!-- Icon Mata -->
                    <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500"
                          onclick="togglePassword()">
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7S3.732 16.057 2.458 12z"/>
                        </svg>

                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.543-7a10.06 10.06 0 012.34-4.045m3.39-2.51A9.97 9.97 0 0112 5c4.478 0 8.269 2.943 9.543 7a9.97 9.97 0 01-.985 2.3M15 12a3 3 0 00-3-3m0 0a3 3 0 013 3m-3-3L3 3m9 9l9 9"/>
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Tombol Login -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-500 transition-all duration-300 p-3 rounded-xl
                       font-bold text-lg text-white shadow-lg hover:shadow-xl
                       animate-[subtle-glow_2s_ease-in-out_infinite]">
                Login
            </button>
        </form>

        <!-- Lupa Password -->
        <div class="mt-6 text-center">
            <a href="{{ route('forgot-password') }}"
               class="text-blue-600 hover:text-blue-400 underline transition">
                Lupa Password?
            </a>
        </div>

    </div>

    <!-- Script Toggle Password -->
    <script>
        function togglePassword() {
            const input = document.getElementById('passwordField');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');

            if (input.type === "password") {
                input.type = "text";
                eyeOpen.classList.add("hidden");
                eyeClosed.classList.remove("hidden");
            } else {
                input.type = "password";
                eyeOpen.classList.remove("hidden");
                eyeClosed.classList.add("hidden");
            }
        }
    </script>

</body>
</html>
