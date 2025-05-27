<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md">
        <div class="p-6 text-2xl font-bold border-b border-gray-200">
            UNAI Dashboard
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ url('/mahasiswa/dashboard') }}"
                class="block py-2 px-4 rounded font-semibold
                    {{ request()->is('mahasiswa/dashboard') ? 'bg-blue-500 text-white' : 'text-blue-600 hover:bg-blue-500 hover:text-white' }}">
                Dashboard Utama
            </a>

            <a href="{{ route('mahasiswa.data') }}"
                class="block py-2 px-4 rounded font-semibold
                    {{ request()->routeIs('mahasiswa.data') ? 'bg-blue-500 text-white' : 'text-blue-600 hover:bg-blue-500 hover:text-white' }}">
                Data Mahasiswa
            </a>

            <form method="POST" action="{{ route('logout.mahasiswa') }}">
                @csrf
                <button type="submit"
                    class="w-full mt-6 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Data Mahasiswa</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('mahasiswa.data') }}" class="mb-6">
            <div class="flex max-w-md">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari NIM atau Nama..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('mahasiswa.data') }}" 
                       class="ml-2 px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 text-gray-700">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <div class="overflow-x-auto bg-white rounded shadow p-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">NIM</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Nama</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Tempat Lahir</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Tanggal Lahir</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Jenis Kelamin</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Agama</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($mahasiswas as $mhs)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 whitespace-nowrap">{{ $mhs->nim }}</td>
                            <td class="px-6 py-3 whitespace-nowrap">{{ $mhs->nama ?? '-' }}</td>
                            <td class="px-6 py-3 whitespace-nowrap">{{ $mhs->temp_lahir ?? '-' }}</td>
                            <td class="px-6 py-3 whitespace-nowrap">{{ $mhs->tgl_lahir ?? '-' }}</td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                {{ $mhs->sex == 'L' ? 'Laki-laki' : ($mhs->sex == 'P' ? 'Perempuan' : '-') }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap">{{ $mhs->agama ?? '-' }}</td>
                            <td class="px-6 py-3 whitespace-nowrap">{{ $mhs->email ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Data mahasiswa tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>

</html>
