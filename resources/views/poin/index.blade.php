@extends('layouts.app')

@section('styles')
<style>
/* Animasi perubahan poin */
.scale-up {
    transform: scale(1.2);
    transition: transform 0.3s ease;
}

/* Leaderboard animasi */
@keyframes fadeSlideIn {
    0% {opacity: 0; transform: translateY(10px);}
    100% {opacity: 1; transform: translateY(0);}
}
.animate-fade-in {
    animation: fadeSlideIn 0.4s ease forwards;
}

/* Tombol export */
.export-btn {
    background-color: #16a34a; /* Tailwind green-600 */
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem; /* rounded */
    font-weight: 600;
    transition: background-color 0.2s ease;
    position: relative;
}
.export-btn:hover {
    background-color: #15803d; /* Tailwind green-700 */
}

/* Spinner loading kecil */
#spinner {
    width: 1rem;
    height: 1rem;
    border: 2px solid white;
    border-top-color: transparent;
    border-radius: 9999px;
    animation: spin 1s linear infinite;
    position: absolute;
    right: 0.5rem;
    top: 50%;
    transform: translateY(-50%);
}

.hidden {
    display: none;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>
@endsection

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">📊 Daftar Poin Mahasiswa</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search dan Export --}}
    <form method="GET" action="{{ route('poin.index') }}" class="mb-4 flex gap-2 flex-wrap items-center">
        <input 
            type="text" name="search" value="{{ $search ?? '' }}"
            placeholder="Cari nama atau NIM..."
            class="border border-gray-300 px-4 py-2 rounded w-full md:w-64 focus:outline-none focus:ring focus:border-blue-400"
        >
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Cari
        </button>

        {{-- Tombol Export Excel --}}
        <a href="{{ route('poin.export') }}" 
           class="export-btn ml-auto whitespace-nowrap" 
           id="btn-export" 
           aria-label="Export data poin mahasiswa ke Excel" 
           onclick="showLoadingExport(event)">
            📥 Export Excel
            <span id="spinner" class="hidden"></span>
        </a>
    </form>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Tabel Poin -->
        <div class="lg:col-span-2 overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full text-sm border border-gray-200">
                <thead class="bg-gray-100 text-gray-600">
                    <tr class="text-left">
                        <th class="py-3 px-4 border-b">NIM</th>
                        <th class="py-3 px-4 border-b">Nama</th>
                        <th class="py-3 px-4 border-b">Poin</th>
                        <th class="py-3 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($poinMahasiswas as $item)
                        <tr class="border-b hover:bg-gray-50 transition-all">
                            <td class="py-2 px-4">{{ $item->nim }}</td>
                            <td class="py-2 px-4">{{ $item->nama }}</td>
                            <td class="py-2 px-4 font-semibold" id="poin-{{ $item->nim }}">{{ $item->poin }}</td>
                            <td class="py-2 px-4 flex space-x-2">
                                <a href="{{ route('poin.show', $item->id) }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">View</a>
                                <a href="{{ route('poin.edit', $item->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('poin.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-4 text-center text-gray-500">Belum ada data poin mahasiswa.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Leaderboard -->
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-xl font-bold mb-4">🏆 Leaderboard</h2>
            <ul id="leaderboard" class="space-y-4">
                @php $maxPoint = 1000; @endphp
                @foreach ($poinMahasiswas->sortByDesc('poin')->values() as $index => $item)
                    @php
                        $percent = min(100, ($item->poin / $maxPoint) * 100);
                        switch ($index) {
                            case 0: $badge = '🥇'; $barColor = 'bg-gradient-to-r from-yellow-400 to-yellow-300'; break;
                            case 1: $badge = '🥈'; $barColor = 'bg-gradient-to-r from-gray-400 to-gray-300'; break;
                            case 2: $badge = '🥉'; $barColor = 'bg-gradient-to-r from-yellow-700 to-yellow-600'; break;
                            default: $badge = $index + 1 . '.'; $barColor = 'bg-gradient-to-r from-indigo-500 to-indigo-400';
                        }
                    @endphp
                    <li class="bg-gray-50 p-3 rounded shadow-sm hover:bg-yellow-50 transition-all animate-fade-in" title="{{ number_format($percent, 1) }}%">
                        <div class="flex justify-between items-center mb-1">
                            <div class="flex items-center gap-3">
                                <span class="text-lg font-bold text-yellow-500">{{ $badge }}</span>
                                <span class="font-medium">{{ $item->nama }}</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-700" id="leader-poin-{{ $item->nim }}">{{ $item->poin }} pts</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden" aria-label="{{ number_format($percent, 1) }}%">
                            <div class="h-3 rounded-full transition-all duration-500 {{ $barColor }}" style="width: {{ $percent }}%"></div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function showLoadingExport(e) {
    // tampilkan spinner, disable klik button export
    e.preventDefault();
    const btn = $('#btn-export');
    const spinner = $('#spinner');
    btn.addClass('opacity-70 pointer-events-none');
    spinner.removeClass('hidden');

    // Buka link export setelah delay agar spinner muncul
    setTimeout(() => {
        window.location.href = btn.attr('href');
        btn.removeClass('opacity-70 pointer-events-none');
        spinner.addClass('hidden');
    }, 300);
}

function updateLeaderboard(data) {
    const maxPoint = 1000;
    const leaderboard = $('#leaderboard');

    // Sort data berdasarkan poin desc
    data.sort((a, b) => b.poin - a.poin);

    // Ambil semua elemen list yang ada
    const existingItems = leaderboard.children();

    data.forEach((item, index) => {
        const percent = Math.min(100, (item.poin / maxPoint) * 100);
        let badge = '', barColor = '';

        switch(index) {
            case 0: badge = '🥇'; barColor = 'bg-gradient-to-r from-yellow-400 to-yellow-300'; break;
            case 1: badge = '🥈'; barColor = 'bg-gradient-to-r from-gray-400 to-gray-300'; break;
            case 2: badge = '🥉'; barColor = 'bg-gradient-to-r from-yellow-700 to-yellow-600'; break;
            default: badge = (index + 1) + '.'; barColor = 'bg-gradient-to-r from-indigo-500 to-indigo-400';
        }

        // Cek apakah item sudah ada di leaderboard
        let li = existingItems.filter((_, el) => $(el).find('span#leader-poin-' + item.nim).length > 0);

        if (li.length === 0) {
            // Belum ada, tambahkan
            leaderboard.append(`
                <li class="bg-gray-50 p-3 rounded shadow-sm hover:bg-yellow-50 transition-all animate-fade-in" title="${percent.toFixed(1)}%">
                    <div class="flex justify-between items-center mb-1">
                        <div class="flex items-center gap-3">
                            <span class="text-lg font-bold text-yellow-500">${badge}</span>
                            <span class="font-medium">${escapeHtml(item.nama)}</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-700" id="leader-poin-${item.nim}">${item.poin} pts</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden" aria-label="${percent.toFixed(1)}%">
                        <div class="h-3 rounded-full transition-all duration-500 ${barColor}" style="width: ${percent}%"></div>
                    </div>
                </li>
            `);
        } else {
            // Ada, update isinya tanpa rebuild
            const badgeSpan = li.find('span.text-yellow-500');
            badgeSpan.text(badge);

            li.find('span.font-medium').text(item.nama);
            const leaderPoin = li.find(`#leader-poin-${item.nim}`);

            // Jika poin berubah, beri animasi
            if (parseInt(leaderPoin.text()) !== item.poin) {
                leaderPoin.text(item.poin + ' pts').addClass('text-red-600 font-bold scale-up');
                setTimeout(() => {
                    leaderPoin.removeClass('text-red-600 font-bold scale-up');
                }, 1000);
            }

            // Update bar color dan width
            const barDiv = li.find('div.h-3.rounded-full.transition-all');
            barDiv.attr('class', `h-3 rounded-full transition-all duration-500 ${barColor}`);
            barDiv.css('width', percent + '%');
        }
    });
}

function updatePoinTable(data) {
    data.forEach(item => {
        const poinCell = $('#poin-' + item.nim);
        if (poinCell.length) {
            let oldPoin = parseInt(poinCell.text());
            if (oldPoin !== item.poin) {
                poinCell.text(item.poin).addClass('text-red-600 font-bold scale-up');
                setTimeout(() => {
                    poinCell.removeClass('text-red-600 font-bold scale-up');
                }, 1000);
            }
        }
    });
}

function escapeHtml(text) {
    return text.replace(/[&<>"']/g, function(match) {
        const escape = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return escape[match];
    });
}

function updatePoinRealtime() {
    $.get("{{ url('/poin/latest/all') }}", function(data) {
        updatePoinTable(data);
        updateLeaderboard(data);
    });
}

updatePoinRealtime();
setInterval(updatePoinRealtime, 5000);
</script>
@endsection
