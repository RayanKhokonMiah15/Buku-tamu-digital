```blade
{{-- Tampilkan notifikasi sukses kalau ada --}}
@if (session('success'))
    <div class="mb-4 bg-green-600 text-white px-4 py-3 rounded shadow">
        {{ session('success') }}
    </div>
@endif

{{-- Gunakan layout utama dari komponen Blade --}}
<x-app-layout>
    {{-- Slot judul halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Edit Laporan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Box utama dengan border dan padding --}}
            <div class="bg-[#1e1e1e] shadow-sm sm:rounded-lg p-6 text-gray-200 border border-[#333]">

                {{-- Tampilkan error validasi kalau ada --}}
                @if ($errors->any())
                    <div class="mb-4 bg-red-600 text-white p-4 rounded">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form edit laporan --}}
                <form action="{{ route('reports.update', $report) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="bg-[#262626] p-6 rounded-lg border border-[#333] mb-6">
                        {{-- Preview card --}}
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-400 mb-2">Preview Laporan</h4>
                            <div class="bg-[#1e1e1e] rounded-lg p-4">
                                <div class="flex items-center space-x-2 mb-2">
                                    <div class="h-8 w-8 bg-purple-600 rounded-full flex items-center justify-center">
                                        <span class="text-white text-sm">{{ substr(Auth::user()->username, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-300">{{ Auth::user()->username }}</p>
                                        <p class="text-xs text-gray-500">{{ $report->created_at->format('d M Y • H:i') }}</p>
                                    </div>
                                </div>
                                <h2 class="text-xl font-bold text-gray-100 mb-2" id="preview-title">{{ old('judul', $report->judul) }}</h2>
                                <p class="text-gray-300 mb-4" id="preview-content">{{ old('isi_laporan', $report->isi_laporan) }}</p>
                            </div>
                        </div>

                        {{-- Input judul --}}
                        <div class="mb-4">
                            <label class="block text-sm mb-1 text-gray-300" for="judul">Judul Laporan</label>
                            <input type="text" id="judul" name="judul"
                                   value="{{ old('judul', $report->judul) }}"
                                   class="w-full px-4 py-2 bg-[#1e1e1e] text-gray-100 rounded border border-[#444] focus:outline-none focus:ring-2 focus:ring-purple-500"
                                   oninput="document.getElementById('preview-title').textContent = this.value">
                            @error('judul')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input isi laporan --}}
                        <div class="mb-4">
                            <label class="block text-sm mb-1 text-gray-300" for="isi_laporan">Isi Laporan</label>
                            <textarea id="isi_laporan" name="isi_laporan"
                                      rows="5"
                                      class="w-full px-4 py-2 bg-[#1e1e1e] text-gray-100 rounded border border-[#444] focus:outline-none focus:ring-2 focus:ring-purple-500"
                                      oninput="document.getElementById('preview-content').textContent = this.value">{{ old('isi_laporan', $report->isi_laporan) }}</textarea>
                            @error('isi_laporan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Image upload --}}
                        <div class="mb-4">
                            <label class="block text-sm mb-1 text-gray-300">Bukti Foto (Opsional)</label>
                            <div class="flex items-center space-x-2">
                                <label class="flex items-center px-4 py-2 bg-[#333] text-gray-300 rounded-lg cursor-pointer hover:bg-[#444] transition duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Ganti Foto
                                    <input type="file" name="image" accept="image/*" class="hidden" onchange="showPreview(this)">
                                </label>
                            </div>
                            <div id="imagePreview" class="mt-4 {{ $report->image_path ? '' : 'hidden' }}">
                                <img src="{{ $report->image_path ? asset('storage/' . $report->image_path) : '#' }}"
                                     alt="Preview"
                                     class="max-h-48 rounded-lg">
                            </div>
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Checkbox pelaku tidak diketahui --}}
                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="unknown_perpetrator" id="unknown_perpetrator" value="1"
                                       class="form-checkbox bg-[#2a2a2a] text-purple-500 border-[#444]"
                                       {{ old('unknown_perpetrator', $report->nama_pelaku === 'Tidak Diketahui') ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-300">Pelaku tidak diketahui</span>
                            </label>
                        </div>

                        {{-- Field pelaku, disembunyikan kalau unknown_perpetrator dicentang --}}
                        <div id="perp-fields" class="mb-4">
                            <div class="mb-4">
                                <label class="block text-sm mb-1 text-gray-300" for="nama_pelaku">Nama Pelaku</label>
                                <input type="text" id="nama_pelaku" name="nama_pelaku"
                                       value="{{ old('nama_pelaku', $report->nama_pelaku === 'Tidak Diketahui' ? '' : $report->nama_pelaku) }}"
                                       class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                                @error('nama_pelaku')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm mb-1 text-gray-300" for="kelas_pelaku">Kelas Pelaku</label>
                                    <input type="text" id="kelas_pelaku" name="kelas_pelaku"
                                           value="{{ old('kelas_pelaku', $report->kelas_pelaku === 'Tidak Diketahui' ? '' : $report->kelas_pelaku) }}"
                                           class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                                    @error('kelas_pelaku')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm mb-1 text-gray-300" for="jurusan_pelaku">Jurusan Pelaku</label>
                                    <input type="text" id="jurusan_pelaku" name="jurusan_pelaku"
                                           value="{{ old('jurusan_pelaku', $report->jurusan_pelaku === 'Tidak Diketahui' ? '' : $report->jurusan_pelaku) }}"
                                           class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                                    @error('jurusan_pelaku')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Input peran --}}
                        <div class="mb-4">
                            <label class="block text-sm mb-1 text-gray-300" for="peran">Peran</label>
                            <select name="peran" id="peran"
                                    class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                                <option value="saksi" {{ old('peran', $report->peran) === 'saksi' ? 'selected' : '' }}>Saksi</option>
                                <option value="korban" {{ old('peran', $report->peran) === 'korban' ? 'selected' : '' }}>Korban</option>
                            </select>
                            @error('peran')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Checkbox laporan anonim --}}
                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1"
                                       class="form-checkbox bg-[#2a2a2a] text-purple-500 border-[#444]"
                                       {{ old('is_anonymous', $report->is_anonymous) ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-300">Laporkan secara anonim</span>
                            </label>
                        </div>

                        {{-- Info pelapor, disembunyikan kalau anonim dicentang --}}
                        <div id="reporter-info" class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm mb-1 text-gray-300" for="reporter_name">Nama Pelapor (opsional)</label>
                                <input type="text" id="reporter_name" name="reporter_name"
                                       value="{{ old('reporter_name', $report->reporter_name) }}"
                                       class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                                @error('reporter_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm mb-1 text-gray-300" for="reporter_class">Kelas Pelapor (opsional)</label>
                                <input type="text" id="reporter_class" name="reporter_class"
                                       value="{{ old('reporter_class', $report->reporter_class) }}"
                                       class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                                @error('reporter_class')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm mb-1 text-gray-300" for="reporter_major">Jurusan Pelapor (opsional)</label>
                                <input type="text" id="reporter_major" name="reporter_major"
                                       value="{{ old('reporter_major', $report->reporter_major) }}"
                                       class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                                @error('reporter_major')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Tombol submit --}}
                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                    class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2 rounded shadow">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script untuk hide/show field pelapor dan pelaku --}}
    <script>
        const anonymousCheckbox = document.getElementById('is_anonymous');
        const reporterInfo = document.getElementById('reporter-info');
        const unknownPerpCheckbox = document.getElementById('unknown_perpetrator');
        const perpFields = document.getElementById('perp-fields');

        function toggleReporterFields() {
            reporterInfo.style.display = anonymousCheckbox.checked ? 'none' : 'grid';
            if (anonymousCheckbox.checked) {
                reporterInfo.querySelectorAll('input').forEach(input => input.value = '');
            }
        }

        function togglePerpFields() {
            perpFields.style.display = unknownPerpCheckbox.checked ? 'none' : 'block';
            if (unknownPerpCheckbox.checked) {
                perpFields.querySelectorAll('input').forEach(input => input.value = 'Tidak Diketahui');
            }
        }

        anonymousCheckbox.addEventListener('change', toggleReporterFields);
        unknownPerpCheckbox.addEventListener('change', togglePerpFields);
        document.addEventListener('DOMContentLoaded', () => {
            toggleReporterFields();
            togglePerpFields();
        });

        function showPreview(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.querySelector('#imagePreview img');
                    img.src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
```
