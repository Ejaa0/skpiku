<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SKPI')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-blue-600 text-white px-6 py-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-lg font-bold">SKPI System</h1>
            <div class="space-x-4">
                <a href="{{ route('mahasiswa.index') }}" class="hover:underline">Mahasiswa</a>
                <a href="{{ route('kegiatan.index') }}" class="hover:underline">Kegiatan</a>
                <a href="{{ route('organisasi.index') }}" class="hover:underline">Organisasi</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-6 px-4">
        @yield('content')
    </div>

</body>
</html>
