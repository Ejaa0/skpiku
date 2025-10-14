<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SKPI UNAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-900 via-purple-900 to-pink-900 flex items-center justify-center h-screen">

    <div class="bg-gray-800/90 backdrop-blur-md p-10 rounded-2xl shadow-2xl w-96 text-white">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold mb-2">SKPI UNAI</h2>
            <p class="text-gray-300">Masuk untuk mengakses dashboard</p>
        </div>

        @if(session('error'))
        <div class="bg-red-500 text-white p-2 rounded mb-4 text-center">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block mb-2 font-semibold">Email</label>
                <input type="email" name="email" class="w-full p-3 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan email" required>
            </div>
            <div>
                <label class="block mb-2 font-semibold">Password</label>
                <input type="password" name="password" class="w-full p-3 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 transition duration-300 p-3 rounded-lg font-bold text-lg shadow-md">Login</button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('forgot-password') }}" class="text-indigo-400 hover:text-indigo-200 underline">Lupa Password?</a>
        </div>
    </div>

</body>
</html>
