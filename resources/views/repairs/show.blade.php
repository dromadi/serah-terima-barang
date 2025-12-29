@extends('layouts.app')

@section('content')
<h4>Repair Job {{ $job->job_no }}</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <p>Vendor: {{ $job->vendor->vendor_name ?? '-' }}</p>
        <p>Assigned: {{ $job->assignedUser->name ?? '-' }}</p>
        <p>Status: {{ $job->progress_status }}</p>
        <form method="post" action="/repairs/{{ $job->id }}/action/update" class="mt-3">
            @csrf
            <input type="text" name="remark" placeholder="Remark" class="form-control mb-2" required>
            <button class="btn btn-primary">Update Progress</button>
        </form>
    </div>
</div>
@endsection
