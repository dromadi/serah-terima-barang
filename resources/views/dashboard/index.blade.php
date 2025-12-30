@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2 class="fw-semibold">Dashboard</h2>
    <p class="text-muted">Ringkasan aktivitas per {{ now()->translatedFormat('d-M-Y') }}</p>
</div>

<div class="row g-4">
    <div class="col-md-6 col-xl-3">
        <div class="card card-dark h-100">
            <div class="card-body d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0">Total Alat</h6>
                    <div class="stats-icon blue"><i class="bi bi-wrench"></i></div>
                </div>
                <div class="display-6 fw-semibold">{{ $toolCounts['available'] + $toolCounts['on_loan'] + $toolCounts['in_repair'] + $toolCounts['out_of_service'] }}</div>
                <div class="text-muted">{{ $toolCounts['available'] }} tersedia</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-dark h-100">
            <div class="card-body d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0">Peminjaman Aktif</h6>
                    <div class="stats-icon green"><i class="bi bi-arrow-left-right"></i></div>
                </div>
                <div class="display-6 fw-semibold">{{ $toolCounts['on_loan'] }}</div>
                <div class="text-muted">menunggu approval</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-dark h-100">
            <div class="card-body d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0">Kerusakan Pending</h6>
                    <div class="stats-icon orange"><i class="bi bi-exclamation-triangle"></i></div>
                </div>
                <div class="display-6 fw-semibold">{{ $toolCounts['in_repair'] }}</div>
                <div class="text-muted">Menunggu penanganan</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-dark h-100">
            <div class="card-body d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0">Overdue</h6>
                    <div class="stats-icon gray"><i class="bi bi-clock"></i></div>
                </div>
                <div class="display-6 fw-semibold">{{ $overdue }}</div>
                <div class="text-muted">Perlu tindak lanjut</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-xl-7">
        <div class="card card-dark h-100">
            <div class="card-body">
                <h5 class="fw-semibold mb-4">Status Ketersediaan Alat</h5>
                <div class="soft-panel p-5 text-center text-muted">
                    Tidak ada data
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-5">
        <div class="card card-dark h-100">
            <div class="card-body">
                <h5 class="fw-semibold mb-4">Ringkasan Status</h5>
                <div class="status-row" style="background: rgba(34, 197, 94, 0.15);">
                    <div class="label">
                        <i class="bi bi-check-circle text-success"></i>
                        Alat Tersedia
                    </div>
                    <div class="value text-success">{{ $toolCounts['available'] }}</div>
                </div>
                <div class="status-row" style="background: rgba(59, 130, 246, 0.15);">
                    <div class="label">
                        <i class="bi bi-arrow-left-right text-primary"></i>
                        Sedang Dipinjam
                    </div>
                    <div class="value text-primary">{{ $toolCounts['on_loan'] }}</div>
                </div>
                <div class="status-row" style="background: rgba(168, 85, 247, 0.15);">
                    <div class="label">
                        <i class="bi bi-gear text-info"></i>
                        Dalam Perbaikan
                    </div>
                    <div class="value text-info">{{ $toolCounts['in_repair'] }}</div>
                </div>
                <div class="status-row" style="background: rgba(248, 113, 113, 0.15);">
                    <div class="label">
                        <i class="bi bi-x-circle text-danger"></i>
                        Tidak Aktif
                    </div>
                    <div class="value text-danger">{{ $toolCounts['out_of_service'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
