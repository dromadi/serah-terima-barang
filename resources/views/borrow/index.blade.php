@extends('layouts.app')

@section('content')
@section('topbar-title')
    <h6 class="mb-0">Peminjaman</h6>
@endsection

<div class="breadcrumb-trail">
    <i class="bi bi-house"></i>
    <span>Peminjaman</span>
</div>

<div class="page-header">
    <div>
        <h2 class="fw-semibold mb-1">Peminjaman Alat</h2>
        <p class="section-subtitle">{{ $requests->count() }} total request</p>
    </div>
    <button class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Buat Request
    </button>
</div>

<ul class="nav pill-tabs mb-3 gap-2">
    <li class="nav-item"><span class="nav-link active">Semua</span></li>
    <li class="nav-item"><span class="nav-link">Menunggu Approval</span></li>
    <li class="nav-item"><span class="nav-link">Aktif (0)</span></li>
    <li class="nav-item"><span class="nav-link">Overdue</span></li>
    <li class="nav-item"><span class="nav-link">Selesai</span></li>
</ul>

<div class="filter-panel mb-4">
    <div class="row g-3 align-items-center">
        <div class="col-lg-6">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control soft-input" placeholder="Cari no. request atau nama peminjam...">
            </div>
        </div>
        <div class="col-lg-4">
            <select class="form-select soft-input">
                <option>Semua Status</option>
            </select>
        </div>
        <div class="col-lg-2 d-grid">
            <button class="btn btn-outline-light">
                <i class="bi bi-download me-2"></i>Export
            </button>
        </div>
    </div>
</div>

@if ($requests->isEmpty())
    <div class="card card-dark">
        <div class="card-body">
            <div class="empty-state">
                <div class="icon"><i class="bi bi-arrow-left-right"></i></div>
                <h5 class="fw-semibold text-white mb-2">Belum ada peminjaman</h5>
                <p class="mb-4">Buat request peminjaman baru untuk memulai</p>
                <button class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Buat Request
                </button>
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
                            <th>Tanggal Permintaan</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Nama Peminjam</th>
                            <th>Area/Unit</th>
                            <th>No Item</th>
                            <th>Permintaan Alat</th>
                            <th>Rencana Peminjaman</th>
                            <th>Rencana Kembali</th>
                            <th>Nama Alat</th>
                            <th>Kode Asset</th>
                            <th>Tanggal Kirim</th>
                            <th>Surat Jalan Kirim</th>
                            <th>Tanggal Kembali</th>
                            <th>Surat Jalan Kembali</th>
                            <th>Kondisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            @foreach ($request->items as $item)
                            <tr>
                                <td><a class="text-decoration-none" href="/borrow/{{ $request->id }}">{{ $request->request_no }}</a></td>
                                <td>{{ optional($request->requested_at)->format('d-M-Y') }}</td>
                                <td>{{ $request->workType->work_name ?? '-' }}</td>
                                <td>{{ $request->peminjam_display_name }}</td>
                                <td>{{ $request->areaUnit->area_name ?? '-' }}</td>
                                <td>{{ $item->item_no }}</td>
                                <td>{{ $item->permintaan_alat }}</td>
                                <td>{{ optional($request->planned_start_at)->format('d-M-Y') }}</td>
                                <td>{{ optional($request->planned_return_at)->format('d-M-Y') }}</td>
                                <td>{{ $item->tool->tool_name ?? '-' }}</td>
                                <td>{{ $item->tool->asset_no ?? '-' }}</td>
                                <td>{{ optional($request->shipment)->sent_at?->format('d-M-Y') }}</td>
                                <td>{{ $request->shipment->surat_jalan_kirim ?? '-' }}</td>
                                <td>{{ optional($request->returnEntry)->received_at?->format('d-M-Y') }}</td>
                                <td>{{ $request->returnEntry->surat_jalan_kembali ?? '-' }}</td>
                                <td>{{ $item->kondisi_kembali ?? '-' }}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
@endsection
