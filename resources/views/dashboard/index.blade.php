@extends('layouts.app')

@section('content')
<div class="row g-3">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Available</h6>
                <h3>{{ $toolCounts['available'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>On Loan</h6>
                <h3>{{ $toolCounts['on_loan'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>In Repair</h6>
                <h3>{{ $toolCounts['in_repair'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Out of Service</h6>
                <h3>{{ $toolCounts['out_of_service'] }}</h3>
            </div>
        </div>
    </div>
</div>
<div class="row g-3 mt-1">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Overdue Return (hari kerja)</h6>
                <h3>{{ $overdue }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Biaya Perbaikan Bulan Ini</h6>
                <h3>Rp {{ number_format($repairCostMonth, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
