<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Kegiatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex font-sans">

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-blue-700 to-blue-500 text-white shadow-xl">
        <div class="p-6 text-2xl font-bold border-b border-blue-400">
            🎓 UNAI Dashboard
        </div>
        <nav class="p-4 space-y-3 text-sm font-medium">
            <a href="{{ url('/mahasiswa/dashboard') }}"
                class="block py-2 px-4 rounded transition duration-200
                    {{ request()->is('mahasiswa/dashboard') ? 'bg-white text-blue-700 font-bold' : 'hover:bg-blue-600' }}">
                📊 Dashboard Utama
            </a>

            <a href="{{ route('mahasiswa.data') }}"
                class="block py-2 px-4 rounded transition duration-200
                    {{ request()->routeIs('mahasiswa.data') ? 'bg-white text-blue-700 font-bold' : 'hover:bg-blue-600' }}">
                🧾 Data Mahasiswa
            </a>

            <a href="{{ route('mahasiswa.data_kegiatan') }}"
                class="block py-2 px-4 rounded transition duration-200
                    {{ request()->routeIs('mahasiswa.data_kegiatan') ? 'bg-white text-blue-700 font-bold' : 'hover:bg-blue-600' }}">
                📅 Data Kegiatan
            </a>

            <form method="POST" action="{{ route('logout.mahasiswa') }}" class="pt-6">
                @csrf
                <button type="submit"
                    class="w-full py-2 px-4 bg-red-500 hover:bg-red-600 text-white rounded shadow-md transition">
                    🚪 Logout
                </button>
            </form>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        <h1 class="text-4xl font-bold text-blue-700 mb-8">📅 Data Kegiatan</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('mahasiswa.data_kegiatan') }}" class="mb-2 max-w-md flex gap-2">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="🔍 Cari NIM, Nama, Jenis, atau Nama Kegiatan..."
                class="flex-grow px-4 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
                Cari
            </button>
            @if (!empty($search))
                <a href="{{ route('mahasiswa.data_kegiatan') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                    Reset
                </a>
            @endif
        </form>

        <!-- Instruksi -->
        <p class="mb-6 max-w-md text-gray-600 italic text-sm">
            Silahkan masukkan NIM, Nama, atau Nama Kegiatan
        </p>

        <!-- Tabel hanya muncul jika ada pencarian -->
        @if (!empty($search))
            <div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-200 max-w-full">
                <table class="min-w-full text-sm">
                    <thead class="bg-blue-600 text-white uppercase text-left">
                        <tr>
                            <th class="px-6 py-3 font-semibold">NIM</th>
                            <th class="px-6 py-3 font-semibold">Nama</th>
                            <th class="px-6 py-3 font-semibold">ID Kegiatan</th>
                            <th class="px-6 py-3 font-semibold">Jenis Kegiatan</th>
                            <th class="px-6 py-3 font-semibold">Nama Kegiatan</th>
                            <th class="px-6 py-3 font-semibold">Tanggal Kegiatan</th>
                            <th class="px-6 py-3 font-semibold">Absensi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @forelse ($kegiatan as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->nim }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->id_kegiatan ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->jenis_kegiatan ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama_kegiatan ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->tanggal_kegiatan ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->absensi ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-6 text-center text-gray-500">
                                    Tidak ada data kegiatan ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif

    </main>
</body>
</html>
