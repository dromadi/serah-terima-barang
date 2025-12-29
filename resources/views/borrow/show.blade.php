@extends('layouts.app')

@section('content')
<h4>Detail Request {{ $request->request_no }}</h4>
<div class="card shadow-sm mb-3">
    <div class="card-body">
        <p>Status: <strong>{{ $request->status }}</strong></p>
        <p>Requester: {{ $request->peminjam_display_name }}</p>
        <p>Area: {{ $request->areaUnit->area_name ?? '-' }}</p>
    </div>
</div>
<div class="card shadow-sm mb-3">
    <div class="card-body">
        <h6>Items</h6>
        <ul>
            @foreach ($request->items as $item)
                <li>{{ $item->permintaan_alat }} - {{ $item->tool->tool_name ?? 'Belum dipilih' }}</li>
            @endforeach
        </ul>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <h6>Action Panel</h6>
        <form method="post" action="/borrow/{{ $request->id }}/action/submit" class="d-inline">
            @csrf
            <button class="btn btn-primary btn-sm">Submit</button>
        </form>
        <form method="post" action="/borrow/{{ $request->id }}/action/approve-l1" class="d-inline">
            @csrf
            <input type="text" name="remark" placeholder="Remark" class="form-control d-inline w-auto">
            <button class="btn btn-success btn-sm">Approve L1</button>
        </form>
        <form method="post" action="/borrow/{{ $request->id }}/action/approve-final" class="d-inline">
            @csrf
            <input type="text" name="remark" placeholder="Remark" class="form-control d-inline w-auto">
            <button class="btn btn-success btn-sm">Approve Final</button>
        </form>
        <form method="post" action="/borrow/{{ $request->id }}/action/dispatch" class="d-inline">
            @csrf
            <input type="text" name="remark" placeholder="Remark" class="form-control d-inline w-auto">
            <button class="btn btn-warning btn-sm">Dispatch</button>
        </form>
        <form method="post" action="/borrow/{{ $request->id }}/action/return" class="d-inline">
            @csrf
            <input type="text" name="remark" placeholder="Remark" class="form-control d-inline w-auto">
            <button class="btn btn-warning btn-sm">Return</button>
        </form>
    </div>
</div>
@endsection
