@extends('layouts.dashboard_organisasi')

@section('title', 'Tambah Anggota Organisasi')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-green-600 mb-6">
        ➕ Tambah Anggota: {{ $organisasi->nama_organisasi }}
    </h2>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="py-3 px-4">NIM</th>
                    <th class="py-3 px-4">Nama</th>
                    <th class="py-3 px-4">Jabatan</th>
                    <th class="py-3 px-4">Status Keanggotaan</th>
                    <th class="py-3 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswa as $m)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $m->nim }}</td>
                    <td class="py-2 px-4">{{ $m->nama }}</td>
                    <td class="py-2 px-4" colspan="2">
                        <form action="{{ route('organisasi.self.store_anggota', $organisasi->id_organisasi) }}" method="POST" class="flex flex-col md:flex-row items-start md:items-center space-y-2 md:space-y-0 md:space-x-2">
                            @csrf
                            <input type="hidden" name="mahasiswa_nim" value="{{ $m->nim }}">

                            {{-- Jabatan --}}
                            <div class="relative w-full md:w-auto">
                                <select name="jabatan" class="border border-gray-300 rounded px-2 py-1 jabatan-select w-full">
                                    <option value="Ketua">Ketua</option>
                                    <option value="Wakil">Wakil</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Bendahara">Bendahara</option>
                                    <option value="Divisi Akademik">Divisi Akademik</option>
                                    <option value="Divisi Acara">Divisi Acara</option>
                                    <option value="Divisi Olahraga">Divisi Olahraga</option>
                                    <option value="Divisi Multimedia">Divisi Multimedia</option>
                                    <option value="Divisi Logistik">Divisi Logistik</option>
                                    <option value="Divisi Humas">Divisi Humas</option>
                                    <option value="Divisi Kerohanian">Divisi Kerohanian</option>
                                    <option value="lainnya">Lainnya...</option>
                                </select>
                                <input type="text" name="jabatan_lainnya" placeholder="Isi jabatan..." class="border border-gray-300 rounded px-2 py-1 mt-1 hidden jabatan-lainnya-input w-full">
                            </div>

                            {{-- Status --}}
                            <div class="relative w-full md:w-auto">
                                <select name="status_keanggotaan" class="border border-gray-300 rounded px-2 py-1 status-select w-full">
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Tidak Aktif</option>
                                    <option value="lainnya">Lainnya...</option>
                                </select>
                                <input type="text" name="status_lainnya" placeholder="Isi status..." class="border border-gray-300 rounded px-2 py-1 mt-1 hidden status-lainnya-input w-full">
                            </div>

                            <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition duration-200">
                                Tambah
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">Semua mahasiswa sudah menjadi anggota.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('organisasi.self.show', $organisasi->id_organisasi) }}"
       class="mt-6 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200">
       ← Kembali ke Detail Organisasi
    </a>
</div>

{{-- Script untuk memunculkan input ketika "Lainnya" dipilih dan mengirim nilainya --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Tampilkan input saat "Lainnya" dipilih
    document.querySelectorAll('.jabatan-select').forEach(select => {
        select.addEventListener('change', () => {
            const input = select.nextElementSibling;
            if (select.value === 'lainnya') {
                input.classList.remove('hidden');
            } else {
                input.classList.add('hidden');
                input.value = '';
            }
        });
    });

    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', () => {
            const input = select.nextElementSibling;
            if (select.value === 'lainnya') {
                input.classList.remove('hidden');
            } else {
                input.classList.add('hidden');
                input.value = '';
            }
        });
    });

    // Saat submit, ganti name select ke input jika "Lainnya"
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', (e) => {
            const jabatanSelect = form.querySelector('.jabatan-select');
            const jabatanInput = form.querySelector('.jabatan-lainnya-input');

            if (jabatanSelect.value === 'lainnya') {
                if (!jabatanInput.value.trim()) {
                    e.preventDefault();
                    alert('Isi jabatan terlebih dahulu!');
                    return;
                }
                jabatanInput.name = 'jabatan';
                jabatanSelect.removeAttribute('name');
            }

            const statusSelect = form.querySelector('.status-select');
            const statusInput = form.querySelector('.status-lainnya-input');

            if (statusSelect.value === 'lainnya') {
                if (!statusInput.value.trim()) {
                    e.preventDefault();
                    alert('Isi status terlebih dahulu!');
                    return;
                }
                statusInput.name = 'status_keanggotaan';
                statusSelect.removeAttribute('name');
            }
        });
    });
});
</script>
@endsection
