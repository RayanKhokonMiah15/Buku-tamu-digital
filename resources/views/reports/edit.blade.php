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
                <form action="{{ route('reports.update', $report) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Pakai method PUT untuk update data --}}

                    {{-- Input judul --}}
                    <div class="mb-4">
                        <label class="block text-sm mb-1" for="judul">Judul</label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul', $report->judul) }}"
                            class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444] focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    {{-- Input isi laporan --}}
                    <div class="mb-4">
                        <label class="block text-sm mb-1" for="isi_laporan">Isi Laporan</label>
                        <textarea id="isi_laporan" name="isi_laporan" rows="5"
                            class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444] focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('isi_laporan', $report->isi_laporan) }}</textarea>
                    </div>

                    {{-- Input nama pelaku --}}
                    <div class="mb-4">
                        <label class="block text-sm mb-1" for="nama_pelaku">Nama Pelaku</label>
                        <input type="text" id="nama_pelaku" name="nama_pelaku" value="{{ old('nama_pelaku', $report->nama_pelaku) }}"
                            class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                    </div>

                    {{-- Input kelas, jurusan, dan peran pelaku --}}
                    <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm mb-1" for="kelas_pelaku">Kelas Pelaku</label>
                            <input type="text" id="kelas_pelaku" name="kelas_pelaku" value="{{ old('kelas_pelaku', $report->kelas_pelaku) }}"
                                class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                        </div>
                        <div>
                            <label class="block text-sm mb-1" for="jurusan_pelaku">Jurusan Pelaku</label>
                            <input type="text" id="jurusan_pelaku" name="jurusan_pelaku" value="{{ old('jurusan_pelaku', $report->jurusan_pelaku) }}"
                                class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                        </div>
                        <div>
                            <label class="block text-sm mb-1" for="peran">Peran</label>
                            <select name="peran" id="peran"
                                class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                                <option value="saksi" {{ old('peran', $report->peran) === 'saksi' ? 'selected' : '' }}>Saksi</option>
                                <option value="korban" {{ old('peran', $report->peran) === 'korban' ? 'selected' : '' }}>Korban</option>
                            </select>
                        </div>
                    </div>

                    {{-- Checkbox laporan anonim --}}
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1"
                                class="form-checkbox bg-[#2a2a2a] text-purple-500 border-[#444]"
                                {{ old('is_anonymous', $report->is_anonymous) ? 'checked' : '' }}>
                            <span class="ml-2">Laporkan secara anonim</span>
                        </label>
                    </div>

                    {{-- Info pelapor, disembunyikan kalau anonim --}}
                    <div id="reporter-info" class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm mb-1" for="reporter_name">Nama Pelapor (opsional)</label>
                            <input type="text" id="reporter_name" name="reporter_name" value="{{ old('reporter_name', $report->reporter_name) }}"
                                class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                        </div>
                        <div>
                            <label class="block text-sm mb-1" for="reporter_class">Kelas Pelapor (opsional)</label>
                            <input type="text" id="reporter_class" name="reporter_class" value="{{ old('reporter_class', $report->reporter_class) }}"
                                class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                        </div>
                        <div>
                            <label class="block text-sm mb-1" for="reporter_major">Jurusan Pelapor (opsional)</label>
                            <input type="text" id="reporter_major" name="reporter_major" value="{{ old('reporter_major', $report->reporter_major) }}"
                                class="w-full px-4 py-2 bg-[#2a2a2a] text-white rounded border border-[#444]">
                        </div>
                    </div>

                    {{-- Tombol submit --}}
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2 rounded shadow">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script untuk hide/show field pelapor kalau anonim dicentang --}}
    <script>
        const checkbox = document.getElementById('is_anonymous');
        const reporterInfo = document.getElementById('reporter-info');

        function toggleReporterFields() {
            reporterInfo.style.display = checkbox.checked ? 'none' : 'grid';
        }

        checkbox.addEventListener('change', toggleReporterFields);
        document.addEventListener('DOMContentLoaded', toggleReporterFields);
    </script>
</x-app-layout>

