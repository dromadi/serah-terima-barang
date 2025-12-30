@extends('layouts.app')

@section('content')
@section('topbar-title')
    <h6 class="mb-0">Kerusakan</h6>
@endsection

<div class="breadcrumb-trail">
    <i class="bi bi-house"></i>
    <span>Kerusakan</span>
</div>

<div class="mb-4">
    <h2 class="fw-semibold mb-1">Laporan Kerusakan</h2>
    <p class="section-subtitle">{{ $reports->count() }} total laporan</p>
</div>

<ul class="nav pill-tabs mb-3 gap-2">
    <li class="nav-item"><span class="nav-link active">Semua</span></li>
    <li class="nav-item"><span class="nav-link">Pending</span></li>
    <li class="nav-item"><span class="nav-link">Dalam Proses (0)</span></li>
    <li class="nav-item"><span class="nav-link">Selesai</span></li>
</ul>

<div class="filter-panel mb-4">
    <div class="row g-3 align-items-center">
        <div class="col-lg-5">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control soft-input" placeholder="Cari ticket, alat, atau asset...">
            </div>
        </div>
        <div class="col-lg-3">
            <select class="form-select soft-input">
                <option>Semua Status</option>
            </select>
        </div>
        <div class="col-lg-3">
            <select class="form-select soft-input">
                <option>Semua Prioritas</option>
            </select>
        </div>
        <div class="col-lg-1 d-grid">
            <button class="btn btn-outline-light">
                <i class="bi bi-download me-2"></i>Export
            </button>
        </div>
    </div>
</div>

@if ($reports->isEmpty())
    <div class="card card-dark">
        <div class="card-body">
            <div class="empty-state">
                <div class="icon"><i class="bi bi-exclamation-triangle"></i></div>
                <h5 class="fw-semibold text-white mb-2">Belum ada laporan kerusakan</h5>
                <p class="mb-0">Laporan kerusakan akan muncul di sini</p>
            </div>
        </div>
    </div>
@else
    <div class="card card-dark">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-dark table-borderless align-middle mb-0">
                    <thead>
                        <tr class="text-muted">
                            <th>No</th>
                            <th>Tanggal Kerusakan</th>
                            <th>Surat Kerusakan</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Pelapor</th>
                            <th>Nama Alat</th>
                            <th>No Asset</th>
                            <th>Uraian Kerusakan</th>
                            <th>Tahun Perolehan</th>
                            <th>Tanggal Pengecekan</th>
                            <th>Prioritas</th>
                            <th>Hasil Verifikasi</th>
                            <th>Usulan Tindak Lanjut</th>
                            <th>Progress Perbaikan</th>
                            <th>Nama Mitra/Swakelola</th>
                            <th>Tanggal Kirim</th>
                            <th>Surat Jalan Kirim</th>
                            <th>Rencana Kembali</th>
                            <th>Nilai Perbaikan</th>
                            <th>Tanggal Terima</th>
                            <th>Surat Jalan Terima</th>
                            <th>Hasil Akhir</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                        <tr>
                            <td><a class="text-decoration-none" href="/damage/{{ $report->id }}">{{ $report->ticket_no }}</a></td>
                            <td>{{ optional($report->reported_at)->format('d-M-Y') }}</td>
                            <td>{{ $report->surat_kerusakan ?? '-' }}</td>
                            <td>{{ $report->workType->work_name ?? '-' }}</td>
                            <td>{{ $report->reporter->name ?? '-' }}</td>
                            <td>{{ $report->tool->tool_name ?? '-' }}</td>
                            <td>{{ $report->tool->asset_no ?? '-' }}</td>
                            <td>{{ $report->uraian_kerusakan }}</td>
                            <td>{{ $report->tool->acquisition_year ?? '-' }}</td>
                            <td>{{ optional($report->verified_at)->format('d-M-Y') }}</td>
                            <td>{{ $report->priority }}</td>
                            <td>{{ $report->verification_result }}</td>
                            <td>{{ $report->recommendation }}</td>
                            <td>{{ $report->progress }}</td>
                            <td>{{ $report->vendor_name }}</td>
                            <td>{{ optional($report->sent_at)->format('d-M-Y') }}</td>
                            <td>{{ $report->surat_jalan_repair_kirim }}</td>
                            <td>{{ optional($report->planned_return_at)->format('d-M-Y') }}</td>
                            <td>{{ $report->repair_cost_idr }}</td>
                            <td>{{ optional($report->received_at)->format('d-M-Y') }}</td>
                            <td>{{ $report->surat_jalan_repair_terima }}</td>
                            <td>{{ $report->hasil_akhir }}</td>
                            <td>{{ $report->status }}</td>
                            <td>{{ $report->remark }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
@endsection
