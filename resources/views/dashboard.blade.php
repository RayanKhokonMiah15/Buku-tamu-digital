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

                    <form method="POST" action="{{ route('reports.store') }}" enctype="multipart/form-data">
                        @csrf

                        @php
                            $inputStyle = 'w-full rounded px-3 py-2 bg-white dark:bg-[#262626] text-gray-900 dark:text-gray-300 border border-gray-300 dark:border-[#3a3a3a] focus:outline-none focus:ring-2 focus:ring-blue-500';
                        @endphp

                        <div class="mb-4">
                            <label for="judul" class="block font-medium mb-1">Judul Laporan</label>
                            <input type="text" name="judul" id="judul"
                                   class="{{ $inputStyle }}"
                                   placeholder="Masukkan judul laporan yang jelas dan spesifik"
                                   required>
                        </div>
<div class="mb-4">
    <label for="image" class="block font-medium mb-1">Bukti Foto (Opsional)</label>
    <div class="flex items-center space-x-2">
        <label
            class="flex items-center px-4 py-2 bg-gray-100 dark:bg-[#262626] text-gray-600 dark:text-gray-400 rounded-lg cursor-pointer hover:bg-gray-200 dark:hover:bg-[#363636] transition duration-200"
            for="image">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Pilih Foto
        </label>
        <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="showPreview(this)">

        <div id="imagePreview" class="hidden">
            <div class="relative group max-w-2xl mx-auto">
                <div class="bg-gray-50 dark:bg-[#262626] rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                    <img src="#" alt="Preview" class="max-h-[500px] w-full object-contain rounded-lg">
                    <button type="button" onclick="removeImage()"
                        class="absolute top-2 right-2 p-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors duration-200"
                        aria-label="Hapus gambar">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        *Ukuran maksimal 5MB, format yang didukung: JPG, PNG, GIF
                    </p>
                </div>
            </div>
        </div>
    </div>

                        </div>

                        <div class="mb-4">
                            <label for="isi_laporan" class="block font-medium">Isi Laporan</label>
                            <textarea name="isi_laporan" id="isi_laporan" rows="4" class="{{ $inputStyle }}" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="inline-flex items-center mb-2">
                                <input type="checkbox" name="unknown_perpetrator" id="unknown_perpetrator" value="1" onchange="togglePerpFields()" class="form-checkbox">
                                <span class="ml-2">Tidak mengetahui pelaku</span>
                            </label>

                            <div id="perp-fields">
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
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="peran" class="block font-medium">Peran</label>
                            <select name="peran" id="peran" class="{{ $inputStyle }}" required>
                                <option value="saksi">Saksi</option>
                                <option value="korban">Korban</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1" onchange="toggleIdentityFields()" class="form-checkbox">
                                <span class="ml-2">Laporkan secara anonim</span>
                            </label>
                        </div>

                        <div id="reporter-identity" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
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
                <div class="p-6 text-gray-900 dark:text-gray-300">
                    <h3 class="text-lg font-semibold mb-4">Laporan Kamu</h3>

                    <div class="space-y-4">
                        @forelse(Auth::user()->reports as $report)
                            <div class="bg-gray-50 dark:bg-[#262626] rounded-lg p-4 hover:shadow-lg transition duration-300">
                                <div class="flex flex-col space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <div class="h-8 w-8 bg-blue-600 dark:bg-blue-500 rounded-full flex items-center justify-center">
                                                <span class="text-white text-sm">{{ substr(Auth::user()->username, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $report->created_at->format('d M Y • H:i') }}
                                                </span>
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $report->judul }}</h3>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="px-2 py-1 text-xs rounded {{
                                                $report->status === 'pending' ? 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200' :
                                                ($report->status === 'proses' ? 'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200' :
                                                'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200')
                                            }}">
                                                {{ ucfirst($report->status) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="prose dark:prose-invert max-w-none">
                                        <p class="text-gray-600 dark:text-gray-400">{{ $report->isi_laporan }}</p>
                                    </div>

                                    @if($report->image_path)
                                        <div class="mt-4">
                                            <div class="relative group cursor-pointer">                                <div class="relative h-[500px] rounded-xl overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700">
                                    <img src="{{ asset('storage/' . $report->image_path) }}"
                                         alt="Bukti laporan"
                                         class="absolute inset-0 w-full h-full object-contain hover:scale-[1.02] transition-transform duration-500"
                                         style="object-position: center;"
                                         onclick="openImageViewer(this.src)"
                                         loading="lazy"
                                         onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%23999999\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'%3E%3Cline x1=\'18\' y1=\'6\' x2=\'6\' y2=\'18\'%3E%3C/line%3E%3Cline x1=\'6\' y1=\'6\' x2=\'18\' y2=\'18\'%3E%3C/line%3E%3C/svg%3E'; this.classList.add('p-8');">
                                                </div>
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl flex items-center justify-center">
                                                    <span class="text-white text-sm font-medium tracking-wide flex items-center">
                                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                                        </svg>
                                                        Klik untuk memperbesar
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                        <div class="bg-gray-100 dark:bg-[#1e1e1e] p-3 rounded-lg">
                                            <span class="text-sm text-gray-500 dark:text-gray-400 block">Nama Pelaku</span>
                                            <span class="font-medium">{{ $report->nama_pelaku }}</span>
                                        </div>
                                        <div class="bg-gray-100 dark:bg-[#1e1e1e] p-3 rounded-lg">
                                            <span class="text-sm text-gray-500 dark:text-gray-400 block">Kelas</span>
                                            <span class="font-medium">{{ $report->kelas_pelaku }}</span>
                                        </div>
                                        <div class="bg-gray-100 dark:bg-[#1e1e1e] p-3 rounded-lg">
                                            <span class="text-sm text-gray-500 dark:text-gray-400 block">Jurusan</span>
                                            <span class="font-medium">{{ $report->jurusan_pelaku }}</span>
                                        </div>
                                        <div class="bg-gray-100 dark:bg-[#1e1e1e] p-3 rounded-lg">
                                            <span class="text-sm text-gray-500 dark:text-gray-400 block">Peran</span>
                                            <span class="font-medium">{{ ucfirst($report->peran) }}</span>
                                        </div>
                                    </div>

                                    @if(!$report->is_anonymous)
                                        <div class="mt-4 p-4 bg-gray-100 dark:bg-[#1e1e1e] rounded-lg">
                                            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">Identitas Pelapor</h4>
                                            <div class="grid grid-cols-3 gap-4">
                                                <div>
                                                    <span class="text-sm text-gray-500 dark:text-gray-400 block">Nama</span>
                                                    <span class="font-medium">{{ $report->reporter_name }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-sm text-gray-500 dark:text-gray-400 block">Kelas</span>
                                                    <span class="font-medium">{{ $report->reporter_class }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-sm text-gray-500 dark:text-gray-400 block">Jurusan</span>
                                                    <span class="font-medium">{{ $report->reporter_major }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="mt-4 p-4 bg-gray-100 dark:bg-[#1e1e1e] rounded-lg">
                                            <p class="text-sm text-gray-500 dark:text-gray-400">🔒 Laporan Anonim</p>
                                        </div>
                                    @endif

                                    <div class="flex items-center space-x-4 mt-4">
                                        <a href="{{ route('reports.edit', $report) }}"
                                           class="text-yellow-500 hover:text-yellow-600 dark:text-yellow-400 dark:hover:text-yellow-300 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('reports.destroy', $report) }}"
                                              method="POST"
                                              class="inline-block"
                                              onsubmit="return confirm('Yakin mau hapus laporan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-500 hover:text-red-600 dark:text-red-400 dark:hover:text-red-300 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                Belum ada laporan
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Script untuk toggle identitas --}}
    <script>
        function toggleIdentityFields() {
            const checkbox = document.getElementById('is_anonymous');
            const reporterIdentity = document.getElementById('reporter-identity');
            reporterIdentity.style.display = checkbox.checked ? 'none' : 'grid';
        }

        function togglePerpFields() {
            const checkbox = document.getElementById('unknown_perpetrator');
            const perpFields = document.getElementById('perp-fields');
            const inputs = perpFields.querySelectorAll('input[type="text"]');

            perpFields.style.display = checkbox.checked ? 'none' : 'block';

            inputs.forEach(input => {
                if(checkbox.checked) {
                    input.value = 'Tidak Diketahui';
                    input.setAttribute('readonly', true);
                } else {
                    input.value = '';
                    input.removeAttribute('readonly');
                }
            });
        }

        function showPreview(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const maxSize = 5 * 1024 * 1024; // 5MB
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];

                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    input.value = '';
                    return;
                }

                if (!validTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.querySelector('#imagePreview img');
                    img.src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');

                    // Check image dimensions after loading
                    img.onload = function() {
                        if (this.naturalWidth < 100 || this.naturalHeight < 100) {
                            alert('Resolusi gambar terlalu kecil. Minimal 100x100 piksel.');
                            input.value = '';
                            document.getElementById('imagePreview').classList.add('hidden');
                        }
                    };
                }
                reader.readAsDataURL(file);
            }
        }

        function removeImage() {
            document.getElementById('image').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
        }

        function openImageViewer(src) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4';
            modal.innerHTML = `
                <div class="relative w-full h-full flex items-center justify-center p-4">
                    <button class="fixed top-4 right-4 z-50 p-2 text-white hover:text-gray-300 transition-colors duration-200 bg-black/50 rounded-full" onclick="this.parentElement.parentElement.remove()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <div class="w-full h-full relative overflow-auto flex items-center justify-center">
                        <img src="${src}"
                            class="max-w-[95vw] max-h-[95vh] w-auto h-auto object-contain"
                            style="transform-origin: center; transition: transform 0.3s ease;"
                            alt="Full size image">
                    </div>
                </div>
            `;
            document.body.appendChild(modal);

            const img = modal.querySelector('img');
            let scale = 1;

            // Handle zoom with mouse wheel
            modal.addEventListener('wheel', (e) => {
                e.preventDefault();
                const delta = e.deltaY;
                if (delta < 0) {
                    // Zoom in
                    scale = Math.min(scale + 0.1, 3);
                } else {
                    // Zoom out
                    scale = Math.max(scale - 0.1, 0.5);
                }
                img.style.transform = `scale(${scale})`;
            });

            // Close on background click
            modal.addEventListener('click', (e) => {
                if (e.target === modal) modal.remove();
            });
        }
    </script>
</x-app-layout>

