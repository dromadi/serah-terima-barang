@extends('layouts.app')

@section('content')
<h4>Daftar Repair Job</h4>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Job No</th>
            <th>Ticket</th>
            <th>Vendor</th>
            <th>Assigned</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jobs as $job)
        <tr>
            <td><a href="/repairs/{{ $job->id }}">{{ $job->job_no }}</a></td>
            <td>{{ $job->damageReport->ticket_no ?? '-' }}</td>
            <td>{{ $job->vendor->vendor_name ?? '-' }}</td>
            <td>{{ $job->assignedUser->name ?? '-' }}</td>
            <td>{{ $job->progress_status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
