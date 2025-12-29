@extends('layouts.app')

@section('content')
<h4>Export Laporan</h4>
<div class="list-group">
    <form method="post" action="/reports/export/requests" class="list-group-item">
        @csrf
        <button class="btn btn-outline-primary">Export Request</button>
    </form>
    <form method="post" action="/reports/export/damage" class="list-group-item">
        @csrf
        <button class="btn btn-outline-primary">Export Kerusakan/Perbaikan</button>
    </form>
    <form method="post" action="/reports/export/tools" class="list-group-item">
        @csrf
        <button class="btn btn-outline-primary">Export Master Tools</button>
    </form>
</div>
@endsection
