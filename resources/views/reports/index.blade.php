@extends('layouts.app')

@section('content')
@section('topbar-title')
    <h6 class="mb-0">Laporan</h6>
@endsection

<div class="breadcrumb-trail">
    <i class="bi bi-house"></i>
    <span>Laporan</span>
</div>

<div class="mb-4">
    <h2 class="fw-semibold mb-1">Laporan & Export</h2>
    <p class="section-subtitle">Unduh laporan dalam format Excel/CSV</p>
</div>

<div class="row g-4">
    <div class="col-md-6 col-xl-4">
        <div class="export-card">
            <div class="stats-icon blue mb-3"><i class="bi bi-arrow-left-right"></i></div>
            <h4 class="fw-semibold">Laporan Peminjaman</h4>
            <p class="text-muted">Export data peminjaman dengan format template standar</p>
            <div class="d-flex gap-2">
                <form method="post" action="/reports/export/requests">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">
                        <i class="bi bi-download me-2"></i>Excel
                    </button>
                </form>
                <button class="btn btn-outline-light btn-sm">
                    <i class="bi bi-file-earmark-text me-2"></i>CSV
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="export-card">
            <div class="stats-icon orange mb-3"><i class="bi bi-exclamation-triangle"></i></div>
            <h4 class="fw-semibold">Laporan Kerusakan/Perbaikan</h4>
            <p class="text-muted">Export data kerusakan dan progres perbaikan</p>
            <div class="d-flex gap-2">
                <form method="post" action="/reports/export/damage">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">
                        <i class="bi bi-download me-2"></i>Excel
                    </button>
                </form>
                <button class="btn btn-outline-light btn-sm">
                    <i class="bi bi-file-earmark-text me-2"></i>CSV
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="export-card">
            <div class="stats-icon blue mb-3"><i class="bi bi-wrench"></i></div>
            <h4 class="fw-semibold">Master Alat</h4>
            <p class="text-muted">Export daftar alat lengkap dengan status kalibrasi</p>
            <div class="d-flex gap-2">
                <form method="post" action="/reports/export/tools">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">
                        <i class="bi bi-download me-2"></i>Excel
                    </button>
                </form>
                <button class="btn btn-outline-light btn-sm">
                    <i class="bi bi-file-earmark-text me-2"></i>CSV
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="export-card">
            <div class="stats-icon gray mb-3"><i class="bi bi-clock"></i></div>
            <h4 class="fw-semibold">SLA Compliance</h4>
            <p class="text-muted">Laporan pencapaian SLA per unit kerja</p>
            <button class="btn btn-outline-light btn-sm">
                <i class="bi bi-download me-2"></i>Excel
            </button>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="export-card">
            <div class="stats-icon green mb-3"><i class="bi bi-bar-chart"></i></div>
            <h4 class="fw-semibold">Ringkasan Eksekutif</h4>
            <p class="text-muted">Laporan performa dan ringkasan status</p>
            <button class="btn btn-outline-light btn-sm">
                <i class="bi bi-download me-2"></i>Excel
            </button>
        </div>
    </div>
</div>
@endsection
