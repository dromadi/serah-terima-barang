@extends('layouts.app')

@section('content')
@section('topbar-title')
    <h6 class="mb-0">Scan QR/Barcode</h6>
@endsection

<div class="breadcrumb-trail">
    <i class="bi bi-house"></i>
    <span>Scan QR/Barcode</span>
</div>

<div class="mb-4">
    <h2 class="fw-semibold">Scan QR/Barcode</h2>
    <p class="section-subtitle">Scan kode alat untuk melihat informasi</p>
</div>

<div class="card card-dark mb-4">
    <div class="card-body">
        <h5 class="fw-semibold mb-3"><i class="bi bi-camera me-2"></i>Scan dengan Kamera</h5>
        <div class="soft-panel p-5 text-center">
            <div class="mb-3" style="font-size: 42px; color: #94a3b8;">
                <i class="bi bi-qr-code-scan"></i>
            </div>
            <p class="text-muted mb-3">Klik tombol di bawah untuk mulai scan</p>
            <button class="btn btn-primary">
                <i class="bi bi-camera me-2"></i>Mulai Scan
            </button>
        </div>
    </div>
</div>

<div class="card card-dark">
    <div class="card-body">
        <h5 class="fw-semibold mb-3"><i class="bi bi-keyboard me-2"></i>Input Manual</h5>
        <form method="get">
            <div class="d-flex gap-3">
                <input type="text" name="asset_no" class="form-control soft-input flex-grow-1" placeholder="Masukkan kode asset atau barcode...">
                <button class="btn btn-primary">Cari</button>
            </div>
        </form>
        @if ($tool)
            <div class="alert alert-success mt-3">Tool ditemukan: <a href="/tools/{{ $tool->id }}">{{ $tool->tool_name }}</a></div>
        @endif
    </div>
</div>
@endsection
