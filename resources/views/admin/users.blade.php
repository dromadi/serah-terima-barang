@extends('layouts.app')

@section('content')
<h4>Manajemen User</h4>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->name ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
