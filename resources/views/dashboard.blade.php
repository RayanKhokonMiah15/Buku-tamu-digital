
{{-- nah ini buat dashboard user --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Kotak login info --}}
            <div class="bg-white dark:bg-[#1e1e1e] overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-300">
                    You're logged in as <strong>{{ Auth::user()->username }}</strong>
                </div>
            </div>

            {{-- Notifikasi sukses --}}
            @if(session('success'))
            <div class="bg-green-600 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            {{-- Form buat laporan --}}
            <div class="bg-white dark:bg-[#1e1e1e] overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-300">
                    <h3 class="text-lg font-semibold mb-4">Buat Laporan Whistleblowing</h3>

                    <form method="POST" action="{{ route('reports.store') }}">
                        @csrf

                        @php
                            $inputStyle = 'w-full rounded px-3 py-2 bg-white dark:bg-[#262626] text-gray-900 dark:text-gray-300 border border-gray-300 dark:border-[#3a3a3a] focus:outline-none focus:ring-2 focus:ring-blue-500';
                        @endphp

                        <div class="mb-4">
                            <label for="judul" class="block font-medium">Judul Laporan</label>
                            <input type="text" name="judul" id="judul" class="{{ $inputStyle }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="isi_laporan" class="block font-medium">Isi Laporan</label>
                            <textarea name="isi_laporan" id="isi_laporan" rows="4" class="{{ $inputStyle }}" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="nama_pelaku" class="block font-medium">Nama Pelaku</label>
                            <input type="text" name="nama_pelaku" id="nama_pelaku" class="{{ $inputStyle }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="kelas_pelaku" class="block font-medium">Kelas Pelaku</label>
                            <input type="text" name="kelas_pelaku" id="kelas_pelaku" class="{{ $inputStyle }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="jurusan_pelaku" class="block font-medium">Jurusan Pelaku</label>
                            <input type="text" name="jurusan_pelaku" id="jurusan_pelaku" class="{{ $inputStyle }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium">Status Pelapor</label>
                            <select name="peran" class="{{ $inputStyle }}" required>
                                <option value="saksi">Saksi</option>
                                <option value="korban">Korban</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium">Ingin menyantumkan identitas?</label>
                            <select name="is_anonymous" id="is_anonymous" class="{{ $inputStyle }}" required onchange="toggleIdentityFields()">
                                <option value="1">Tidak, saya ingin anonim</option>
                                <option value="0">Ya, saya bersedia diselidiki</option>
                            </select>
                        </div>

                        <div id="identityFields" class="hidden">
                            <div class="mb-4">
                                <label for="reporter_name" class="block font-medium">Nama Pelapor</label>
                                <input type="text" name="reporter_name" id="reporter_name" class="{{ $inputStyle }}">
                            </div>

                            <div class="mb-4">
                                <label for="reporter_class" class="block font-medium">Kelas Pelapor</label>
                                <input type="text" name="reporter_class" id="reporter_class" class="{{ $inputStyle }}">
                            </div>

                            <div class="mb-4">
                                <label for="reporter_major" class="block font-medium">Jurusan Pelapor</label>
                                <input type="text" name="reporter_major" id="reporter_major" class="{{ $inputStyle }}">
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                Kirim Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Daftar laporan --}}
            <div class="bg-white dark:bg-[#1e1e1e] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-300 overflow-x-auto">
                    <h3 class="text-lg font-semibold mb-4">Laporan Kamu</h3>

                    <table class="min-w-full text-sm text-left text-gray-900 dark:text-gray-300 border border-gray-300 dark:border-[#3a3a3a]">
                        <thead class="bg-gray-100 dark:bg-[#262626] text-xs uppercase font-medium text-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Judul</th>
                                <th scope="col" class="px-6 py-3">Isi</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-[#181818]">
                            @forelse(Auth::user()->reports as $report)
                                <tr class="border-b border-gray-300 dark:border-[#3a3a3a]">
                                    <td class="px-6 py-4 font-medium">{{ $report->judul }}</td>
                                    <td class="px-6 py-4 max-w-xs truncate">{{ $report->isi_laporan }}</td>
                                    <td class="px-6 py-4">{{ $report->status ?? '-' }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('reports.edit', $report) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
                                        <form action="{{ route('reports.destroy', $report) }}" method="POST" onsubmit="return confirm('Yakin mau hapus laporan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-500">Belum ada laporan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- Script untuk toggle identitas --}}
    <script>
        function toggleIdentityFields() {
            const isAnon = document.getElementById('is_anonymous').value;
            const fields = document.getElementById('identityFields');
            if (isAnon == '0') {
                fields.classList.remove('hidden');
            } else {
                fields.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>

