@extends('layouts.app')

@section('content')
<h4>Master Data</h4>
<div class="row">
    <div class="col-md-6">
        <h6>Kategori Tool</h6>
        <ul class="list-group mb-3">
            @foreach ($categories as $category)
                <li class="list-group-item">{{ $category->category_code }} - {{ $category->category_name }}</li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-6">
        <h6>Lokasi Tool</h6>
        <ul class="list-group mb-3">
            @foreach ($locations as $location)
                <li class="list-group-item">{{ $location->location_code }} - {{ $location->location_name }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
