@extends('admin.layout')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Laporan Masuk</h2>

    @if(session('success'))
        <div class="bg-green-600 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-900 dark:text-gray-300 border border-gray-300 dark:border-[#3a3a3a]">
            <thead class="bg-gray-100 dark:bg-[#262626] text-xs uppercase font-medium text-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-4 py-2">Judul</th>
                    <th class="px-4 py-2">Isi</th>
                    <th class="px-4 py-2">Pelaku</th>
                    <th class="px-4 py-2">Kelas</th>
                    <th class="px-4 py-2">Jurusan</th>
                    <th class="px-4 py-2">Peran</th>
                    <th class="px-4 py-2">Identitas Pelapor</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Dibuat Pada</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-[#181818]">
                @forelse($reports as $report)
                    <tr class="border-b border-gray-300 dark:border-[#3a3a3a]">
                        <td class="px-4 py-2">{{ $report->judul }}</td>
                        <td class="px-4 py-2 max-w-xs truncate">{{ $report->isi_laporan }}</td>
                        <td class="px-4 py-2">{{ $report->nama_pelaku }}</td>
                        <td class="px-4 py-2">{{ $report->kelas_pelaku }}</td>
                        <td class="px-4 py-2">{{ $report->jurusan_pelaku }}</td>
                        <td class="px-4 py-2">{{ $report->peran }}</td>
                        <td class="px-4 py-2">
                            @if(isset($report->is_anonymous) && $report->is_anonymous == 0)
                                {{ $report->reporter_name }} <br>
                                {{ $report->reporter_class }} <br>
                                {{ $report->reporter_major }}
                            @else
                                <em>Anonim</em>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ ucfirst($report->status) }}</td>
                        <td class="px-4 py-2">{{ $report->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-2">
                         <form action="{{ route('admin.reports.update', $report->id) }}" method="POST">
    @csrf
    @method('PUT')
    <select name="status" class="form-select" onchange="this.form.submit()">
        <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="proses" {{ $report->status == 'proses' ? 'selected' : '' }}>Proses</option>
        <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
    </select>
</form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">Belum ada laporan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

