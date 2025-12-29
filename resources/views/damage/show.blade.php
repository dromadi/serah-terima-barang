@extends('layouts.app')

@section('content')
<h4>Detail Ticket {{ $report->ticket_no }}</h4>
<div class="card shadow-sm mb-3">
    <div class="card-body">
        <p>Status: <strong>{{ $report->status }}</strong></p>
        <p>Tool: {{ $report->tool->tool_name ?? '-' }}</p>
        <p>Uraian: {{ $report->uraian_kerusakan }}</p>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <h6>Action Panel</h6>
        <form method="post" action="/damage/{{ $report->id }}/action/verify" class="d-inline">
            @csrf
            <input type="text" name="remark" placeholder="Remark" class="form-control d-inline w-auto">
            <button class="btn btn-success btn-sm">Verify</button>
        </form>
        <form method="post" action="/damage/{{ $report->id }}/action/plan-repair" class="d-inline">
            @csrf
            <input type="text" name="remark" placeholder="Remark" class="form-control d-inline w-auto">
            <button class="btn btn-warning btn-sm">Plan Repair</button>
        </form>
        <form method="post" action="/damage/{{ $report->id }}/action/qa-check" class="d-inline">
            @csrf
            <input type="text" name="remark" placeholder="Remark" class="form-control d-inline w-auto">
            <button class="btn btn-primary btn-sm">QA Check</button>
        </form>
        <form method="post" action="/damage/{{ $report->id }}/action/complete" class="d-inline">
            @csrf
            <input type="text" name="remark" placeholder="Remark" class="form-control d-inline w-auto">
            <button class="btn btn-success btn-sm">Complete</button>
        </form>
    </div>
</div>
@endsection
