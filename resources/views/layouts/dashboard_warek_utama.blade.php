<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard WR III</title>

<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
    darkMode: 'class',
    theme: {
        extend: {
            colors: { primary: '#2563eb' },
            keyframes: {
                fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                scaleIn: {
                    '0%': { opacity: '0', transform: 'scale(0.9)' },
                    '100%': { opacity: '1', transform: 'scale(1)' }
                }
            },
            animation: {
                fadeIn: 'fadeIn 0.4s ease-out',
                scaleIn: 'scaleIn 0.25s ease-out'
            }
        }
    }
}
</script>
</head>

<body class="flex flex-col md:flex-row min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

<!-- ================= POPUP SUCCESS ================= -->
@if (session('success'))
<div id="successModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 animate-fadeIn">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-sm p-6 animate-scaleIn">

        <div class="text-center">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
                <span class="text-green-600 dark:text-green-300 text-xl">✓</span>
            </div>

            <h2 class="text-lg font-semibold">Berhasil</h2>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                {{ session('success') }}
            </p>
        </div>

        <div class="mt-6 flex justify-center">
            <button onclick="closeSuccessModal()"
                class="px-5 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition">
                OK
            </button>
        </div>
    </div>
</div>
@endif
<!-- ================= END POPUP SUCCESS ================= -->

<!-- HEADER MOBILE -->
<header class="md:hidden flex items-center justify-between bg-white dark:bg-gray-800 p-4 shadow-md">
    <button id="btn-sidebar" class="text-2xl font-bold">☰</button>
    <span class="font-semibold text-primary">WR III Dashboard</span>
</header>

<!-- SIDEBAR -->
<aside id="sidebar"
    class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-lg
           p-5 flex flex-col transform -translate-x-full md:translate-x-0
           transition duration-300 z-20">

    <div class="flex flex-col items-center border-b pb-4 dark:border-gray-700">
        <img src="{{ asset('images/Logo-Unai.png') }}" class="w-16 h-16 object-contain mb-2">
        <h1 class="text-sm font-semibold text-center text-primary leading-tight">
            Universitas Advent Indonesia
        </h1>
        <span class="text-xs text-gray-500 dark:text-gray-400">
            WR III Dashboard
        </span>
    </div>

    <nav class="mt-6 flex-1 space-y-1 text-sm font-medium">
        <a href="{{ route('warek.dashboard') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-100 dark:hover:bg-gray-700">
            🏠 Dashboard
        </a>

        <a href="{{ route('warek.dataorganisasi.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-100 dark:hover:bg-gray-700">
            🏢 Data Organisasi
        </a>

        <a href="{{ route('warek.datakegiatan.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-100 dark:hover:bg-gray-700">
            📅 Data Kegiatan
        </a>

        <a href="{{ route('warek.poin') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-100 dark:hover:bg-gray-700">
            ⭐ Poin Mahasiswa
        </a>

        <a href="{{ route('warek.penentuanpoin.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-100 dark:hover:bg-gray-700">
            🧮 Penentuan Poin
        </a>

        
    </nav>

    <div class="pt-4 border-t dark:border-gray-700">
        <button onclick="openLogoutModal()"
            class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-red-600 hover:bg-red-100 dark:hover:bg-red-700">
            🚪 Logout
        </button>
    </div>
</aside>

<div id="overlay" class="fixed inset-0 bg-black/40 hidden md:hidden z-10"></div>

<main class="flex-1 p-6 md:ml-64">
    @yield('content')
</main>

<!-- ================= MODAL LOGOUT ================= -->
<div id="logoutModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-sm p-6 animate-scaleIn">

        <div class="text-center">
            <div class="text-4xl mb-3">⚠️</div>
            <h2 class="text-xl font-semibold mb-2">Konfirmasi Logout</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Apakah Anda yakin ingin keluar dari sistem?
            </p>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <button onclick="closeLogoutModal()"
                class="px-4 py-2 rounded-lg border dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                Batal
            </button>
            <button onclick="submitLogout()"
                class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                Logout
            </button>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout.warek') }}" method="POST" class="hidden">
    @csrf
</form>

<script>
const btnSidebar = document.getElementById('btn-sidebar');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
const logoutModal = document.getElementById('logoutModal');
const successModal = document.getElementById('successModal');

btnSidebar?.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
});

overlay?.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
});

function openLogoutModal() {
    logoutModal.classList.remove('hidden');
}

function closeLogoutModal() {
    logoutModal.classList.add('hidden');
}

function submitLogout() {
    document.getElementById('logout-form').submit();
}

function closeSuccessModal() {
    successModal?.classList.add('hidden');
}

// Auto close popup success setelah 2.5 detik
if (successModal) {
    setTimeout(() => {
        successModal.classList.add('hidden');
    }, 2500);
}
</script>

</body>
</html>
