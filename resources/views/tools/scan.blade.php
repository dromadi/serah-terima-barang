@extends('layouts.app')

@section('content')
<h4>Scan QR/Barcode</h4>
<form method="get" class="mb-3">
    <div class="input-group">
        <input type="text" name="asset_no" class="form-control" placeholder="Scan asset_no atau barcode">
        <button class="btn btn-primary">Cari</button>
    </div>
</form>
@if ($tool)
    <div class="alert alert-success">Tool ditemukan: <a href="/tools/{{ $tool->id }}">{{ $tool->tool_name }}</a></div>
@endif
@endsection
