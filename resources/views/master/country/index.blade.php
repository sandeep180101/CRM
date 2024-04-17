@extends('layouts.app')
@section('title', $title)
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="section">
        <div class="card">
            <div class="card-body mt-4">
                <!-- Table with stripped rows -->
                <a href="{{url('countries/add')}}"><button class="btn btn-primary">Add Country</button></a>

    <table class="table">
        <thead>
            <tr>
                <th>Country Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($countries as $country)
            <tr>
                <td>{{ $country->country_name }}</td>
                <td>{{ $country->status }}</td>
                <td><a href="{{url('countries/add/'.Crypt::encrypt($country->id))}}"><i class="bi bi-pencil-square mx-1"></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

@endsection
