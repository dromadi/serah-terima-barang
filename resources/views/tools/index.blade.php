@extends('layouts.app')

@section('content')
@section('topbar-title')
    <h6 class="mb-0">Master Alat</h6>
@endsection

<div class="breadcrumb-trail">
    <i class="bi bi-house"></i>
    <span>Master Alat</span>
</div>

<div class="page-header">
    <div>
        <h2 class="fw-semibold mb-1">Master Alat</h2>
        <p class="section-subtitle">{{ $tools->count() }} alat terdaftar</p>
    </div>
    <button class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Alat
    </button>
</div>

<div class="filter-panel mb-4">
    <div class="row g-3 align-items-center">
        <div class="col-lg-5">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control soft-input" placeholder="Cari kode asset, barcode...">
            </div>
        </div>
        <div class="col-lg-3">
            <select class="form-select soft-input">
                <option>Semua Status</option>
            </select>
        </div>
        <div class="col-lg-3">
            <select class="form-select soft-input">
                <option>Semua Kondisi</option>
            </select>
        </div>
        <div class="col-lg-1 d-grid">
            <button class="btn btn-outline-light">
                <i class="bi bi-download me-2"></i>Export
            </button>
        </div>
    </div>
</div>

@if ($tools->isEmpty())
    <div class="card card-dark">
        <div class="card-body">
            <div class="empty-state">
                <div class="icon"><i class="bi bi-wrench"></i></div>
                <h5 class="fw-semibold text-white mb-2">Belum ada alat</h5>
                <p class="mb-4">Tambahkan alat baru untuk memulai manajemen inventaris</p>
                <button class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Alat
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
                            <th>Asset</th>
                            <th>Barcode</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Kondisi</th>
                            <th>Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tools as $tool)
                        <tr>
                            <td><a class="text-decoration-none" href="/tools/{{ $tool->id }}">{{ $tool->asset_no }}</a></td>
                            <td>{{ $tool->barcode }}</td>
                            <td>{{ $tool->tool_name }}</td>
                            <td>{{ $tool->category->category_code ?? '-' }}</td>
                            <td>{{ $tool->location->location_code ?? '-' }}</td>
                            <td>{{ $tool->condition_status }}</td>
                            <td>{{ $tool->availability_status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
@endsection
