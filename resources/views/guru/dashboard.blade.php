@extends('guru.layout')

@section('styles')
<style>
    /* General Styles */
    :root {
        --primary-blue: #3b82f6;
        --secondary-blue: #2563eb;
        --background-darker: #111827;
        --background-dark: #1f2937;
        --card-dark: rgba(17, 24, 39, 0.95);
        --text-light: #ffffff;
        --text-gray: #9ca3af;
        --border-dark: #374151;
        --card-gradient-start: rgba(17, 24, 39, 0.95);
        --card-gradient-end: rgba(31, 41, 55, 0.95);
    }

    body {
        background-color: var(--background-darker);
        color: var(--text-light);
        min-height: 100vh;
        background-image: 
            radial-gradient(at 40% 20%, rgba(59, 130, 246, 0.1) 0px, transparent 50%),
            radial-gradient(at 80% 0%, rgba(37, 99, 235, 0.1) 0px, transparent 50%),
            radial-gradient(at 0% 50%, rgba(59, 130, 246, 0.1) 0px, transparent 50%);
    }

    .dashboard-container {
        max-width: 1400px;
        margin: 2rem auto;
        padding: 0 2rem;
    }

    .dashboard-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: linear-gradient(45deg, var(--primary-blue), var(--secondary-blue));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: titleGlow 2s ease-in-out infinite alternate;
    }

    @keyframes titleGlow {
        from {
            filter: drop-shadow(0 0 2px rgba(59, 130, 246, 0.5));
        }
        to {
            filter: drop-shadow(0 0 5px rgba(59, 130, 246, 0.8));
        }
    }

    .success-message {
        background: rgba(16, 185, 129, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #10B981;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
    }

    /* Report Cards */
    .reports-container {
        display: grid;
        gap: 2rem;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }

    .report-card {
        background: linear-gradient(135deg, var(--card-gradient-start), var(--card-gradient-end));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 1rem;
        padding: 1.5rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .report-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05), transparent);
        transition: 0.5s;
    }

    .report-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(17, 24, 39, 0.2);
        border-color: rgba(59, 130, 246, 0.2);
    }

    .report-card:hover::before {
        left: 100%;
    }

    .report-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        background: rgba(17, 24, 39, 0.5);
        margin: -1.5rem -1.5rem 1rem -1.5rem;
        padding: 1.5rem;
        border-radius: 1rem 1rem 0 0;
    }

    .report-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .report-date {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .report-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #ffffff;
        margin: 0.5rem 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .report-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.875rem;
        font-weight: 500;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(8px);
    }

    .status-badge.pending {
        background: rgba(251, 191, 36, 0.15);
        color: #FBBF24;
        border: 1px solid rgba(251, 191, 36, 0.3);
        text-shadow: 0 0 10px rgba(251, 191, 36, 0.3);
    }

    .status-badge.proses {
        background: rgba(59, 130, 246, 0.15);
        color: #60A5FA;
        border: 1px solid rgba(59, 130, 246, 0.3);
        text-shadow: 0 0 10px rgba(59, 130, 246, 0.3);
    }

    .status-badge.selesai {
        background: rgba(16, 185, 129, 0.15);
        color: #34D399;
        border: 1px solid rgba(16, 185, 129, 0.3);
        text-shadow: 0 0 10px rgba(16, 185, 129, 0.3);
    }

    .btn-handle {
        background: linear-gradient(45deg, var(--primary-blue), var(--secondary-blue));
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-handle:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .form-select {
        background-color: rgba(30, 41, 59, 0.7);
        border: 1px solid rgba(59, 130, 246, 0.2);
        color: #D1D5DB;
        padding: 0.5rem;
        border-radius: 0.5rem;
        margin-left: 0.5rem;
        backdrop-filter: blur(8px);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    /* Report Body */
    .report-body {
        margin: 1rem 0;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
        background: rgba(0, 0, 0, 0.2);
        padding: 1rem;
        border-radius: 0.5rem;
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
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .report-image:hover {
        transform: scale(1.05);
    }

    /* Info Grid */
    .info-card {
        background: rgba(17, 24, 39, 0.5);
        backdrop-filter: blur(8px);
        padding: 1rem;
        border-radius: 0.5rem;
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .info-card:hover {
        background: rgba(31, 41, 55, 0.5);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .info-label {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-weight: 500;
        color: #ffffff;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* Reporter Info */
    .reporter-info {
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .reporter-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-blue);
        margin-bottom: 1rem;
    }

    .reporter-type {
        color: var(--text-gray);
        margin-bottom: 1rem;
    }

    .reporter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .reporter-field {
        background: rgba(17, 24, 39, 0.5);
        backdrop-filter: blur(8px);
        padding: 1rem;
        border-radius: 0.5rem;
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .reporter-label {
        font-size: 0.875rem;
        color: #9CA3AF;
        margin-bottom: 0.25rem;
    }

    .reporter-value {
        font-weight: 500;
        color: var(--primary-blue);
    }

    .anonymous-info {
        color: var(--text-gray);
        font-style: italic;
    }

    /* Handling Info */
    .handling-info {
        background: rgba(17, 24, 39, 0.5);
        backdrop-filter: blur(8px);
        padding: 1rem;
        border-radius: 0.5rem;
        margin: 1rem 0;
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .handling-info-title {
        font-weight: 600;
        color: var(--primary-blue);
        margin-bottom: 0.5rem;
    }

    .handling-info-content {
        color: var(--text-light);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--card-dark);
        backdrop-filter: blur(10px);
        border: 1px solid var(--border-dark);
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .empty-icon {
        width: 48px;
        height: 48px;
        margin-bottom: 1rem;
        color: var(--text-gray);
        filter: drop-shadow(0 0 8px rgba(59, 130, 246, 0.2));
    }

    .empty-text {
        color: var(--text-gray);
        font-size: 1.1rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Image Viewer Modal */
    .image-viewer {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        backdrop-filter: blur(10px);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .image-viewer img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 0.5rem;
        box-shadow: 0 0 32px rgba(0, 0, 0, 0.5);
    }

    .close-button {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 2rem;
        color: white;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .close-button:hover {
        transform: rotate(90deg);
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
@endsection

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
