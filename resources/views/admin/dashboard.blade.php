@extends('admin.layout')
@section('title', 'Laporan Masuk')

@section('content')
    <h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white">📥 Laporan Masuk</h2>

    @if(session('success'))
        <div class="bg-green-600 text-white p-4 rounded-lg shadow mb-6">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="space-y-6">
        @forelse($reports as $report)
            <div class="bg-white dark:bg-[#1e1e1e] border border-gray-200 dark:border-gray-700 rounded-xl shadow-md hover:shadow-lg transition overflow-hidden">
                <div class="p-6">
                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-start space-x-4">
                            <div>
                                <span class="text-sm text-gray-500 dark:text-gray-400 block">{{ $report->created_at->format('d M Y • H:i') }}</span>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $report->judul }}</h3>
                            </div>
                        </div>
                        {{-- Dropdown Status --}}
                        <form action="{{ route('admin.reports.update', $report->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="rounded-lg px-3 py-1 text-sm font-semibold border-none focus:ring-2 focus:ring-offset-2 transition
                                    {{ $report->status == 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                    {{ $report->status == 'proses' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : '' }}
                                    {{ $report->status == 'selesai' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}">
                                <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                <option value="proses" {{ $report->status == 'proses' ? 'selected' : '' }}>🔄 Proses</option>
                                <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                            </select>
                        </form>
                    </div>

                    {{-- Isi Laporan --}}
                    <div class="prose dark:prose-invert max-w-none mb-4">
                        <p class="text-gray-700 dark:text-gray-300">{{ $report->isi_laporan }}</p>
                    </div>

                    {{-- Gambar --}}
                    @if($report->image_path)
                        <div class="my-4">
                            <img src="{{ asset('storage/' . $report->image_path) }}"
                                 alt="Bukti laporan"
                                 class="rounded-lg w-full max-h-96 object-cover border">
                        </div>
                    @endif

                    {{-- Informasi Pelaku --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                        <div class="bg-gray-100 dark:bg-[#2d2d2d] p-3 rounded-lg">
                            <span class="text-xs text-gray-500 dark:text-gray-400">👤 Nama Pelaku</span>
                            <div class="font-semibold">{{ $report->nama_pelaku }}</div>
                        </div>
                        <div class="bg-gray-100 dark:bg-[#2d2d2d] p-3 rounded-lg">
                            <span class="text-xs text-gray-500 dark:text-gray-400">🏫 Kelas</span>
                            <div class="font-semibold">{{ $report->kelas_pelaku }}</div>
                        </div>
                        <div class="bg-gray-100 dark:bg-[#2d2d2d] p-3 rounded-lg">
                            <span class="text-xs text-gray-500 dark:text-gray-400">🧪 Jurusan</span>
                            <div class="font-semibold">{{ $report->jurusan_pelaku }}</div>
                        </div>
                        <div class="bg-gray-100 dark:bg-[#2d2d2d] p-3 rounded-lg">
                            <span class="text-xs text-gray-500 dark:text-gray-400">🎭 Peran Pelapor</span>
                            <div class="font-semibold">{{ ucfirst($report->peran) }}</div>
                        </div>
                    </div>

                    {{-- Identitas Pelapor --}}
                    <div class="mt-6 p-4 bg-gray-50 dark:bg-[#262626] rounded-lg border dark:border-gray-700">
                        @if(isset($report->is_anonymous) && $report->is_anonymous == 0)
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">🕵️ Identitas Pelapor</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 block">Nama</span>
                                    <span class="font-medium">{{ $report->reporter_name }}</span>
                                </div>
                                <div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 block">Kelas</span>
                                    <span class="font-medium">{{ $report->reporter_class }}</span>
                                </div>
                                <div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 block">Jurusan</span>
                                    <span class="font-medium">{{ $report->reporter_major }}</span>
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-gray-500 dark:text-gray-400">🔒 Laporan Anonim</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            {{-- Tidak ada laporan --}}
            <div class="text-center py-12">
                <svg class="mx-auto h-14 w-14 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <h3 class="mt-3 text-lg font-semibold text-gray-700 dark:text-white">Belum ada laporan</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Semua masih aman. Tidak ada laporan masuk.</p>
            </div>
        @endforelse
    </div>
@endsection
