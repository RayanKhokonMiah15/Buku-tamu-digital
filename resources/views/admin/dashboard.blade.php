@extends('admin.layout')

@section('content')
    <div class="dashboard-container">
        <h2 class="dashboard-title">📥 Laporan Masuk</h2>

        @if(session('success'))
            <div class="success-message">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="reports-container">
            @forelse($reports as $report)
                <div class="report-card">
                    <div class="report-content">
                        {{-- Header --}}
                        <div class="report-header">
                            <div class="report-info">
                                <div>
                                    <span class="report-date">{{ $report->created_at->format('d M Y • H:i') }}</span>
                                    <h3 class="report-title">{{ $report->judul }}</h3>
                                </div>
                            </div>
                            {{-- Dropdown Status --}}
                            <form action="{{ route('admin.reports.update', $report->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status"
                                        onchange="this.form.submit()"
                                        class="status-select {{ $report->status == 'pending' ? 'status-pending' : '' }}
                                        {{ $report->status == 'proses' ? 'status-process' : '' }}
                                        {{ $report->status == 'selesai' ? 'status-done' : '' }}">
                                    <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                    <option value="proses" {{ $report->status == 'proses' ? 'selected' : '' }}>🔄 Proses</option>
                                    <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                </select>
                            </form>
                        </div>

                        {{-- Isi Laporan --}}
                        <div class="report-body">
                            <p>{{ $report->isi_laporan }}</p>
                        </div>

                        {{-- Bukti Foto --}}
                        @if($report->image_path)
                            <div class="image-container">
                                <div class="image-wrapper">
                                    <div class="image-frame">
                                        <img src="{{ asset('storage/' . $report->image_path) }}"
                                             alt="Bukti laporan"
                                             class="report-image"
                                             onclick="openImageViewer(this.src)"
                                             loading="lazy"
                                             onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%23999999\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'%3E%3Cline x1=\'18\' y1=\'6\' x2=\'6\' y2=\'18\'%3E%3C/line%3E%3Cline x1=\'6\' y1=\'6\' x2=\'18\' y2=\'18\'%3E%3C/line%3E%3C/svg%3E'; this.classList.add('p-8');">
                                    </div>
                                    <div class="image-overlay">
                                        <span class="zoom-text">
                                            <svg class="zoom-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                            </svg>
                                            Klik untuk memperbesar
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Informasi Pelaku --}}
                        <div class="info-grid">
                            <div class="info-card">
                                <span class="info-label">👤 Nama Pelaku</span>
                                <div class="info-value">{{ in_array($report->nama_pelaku, ["Tidak Diketahui", "tidak diketahui"]) ? "❓ Tidak Diketahui" : $report->nama_pelaku }}</div>
                            </div>
                            <div class="info-card">
                                <span class="info-label">🏫 Kelas</span>
                                <div class="info-value">{{ in_array($report->kelas_pelaku, ["Tidak Diketahui", "tidak diketahui"]) ? "❓ Tidak Diketahui" : $report->kelas_pelaku }}</div>
                            </div>
                            <div class="info-card">
                                <span class="info-label">🎓 Jurusan</span>
                                <div class="info-value">{{ in_array($report->jurusan_pelaku, ["Tidak Diketahui", "tidak diketahui"]) ? "❓ Tidak Diketahui" : $report->jurusan_pelaku }}</div>
                            </div>
                            <div class="info-card">
                                <span class="info-label">🎭 Peran</span>
                                <div class="info-value">{{ ucfirst($report->peran) }}</div>
                            </div>
                        </div>

                        @if($report->is_anonymous)
                            <div class="reporter-info">
                                <p class="info-label">🔒 Laporan Anonim</p>
                            </div>
                        @else
                            <div class="reporter-info">
                                <h4 class="reporter-title">🕵️ Identitas Pelapor</h4>
                                <div class="reporter-grid">
                                    <div class="reporter-field">
                                        <span class="reporter-label">Nama</span>
                                        <span class="reporter-value">{{ $report->reporter_name }}</span>
                                    </div>
                                    <div class="reporter-field">
                                        <span class="reporter-label">Kelas</span>
                                        <span class="reporter-value">{{ $report->reporter_class }}</span>
                                    </div>
                                    <div class="reporter-field">
                                        <span class="reporter-label">Jurusan</span>
                                        <span class="reporter-value">{{ $report->reporter_major }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                {{-- Tidak ada laporan --}}
                <div class="empty-state">
                    <svg class="empty-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <h3 class="empty-title">Belum ada laporan</h3>
                    <p class="empty-message">Semua masih aman. Tidak ada laporan masuk.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        function openImageViewer(src) {
            const modal = document.createElement('div');
            modal.className = 'modal';
            modal.innerHTML = `
                <div class="modal-container">
                    <button class="close-button" onclick="this.parentElement.parentElement.remove()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <div class="modal-image-container">
                        <img src="${src}"
                            class="modal-image"
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
@endsection
