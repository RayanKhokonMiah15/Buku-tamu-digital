<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    You're logged in as <strong>{{ Auth::user()->username }}</strong>
                </div>
            </div>

            {{-- Form buat laporan --}}
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Buat Laporan Whistleblowing</h3>

                    <form method="POST" action="{{ route('reports.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="block font-medium">Judul Laporan</label>
                            <input type="text" name="title" id="title" class="w-full rounded px-3 py-2 text-black" required>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block font-medium">Isi Laporan</label>
                            <textarea name="content" id="content" rows="4" class="w-full rounded px-3 py-2 text-black" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="perpetrator_name" class="block font-medium">Nama Pelaku</label>
                            <input type="text" name="perpetrator_name" id="perpetrator_name" class="w-full rounded px-3 py-2 text-black" required>
                        </div>

                        <div class="mb-4">
                            <label for="perpetrator_class" class="block font-medium">Kelas Pelaku</label>
                            <input type="text" name="perpetrator_class" id="perpetrator_class" class="w-full rounded px-3 py-2 text-black" required>
                        </div>

                        <div class="mb-4">
                            <label for="perpetrator_major" class="block font-medium">Jurusan Pelaku</label>
                            <input type="text" name="perpetrator_major" id="perpetrator_major" class="w-full rounded px-3 py-2 text-black" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium">Status Pelapor</label>
                            <select name="reporter_status" class="w-full rounded px-3 py-2 text-black" required>
                                <option value="saksi">Saksi</option>
                                <option value="korban">Korban</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium">Ingin menyantumkan identitas?</label>
                            <select name="is_anonymous" id="is_anonymous" class="w-full rounded px-3 py-2 text-black" required onchange="toggleIdentityFields()">
                                <option value="1">Tidak, saya ingin anonim</option>
                                <option value="0">Ya, saya bersedia diselidiki</option>
                            </select>
                        </div>

                        <div id="identityFields" class="hidden">
                            <div class="mb-4">
                                <label for="reporter_name" class="block font-medium">Nama Pelapor</label>
                                <input type="text" name="reporter_name" id="reporter_name" class="w-full rounded px-3 py-2 text-black">
                            </div>

                            <div class="mb-4">
                                <label for="reporter_class" class="block font-medium">Kelas Pelapor</label>
                                <input type="text" name="reporter_class" id="reporter_class" class="w-full rounded px-3 py-2 text-black">
                            </div>

                            <div class="mb-4">
                                <label for="reporter_major" class="block font-medium">Jurusan Pelapor</label>
                                <input type="text" name="reporter_major" id="reporter_major" class="w-full rounded px-3 py-2 text-black">
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

