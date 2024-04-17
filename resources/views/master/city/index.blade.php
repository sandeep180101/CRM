@extends('layouts.app')
@section('title', $title)
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="section">
        <div class="card">
            <div class="card-body mt-4">
                <!-- Table with stripped rows -->
                <a href="{{url('cities/add')}}"><button class="btn btn-primary">Add City</button></a>

    <table class="table">
        <thead>
            <tr>
                <th>City Name</th>
                <th>State Name</th>
                <th>Country Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cities as $city)
            <tr>
                <td>{{ $city->city_name }}</td>
                <td>{{ $city->state_id }}</td>
                <td>{{ $city->country_id }}</td>
                <td>{{ $city->status }}</td>
                <td><a href="{{url('cities/add/'.Crypt::encrypt($city->id))}}"><i class="bi bi-pencil-square mx-1"></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

</section>

@endsection
