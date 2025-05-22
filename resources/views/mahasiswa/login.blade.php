@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-tr from-blue-100 to-white px-4">
        <div class="w-full max-w-md bg-white p-8 rounded-3xl shadow-xl">
            <!-- Emoji dan Judul -->
            <div class="text-center mb-6">
                <div class="text-6xl animate-bounce mb-2 select-none">🎓</div>
                <h2 class="text-3xl font-extrabold text-blue-700">Login Mahasiswa</h2>
                <p class="text-gray-500 text-sm mt-1">Selamat datang di sistem SKPI UNAI!</p>
            </div>

            <!-- Form -->
            <form action="{{ route('mahasiswa.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <!-- NIM -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">NIM</label>
                    <input type="text" name="nim"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan NIM Anda" required>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan password" required>
                </div>

                <!-- Tombol -->
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                        🔐 Masuk
                    </button>
                </div>
            </form>

            <!-- Tombol kembali -->
            <div class="text-center mt-6">
                <a href="http://127.0.0.1:8000/"
                    class="inline-block text-sm text-blue-600 hover:text-blue-800 font-medium transition duration-200">
                    ⬅ Kembali ke Dashboard Utama
                </a>
            </div>
        </div>
    </div>
@endsection
