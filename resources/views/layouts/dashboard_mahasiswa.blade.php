<!DOCTYPE html>
<html lang="id" x-data="friendApp()">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Mahasiswa</title>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- AlpineJS -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex overflow-x-hidden">

<!-- ================= SIDEBAR KIRI ================= -->
<aside x-show="openSidebar || window.innerWidth >= 1024"
       @click.outside="openSidebar=false"
       class="fixed inset-y-0 left-0 w-64 bg-white border-r flex flex-col justify-between p-6 z-50 transform transition-transform duration-300 shadow-lg lg:shadow-none"
       :class="openSidebar ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
    <div>
        <h2 class="text-2xl font-bold mb-1">Mahasiswa</h2>
        <p class="text-sm text-gray-500 mb-6">Dashboard SKPI</p>

        <nav class="flex flex-col space-y-2">
            <a href="{{ route('mahasiswa.dashboard') }}" class="menu {{ request()->routeIs('mahasiswa.dashboard')?'active':'' }}">
                <span class="inline-block mr-2">🏠</span> Dashboard
            </a>
            <a href="{{ route('mahasiswa.kegiatan') }}" class="menu {{ request()->routeIs('mahasiswa.kegiatan')?'active':'' }}">
                <span class="inline-block mr-2">📅</span> Kegiatan
            </a>
            <a href="{{ route('mahasiswa.organisasi') }}" class="menu {{ request()->routeIs('mahasiswa.organisasi')?'active':'' }}">
                <span class="inline-block mr-2">🏢</span> Organisasi
            </a>
            <a href="{{ route('mahasiswa.klaim-poin') }}" class="menu {{ request()->routeIs('mahasiswa.klaim-poin')?'active':'' }}">
                <span class="inline-block mr-2">⭐</span> Poin SKPI
            </a>
            <a href="{{ route('mahasiswa.leaderboard') }}" class="menu {{ request()->routeIs('mahasiswa.leaderboard')?'active':'' }}">
                <span class="inline-block mr-2">🏆</span> Leaderboard
            </a>
        </nav>
    </div>

    <!-- Logout Button -->
    <button id="logoutButton" class="w-full px-4 py-3 bg-red-50 text-red-600 rounded-xl mt-4 hover:bg-red-100 transition">🚪 Logout</button>

    <!-- Hidden Logout Form -->
    <form id="logoutForm" action="{{ route('mahasiswa.logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</aside>

<!-- ================= MAIN WRAPPER ================= -->
<div class="flex-1 flex flex-col min-h-screen transition-all duration-300 lg:ml-64">
    <header class="bg-white border-b px-4 sm:px-6 py-3 flex justify-between items-center sticky top-0 z-20 shadow-sm">
        <div class="flex items-center gap-3">
            <button @click="openSidebar=true" class="lg:hidden bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition">☰</button>
            <h2 class="font-bold text-gray-800 text-lg sm:text-xl">Dashboard Mahasiswa</h2>
        </div>
        <button @click="openFriend=!openFriend" class="lg:hidden bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition">👥 Teman</button>
    </header>

    <main class="p-4 sm:p-6 flex-1 overflow-auto w-full">
        @yield('content')
    </main>
</div>

<!-- ================= SIDEBAR KANAN TEMAN ================= -->
<aside :class="openFriend ? 'translate-x-0' : 'translate-x-full lg:translate-x-0'"
       class="fixed right-0 top-0 h-full w-72 bg-white border-l transform transition-transform shadow-lg z-40 flex flex-col">

    <!-- HEADER -->
    <div class="flex justify-between items-center px-4 py-3 border-b">
        <h3 class="font-bold text-lg">👥 Teman</h3>
        <button class="lg:hidden text-gray-500 hover:text-gray-700" @click="openFriend=false">✖</button>
    </div>

    <!-- BODY -->
    <div class="flex-1 overflow-y-auto p-4 space-y-4">

        <!-- Tombol Tambah Teman -->
        <button @click="document.getElementById('tambahTemanModal').classList.remove('hidden')"
                class="w-full px-3 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
            ➕ Tambah Teman
        </button>

        <!-- Daftar Teman -->
        <div>
            <h4 class="font-semibold mb-2">Daftar Teman</h4>
            <template x-for="teman in temanList" :key="teman.nim">
                <div class="flex items-center justify-between bg-gray-50 px-3 py-2 rounded-lg shadow-sm mb-2 hover:bg-gray-100 transition">
                    <div class="flex items-center gap-2">
                        <span :class="teman.online ? 'bg-green-400' : 'bg-gray-400'" class="w-3 h-3 rounded-full"></span>
                        <span x-text="teman.nama"></span>
                    </div>
                    <button @click="hapusTeman(teman.nim)" class="text-red-500 text-xs hover:text-red-700">✖</button>
                </div>
            </template>
            <p x-show="temanList.length === 0" class="text-xs text-gray-400">Belum ada teman</p>
        </div>

        <!-- Permintaan Teman -->
        <div>
            <h4 class="font-semibold mb-2">Permintaan Teman</h4>
            <template x-for="notif in notifikasi" :key="notif.id">
                <div class="flex justify-between items-center bg-yellow-50 px-3 py-2 rounded-lg shadow-sm mb-2 hover:bg-yellow-100 transition">
                    <span x-text="notif.pengirim_nama || notif.pengirim_nim"></span>
                    <div class="flex gap-1">
                        <button @click="respond(notif.id,'accepted')" class="px-2 py-1 bg-green-500 text-white rounded text-xs hover:bg-green-600">✔</button>
                        <button @click="respond(notif.id,'rejected')" class="px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600">✖</button>
                    </div>
                </div>
            </template>
            <p x-show="notifikasi.length === 0" class="text-xs text-gray-400">Tidak ada permintaan</p>
        </div>

    </div>
