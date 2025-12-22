@extends('layouts.dashboard_organisasi')

@section('title', 'Edit Anggota Organisasi')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-green-600 mb-6">
        ✏️ Edit Anggota: {{ $anggota->nama }} ({{ $anggota->nim }})
    </h2>

    <form action="{{ route('organisasi.self.update_anggota', [$id_organisasi, $anggota->nim]) }}" method="POST" class="space-y-5 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
        @csrf

        <!-- NIM -->
        <div>
            <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">NIM</label>
            <input type="text" value="{{ $anggota->nim }}" disabled class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
        </div>

        <!-- Nama -->
        <div>
            <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Nama</label>
            <input type="text" value="{{ $anggota->nama }}" disabled class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
        </div>

        <!-- Jabatan / Divisi -->
        <div>
            <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Jabatan / Divisi</label>
            <div class="relative">
                @php
                    $roles = ['Ketua','Wakil Ketua','Sekretaris','Bendahara','Anggota',
                              'Divisi Akademik','Divisi Acara','Divisi Olahraga','Divisi Multimedia',
                              'Divisi Humas','Divisi Logistik'];
                    $jabatan_lama = old('jabatan', $anggota->jabatan);
                @endphp
                <select name="jabatan" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 jabatan-select">
                    @foreach($roles as $role)
                        <option value="{{ $role }}" {{ $jabatan_lama === $role ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                    <option value="lainnya" {{ !in_array($jabatan_lama, $roles) ? 'selected' : '' }}>Lainnya...</option>
                </select>
                <input type="text" name="jabatan_lainnya" placeholder="Isi jabatan/divisi..." value="{{ !in_array($jabatan_lama, $roles) ? $jabatan_lama : '' }}" class="border border-gray-300 rounded px-2 py-1 mt-1 hidden jabatan-lainnya-input w-full dark:bg-gray-700 dark:text-gray-200">
            </div>
        </div>

        <!-- Status Keanggotaan -->
        <div>
            <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Status Keanggotaan</label>
            <div class="relative">
                @php
                    $statuses = ['aktif','nonaktif'];
                    $status_lama = old('status_keanggotaan', $anggota->status_keanggotaan);
                @endphp
                <select name="status_keanggotaan" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 status-select">
                    @foreach($statuses as $s)
                        <option value="{{ $s }}" {{ $status_lama === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                    <option value="lainnya" {{ !in_array($status_lama, $statuses) ? 'selected' : '' }}>Lainnya...</option>
                </select>
                <input type="text" name="status_lainnya" placeholder="Isi status..." value="{{ !in_array($status_lama, $statuses) ? $status_lama : '' }}" class="border border-gray-300 rounded px-2 py-1 mt-1 hidden status-lainnya-input w-full dark:bg-gray-700 dark:text-gray-200">
            </div>
        </div>

        <!-- Tombol -->
        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                💾 Simpan Perubahan
            </button>
            <a href="{{ route('organisasi.self.show', $id_organisasi) }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                ← Kembali
            </a>
        </div>
    </form>
</div>

{{-- Script untuk memunculkan input ketika "Lainnya" dipilih --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Jabatan
    const jabatanSelect = document.querySelector('.jabatan-select');
    const jabatanInput = document.querySelector('.jabatan-lainnya-input');

    const toggleJabatanInput = () => {
        if(jabatanSelect.value === 'lainnya') {
            jabatanInput.classList.remove('hidden');
        } else {
            jabatanInput.classList.add('hidden');
            jabatanInput.value = '';
        }
    }
    toggleJabatanInput();
    jabatanSelect.addEventListener('change', toggleJabatanInput);

    // Status
    const statusSelect = document.querySelector('.status-select');
    const statusInput = document.querySelector('.status-lainnya-input');

    const toggleStatusInput = () => {
        if(statusSelect.value === 'lainnya') {
            statusInput.classList.remove('hidden');
        } else {
            statusInput.classList.add('hidden');
            statusInput.value = '';
        }
    }
    toggleStatusInput();
    statusSelect.addEventListener('change', toggleStatusInput);

    // Saat submit, ganti name select ke input jika "Lainnya"
    document.querySelector('form').addEventListener('submit', (e) => {
        if(jabatanSelect.value === 'lainnya') {
            if(!jabatanInput.value.trim()) {
                e.preventDefault();
                alert('Isi jabatan/divisi terlebih dahulu!');
                return;
            }
            jabatanInput.name = 'jabatan';
            jabatanSelect.removeAttribute('name');
        }
        if(statusSelect.value === 'lainnya') {
            if(!statusInput.value.trim()) {
                e.preventDefault();
                alert('Isi status terlebih dahulu!');
                return;
            }
            statusInput.name = 'status_keanggotaan';
            statusSelect.removeAttribute('name');
        }
    });
});
</script>
@endsection
