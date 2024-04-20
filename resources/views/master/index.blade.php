@extends('layouts.app')
@section('title', $title)
@section('content')

<div class="row">
    <div class="col-md-6 md-3">
        <div class="mb-3">
            <a href="{{ url('countries/add') }}" class="btn btn-success btn-block">Add Country</a>
        </div>
    </div>
    <div class="col-md-6 md-3">
        <div class="mb-3">
            <a href="{{ url('states/add') }}" class="btn btn-success btn-block">Add State</a>
        </div>
    </div>
    <div class="col-md-6 md-3">
        <div class="mb-3">
            <a href="{{ url('cities/add') }}" class="btn btn-success btn-block">Add City</a>
        </div>
    </div>
</div>

@endsection