</aside>

<!-- ================= MODAL TAMBAH TEMAN ================= -->
<div id="tambahTemanModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl w-full max-w-sm">
        <h2 class="text-lg font-bold mb-4">Tambah Teman</h2>
        <form @submit.prevent="addFriend">
            <input type="text" x-model="nimTujuan" placeholder="NIM Teman" class="w-full border rounded-lg px-3 py-2 mb-4" required>
            <div class="flex justify-end gap-2">
                <button type="button" @click="document.getElementById('tambahTemanModal').classList.add('hidden')"
                        class="px-3 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">Batal</button>
                <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Kirim</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
function friendApp() {
    return {
        openSidebar: false,
        openFriend: false,
        temanList: [],
        notifikasi: @json($notifikasi ?? []),
        nimTujuan: '',

        init() {
            this.loadTeman(); // Fetch teman dari backend setiap load halaman
        },

        // Load teman dari server
        loadTeman() {
            axios.get('/mahasiswa/teman/list')
                .then(res => this.temanList = res.data)
                .catch(e => console.log('Gagal load teman', e));
        },

        // Terima/Tolak permintaan teman
        respond(id, action) {
            axios.post(`/mahasiswa/teman/respond/${id}/${action}`, {}, {
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            })
            .then(res => {
                this.notifikasi = this.notifikasi.filter(n => n.id !== id);
                if(action === 'accepted') {
                    this.loadTeman();
                }
            })
            .catch(e => Swal.fire('Error','Gagal memproses permintaan','error'));
        },

        // Tambah teman
        addFriend() {
            if(!this.nimTujuan) return Swal.fire('Peringatan','Masukkan NIM teman','warning');
            axios.post('/mahasiswa/teman/store', {nim_tujuan: this.nimTujuan}, {
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            })
            .then(res => {
                Swal.fire('Sukses','Permintaan teman dikirim','success');
                document.getElementById('tambahTemanModal').classList.add('hidden');
                this.nimTujuan = '';
                this.loadTeman(); // Refresh teman setelah menambah
            })
            .catch(e => {
                console.log(e.response);
                Swal.fire('Error','Gagal mengirim permintaan','error');
            });
        },

        // Hapus teman
        hapusTeman(nim) {
            Swal.fire({
                title: 'Hapus teman ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya'
            }).then(res => {
                if(res.isConfirmed){
                    axios.delete(`/mahasiswa/teman/${nim}`, {
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                    })
                    .then(r => {
                        this.loadTeman(); // Refresh teman setelah hapus
                        Swal.fire('Terhapus','Teman berhasil dihapus','success');
                    })
                    .catch(e => Swal.fire('Error','Gagal menghapus teman','error'));
                }
            });
        }
    }
}

// ================= LOGOUT =================
document.getElementById('logoutButton').addEventListener('click',function(){
    Swal.fire({
        title:'Logout?',
        icon:'warning',
        showCancelButton:true,
        confirmButtonText:'Ya'
    }).then(res=>{
        if(res.isConfirmed){
            document.getElementById('logoutForm').submit();
        }
    });
});
</script>

<!-- ================= STYLE ================= -->
<style>
.menu{
    @apply flex items-center px-3 py-2 rounded-xl text-gray-700 hover:bg-blue-50 transition;
}
.menu.active{
    @apply bg-blue-100 text-blue-700 font-semibold;
}
.menu span:first-child{
    width: 24px;
}
</style>

</body>
</html>
