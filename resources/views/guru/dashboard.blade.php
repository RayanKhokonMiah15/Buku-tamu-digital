@extends('guru.layout')

@section('content')
<style>
    /* General Styles */
    .dashboard-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1.5rem;
    }

    .dashboard-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: #1a202c;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .success-message {
        background: #e6fffa;
        color: #2b6cb0;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
    }

    /* Report Card */
    .reports-container {
        display: grid;
        gap: 1.5rem;
    }

    .report-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        transition: transform 0.2s ease;
    }

    .report-card:hover {
        transform: translateY(-2px);
    }

    .report-header {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 1rem;
    }

    .report-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .report-date {
        color: #718096;
        font-size: 0.9rem;
    }

    .report-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2d3748;
        margin: 0.5rem 0 0;
    }

    .report-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-badge.pending {
        background: #fefcbf;
        color: #b7791f;
    }

    .status-badge.proses {
        background: #bee3f8;
        color: #2b6cb0;
    }

    .status-badge.selesai {
        background: #c6f6d5;
        color: #2f855a;
    }

    .btn-handle {
        background: #3182ce;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        border: none;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .btn-handle:hover {
        background: #2b6cb0;
    }

    .form-select {
        padding: 0.5rem;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        background: #f7fafc;
    }

    /* Report Body */
    .report-body {
        margin: 1rem 0;
        color: #4a5568;
        line-height: 1.6;
    }

    /* Image Container */
    .image-container {
        margin: 1rem 0;
    }

    .image-wrapper {
        max-width: 300px;
        border-radius: 8px;
        overflow: hidden;
    }

    .report-image {
        width: 100%;
        height: auto;
        cursor: pointer;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin: 1rem 0;
    }

    .info-card {
        background: #f7fafc;
        padding: 1rem;
        border-radius: 8px;
    }

    .info-label {
        font-size: 0.9rem;
        color: #718096;
        display: block;
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-weight: 500;
        color: #2d3748;
    }

    /* Reporter Info */
    .reporter-info {
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid #e2e8f0;
    }

    .reporter-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.75rem;
    }

    .reporter-type {
        color: #4a5568;
        font-weight: 500;
        margin-bottom: 0.75rem;
    }

    .reporter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .reporter-field {
        background: #f7fafc;
        padding: 1rem;
        border-radius: 8px;
    }

    .reporter-label {
        font-size: 0.9rem;
        color: #718096;
        display: block;
        margin-bottom: 0.25rem;
    }

    .reporter-value {
        font-weight: 500;
        color: #2d3748;
    }

    .anonymous-info {
        color: #718096;
        font-style: italic;
    }

    /* Handling Info */
    .handling-info {
        margin-top: 1rem;
        padding: 1rem;
        background: #edf2f7;
        border-radius: 8px;
    }

    .handling-info-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .handling-info-content {
        color: #4a5568;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .empty-icon {
        width: 48px;
        height: 48px;
        margin-bottom: 1rem;
        color: #a0aec0;
    }

    .empty-text {
        color: #718096;
        font-size: 1.1rem;
    }

    /* Image Viewer Modal */
    .image-viewer {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .image-viewer img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 8px;
    }

    .close-button {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 2rem;
        color: white;
        cursor: pointer;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .report-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .report-actions {
            width: 100%;
            justify-content: flex-start;
        }

        .info-grid, .reporter-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

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
                            </div>
                        </div>

                        {{-- Status dan Penanganan --}}
                        <div class="report-actions">
                            @if($report->handled_by_guru_id === null)
                                <form action="{{ route('guru.reports.handle', $report->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-handle">
                                        Tangani Laporan
                                    </button>
                                </form>
                            @endif

                            @if($report->handled_by_guru_id === Auth::guard('guru')->id())
                                <form action="{{ route('guru.reports.update', $report->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="status-badge {{ $report->status }}">
                                            @if($report->status == 'pending')
                                                ⏳ Pending
                                            @elseif($report->status == 'proses')
                                                🔄 Dalam Proses
                                            @else
                                                ✅ Selesai
                                            @endif
                                        </span>
                                        <select name="status"
                                                onchange="this.form.submit()"
                                                class="form-select form-select-sm">
                                            <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Ubah ke: Pending</option>
                                            <option value="proses" {{ $report->status == 'proses' ? 'selected' : '' }}>Ubah ke: Proses</option>
                                            <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Ubah ke: Selesai</option>
                                        </select>
                                    </div>
                                </form>
                            @endif
                        </div>

                        @if($report->handled_by_guru_id)
                            <div class="handling-info">
                                <div class="handling-info-title">Informasi Penanganan</div>
                                <div class="handling-info-content">
                                    👨‍🏫 Ditangani oleh: {{ $report->handlingGuru->username ?? 'Unknown' }}
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Isi Laporan --}}
                    <div class="report-body">
                        <p>{{ $report->isi_laporan }}</p>
                    </div>

                    {{-- Bukti Foto --}}
                    @if($report->image_path)
                        <div class="image-container">
                            <div class="image-wrapper">
                                <img src="{{ asset('storage/' . $report->image_path) }}"
                                     alt="Bukti laporan"
                                     class="report-image"
                                     onclick="openImageViewer(this.src)"
                                     loading="lazy">
                            </div>
                        </div>
                    @endif

                    {{-- Info Pelaku --}}
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

                    {{-- Info Pelapor --}}
                    <div class="reporter-info">
                        <h4 class="reporter-title">🕵️ Identitas Pelapor</h4>
                        <div class="reporter-type">{{ $report->getReporterType() }} - {{ $report->getReporterName() }}</div>

                        @if(!$report->is_anonymous)
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
                        @else
                            <p class="anonymous-info">🔒 Laporan Anonim</p>
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
    <span class="close-button" onclick="closeImageViewer()">×</span>
    <img id="expandedImage" src="" alt="Expanded image">
</div>

<script>
function openImageViewer(src) {
    document.getElementById('expandedImage').src = src;
    document.getElementById('imageViewer').style.display = 'flex';
}

function closeImageViewer() {
    document.getElementById('imageViewer').style.display = 'none';
}
</script>
@endsection
