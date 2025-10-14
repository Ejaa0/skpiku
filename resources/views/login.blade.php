<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SKPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-96 text-white">
        <h2 class="text-2xl font-bold mb-6 text-center">Login SKPI UNAI</h2>

        @if(session('error'))
        <div class="bg-red-500 p-2 rounded mb-4">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" name="email" class="w-full p-2 rounded text-black" required>
            </div>
            <div class="mb-6">
                <label class="block mb-1">Password</label>
                <input type="password" name="password" class="w-full p-2 rounded text-black" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 p-2 rounded">Login</button>
        </form>
    </div>
</body>
</html>
