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
                                    <span class="report-date">{{ $report->created_at->format('d M Y • H:i') }} • {{ $report->getReporterType() }}</span>
                                    <h3 class="report-title">{{ $report->judul }}</h3>

                                    {{-- Status Badge --}}
                                    <span class="status-badge {{ $report->status }}">
                                        @if($report->status == 'pending')
                                            ⏳ Pending
                                        @elseif($report->status == 'proses')
                                            🔄 Dalam Proses
                                        @else
                                            ✅ Selesai
                                        @endif
                                    </span>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="report-actions">
                                {{-- Status Form --}}
                                <form action="{{ route('admin.reports.update', $report->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status"
                                            onchange="this.form.submit()"
                                            class="form-select form-select-sm">
                                        <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Ubah ke: Pending</option>
                                        <option value="proses" {{ $report->status == 'proses' ? 'selected' : '' }}>Ubah ke: Proses</option>
                                        <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Ubah ke: Selesai</option>
                                    </select>
                                </form>
                            </div>
                        </div>

                        {{-- Guru Handling Info --}}
                        @if($report->handled_by_guru_id)
                            <div class="handling-info">
                                <div class="handling-info-title">Informasi Penanganan</div>
                                <div class="handling-info-content">
                                    👨‍🏫 Ditangani oleh: {{ $report->handlingGuru->username ?? 'Unknown' }}
                                </div>
                                <div class="handling-info-content mt-1">
                                    📅 Status: {{ ucfirst($report->status) }}
                                </div>
                            </div>
                        @endif

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
                                </div>
                            </div>
                        @endif

                        {{-- Info Grid --}}
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

                        {{-- Reporter Info --}}
                        <div class="reporter-section">
                            <h4 class="reporter-title">🕵️ Identitas Pelapor</h4>

                            @if($report->is_anonymous)
                                <p class="anonymous-info">🔒 Laporan Anonim</p>
                            @else
                                <div class="reporter-info">
                                    @if($report->reporter_name || $report->reporter_class || $report->reporter_major)
                                        <div class="reporter-grid">
                                            @if($report->reporter_name)
                                                <div class="reporter-field">
                                                    <span class="reporter-label">Nama</span>
                                                    <span class="reporter-value">{{ $report->reporter_name }}</span>
                                                </div>
                                            @endif
                                            @if($report->reporter_class)
                                                <div class="reporter-field">
                                                    <span class="reporter-label">Kelas</span>
                                                    <span class="reporter-value">{{ $report->reporter_class }}</span>
                                                </div>
                                            @endif
                                            @if($report->reporter_major)
                                                <div class="reporter-field">
                                                    <span class="reporter-label">Jurusan</span>
                                                    <span class="reporter-value">{{ $report->reporter_major }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <svg class="empty-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="empty-text">Belum ada laporan yang masuk</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Image Viewer Modal --}}
    <div id="imageViewer" class="image-viewer">
        <span class="close-button" onclick="closeImageViewer()">&times;</span>
        <img id="expandedImage" src="" alt="Expanded image">
    </div>

    <script>
        function openImageViewer(imgSrc) {
            document.getElementById("imageViewer").style.display = "flex";
            document.getElementById("expandedImage").src = imgSrc;
        }

        function closeImageViewer() {
            document.getElementById("imageViewer").style.display = "none";
        }
    </script>
@endsection
