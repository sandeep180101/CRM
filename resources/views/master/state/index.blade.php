@extends('layouts.app')
@section('title', $title)
@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="section">
        <div class="card">
            <div class="card-body mt-4">
                <!-- Table with stripped rows -->
                <a href="{{url('states/add')}}"><button class="btn btn-primary">Add State</button></a>

    <table class="table">
        <thead>
            <tr>
                <th>State Name</th>
                <th>Country Id</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($states))
            @foreach ($states as $state)
            <tr>
                <td>{{ $state->state_name }}</td>
                <td>{{ $state->country_name }}</td>
                <td>{{ $state->status }}</td>
                <td><a href="{{url('states/add/'.Crypt::encrypt($state->id))}}"><i class="bi bi-pencil-square mx-1"></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
</div>

@endsection
