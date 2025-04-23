<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Navi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Kotak sambutan --}}
            <div class="bg-[#1e1e1e] overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Di System Whistleblowing SMKN 1 GARUT</h3>
                <p class="text-gray-300">
                    jika kamu mendapati perlakuan tidak pantas dari siapapun itu di lingkungan sekolah, kami bisa bantu!
                </p>
                <a href="{{ route('reports.create') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Buat Laporan
                </a>
            </div>

            {{-- Penjelasan whistleblowing --}}
            <div class="bg-[#1e1e1e] overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Apa itu Whistleblowing?</h3>
                <p class="text-gray-300">
                    Pelapor pelanggan (bahasa Inggris: whistleblower) adalah istilah bagi orang yang melaporkan tindakan yang dianggap melanggar ketentuan kepada pihak yang berwenang.
                </p>
            </div>

            {{-- Daftar laporan --}}
            <div class="bg-[#1e1e1e] overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Laporan Kamu</h3>

                <table class="min-w-full text-sm text-left text-gray-300 border border-gray-600">
                    <thead class="bg-[#262626] text-xs uppercase font-medium">
                        <tr>
                            <th scope="col" class="px-6 py-3">Judul</th>
                            <th scope="col" class="px-6 py-3">Isi</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#181818]">
                        @forelse(Auth::user()->reports as $report)
                            <tr class="border-b border-gray-600">
                                <td class="px-6 py-4 font-medium text-white">{{ $report->judul }}</td>
                                <td class="px-6 py-4 max-w-xs truncate text-gray-300">{{ $report->isi_laporan }}</td>
                                <td class="px-6 py-4 text-gray-300">{{ $report->status ?? '-' }}</td>
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
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada laporan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
