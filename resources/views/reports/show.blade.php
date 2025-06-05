{{-- Gunakan layout utama dari komponen Blade --}}
<x-app-layout>
    {{-- Slot judul halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
            Detail Laporan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Container utama --}}
            <div class="bg-white dark:bg-[#1e1e1e] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    {{-- Header Laporan --}}
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-12 w-12 bg-blue-600 dark:bg-blue-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-lg">{{ substr(Auth::user()->username, 0, 1) }}</span>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $report->judul }}</h3>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    Dilaporkan pada {{ $report->created_at->format('d M Y • H:i') }}
                                </span>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-sm rounded-full {{
                            $report->status === 'pending' ? 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200' :
                            ($report->status === 'proses' ? 'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200' :
                            'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200')
                        }}">
                            {{ ucfirst($report->status) }}
                        </span>
                    </div>

                    {{-- Konten Laporan --}}
                    <div class="prose dark:prose-invert max-w-none mb-8">
                        <p class="text-gray-600 dark:text-gray-300">{{ $report->isi_laporan }}</p>
                    </div>

                    {{-- Bukti Gambar --}}
                    @if($report->image_path)
                        <div class="mb-8">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Bukti Foto</h4>
                            <div class="relative group cursor-pointer">
                                <div class="relative h-[500px] rounded-xl overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700">
                                    <img src="{{ asset('storage/' . $report->image_path) }}"
                                         alt="Bukti laporan"
                                         class="absolute inset-0 w-full h-full object-contain"
                                         onclick="openImageViewer(this.src)"
                                         loading="lazy">
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Informasi Detail --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-gray-100 dark:bg-[#262626] p-4 rounded-lg">
                            <span class="text-sm text-gray-500 dark:text-gray-400 block">Nama Pelaku</span>
                            <span class="font-medium text-gray-900 dark:text-gray-100">{{ $report->nama_pelaku }}</span>
                        </div>
                        <div class="bg-gray-100 dark:bg-[#262626] p-4 rounded-lg">
                            <span class="text-sm text-gray-500 dark:text-gray-400 block">Kelas</span>
                            <span class="font-medium text-gray-900 dark:text-gray-100">{{ $report->kelas_pelaku }}</span>
                        </div>
                        <div class="bg-gray-100 dark:bg-[#262626] p-4 rounded-lg">
                            <span class="text-sm text-gray-500 dark:text-gray-400 block">Jurusan</span>
                            <span class="font-medium text-gray-900 dark:text-gray-100">{{ $report->jurusan_pelaku }}</span>
                        </div>
                        <div class="bg-gray-100 dark:bg-[#262626] p-4 rounded-lg">
                            <span class="text-sm text-gray-500 dark:text-gray-400 block">Peran</span>
                            <span class="font-medium text-gray-900 dark:text-gray-100">{{ ucfirst($report->peran) }}</span>
                        </div>
                    </div>

                    {{-- Status dan Penanganan --}}
                    @if($report->handlingGuru)
                        <div class="bg-gray-100 dark:bg-[#262626] rounded-lg p-4 mb-8">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Status Penanganan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <span class="text-sm text-gray-500 dark:text-gray-400 block">Ditangani Oleh</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $report->handlingGuru->username }}</span>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500 dark:text-gray-400 block">Status Terakhir</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ ucfirst($report->status) }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Informasi Pelapor --}}
                    @if(!$report->is_anonymous)
                        <div class="bg-gray-100 dark:bg-[#262626] rounded-lg p-4">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Identitas Pelapor</h4>
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <span class="text-sm text-gray-500 dark:text-gray-400 block">Nama</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $report->reporter_name }}</span>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500 dark:text-gray-400 block">Kelas</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $report->reporter_class }}</span>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500 dark:text-gray-400 block">Jurusan</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $report->reporter_major }}</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-100 dark:bg-[#262626] rounded-lg p-4">
                            <p class="text-gray-500 dark:text-gray-400">🔒 Laporan Anonim</p>
                        </div>
                    @endif

                    {{-- Actions --}}
                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('reports.edit', $report) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                            Edit Laporan
                        </a>
                        <form action="{{ route('reports.destroy', $report) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('Yakin mau hapus laporan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                Hapus Laporan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
