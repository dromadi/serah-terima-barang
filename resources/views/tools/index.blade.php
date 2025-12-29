@extends('layouts.app')

@section('content')
<h4>Master Tools</h4>
<table class="table table-striped">
    <thead>
        <tr>
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
            <td><a href="/tools/{{ $tool->id }}">{{ $tool->asset_no }}</a></td>
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
@endsection
