@extends('layouts.app')
@section('title', $title)
@section('content')

<div class="container">
    <h1>User Roles</h1>
    <div>
        <a href="{{url('roles/add')}}"><button class="btn btn-primary">Add Roles</button></a>
    </div>
    <div>
    <table class="table">
        <thead>
            <tr>
                <th>Role Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{ $role->role_name }}</td>
                <td>{{ $role->status }}</td>
                <td><a href="{{url('roles/add/'.Crypt::encrypt($role->id))}}"><i class="bi bi-pencil-square mx-1"></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

@endsection
