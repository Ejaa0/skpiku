@extends('layouts.app')

@section('content')
<div class="w-full max-w-md mx-auto bg-white p-8 rounded-xl shadow-md">
    <div class="text-center mb-6">
        <div class="text-5xl mb-2">🛠️</div>
        <h2 class="text-2xl font-bold text-gray-800">Login Admin</h2>
        <p class="text-sm text-gray-500">Masuk untuk mengelola sistem SKPI</p>
    </div>

    <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6">
        @csrf

        <!-- Username -->
        <div>
            <label for="username" class="block mb-1 text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- Tombol Submit -->
        <div>
            <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition shadow-md">
                Masuk
            </button>
        </div>
    </form>

    <div class="text-center mt-6">
        <a href="/" class="text-sm text-blue-500 hover:underline">← Kembali ke Dashboard Utama</a>
    </div>
</div>
@endsection
