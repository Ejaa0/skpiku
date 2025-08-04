<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bounce {
            animation: bounce 1.5s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .glow {
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 5px #3b82f6, 0 0 10px #3b82f6;
            }
            to {
                text-shadow: 0 0 20px #2563eb, 0 0 30px #2563eb;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md">
        <div class="text-center mb-6">
            <div class="text-5xl bounce">🎓</div>
            <h2 class="text-2xl font-bold text-blue-700 mt-2 glow">Login Mahasiswa</h2>
            <p class="text-sm text-gray-500">Silakan masuk untuk melanjutkan ke sistem SKPI UNAI</p>
        </div>

        {{-- Pesan Error --}}
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        {{-- Form Login --}}
        <form method="POST" action="{{ route('mahasiswa.login.submit') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block font-medium text-gray-700">📧 Email</label>
                <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-sm text-red-500 mt-1">❌ {{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-medium text-gray-700">🔒 Password</label>
                <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                @error('password')
                    <p class="text-sm text-red-500 mt-1">❌ {{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200">
                🚀 Masuk
            </button>

            {{-- Tombol Kembali --}}
            <div class="text-center mt-4">
                <a href="http://127.0.0.1:8000/" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded transition duration-200">
                    🔙 Kembali
                </a>
            </div>
        </form>

        <p class="text-xs text-center text-gray-600 mt-6 italic">
            💡 Hint: Gunakan email <strong>mahasiswa@unai.ac.id</strong> dan password <strong>123456</strong>
        </p>
    </div>

</body>
</html>
