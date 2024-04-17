@extends('layouts.app')
@section('title', $title)
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Multi Columns Form -->
                    <form class="row g-3 pt-3" id="lead_search">
                        @csrf
                        <div class="col-md-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="col-md-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone">
                        </div>
                        <div class="col-md-3">
                            <label for="leadId" class="form-label">Lead ID</label>
                            <input type="text" class="form-control" id="leadId">
                        </div>
                        <div class="col-md-3">
                            <label for="lead_status" class="form-label">Lead Status</label>
                            <select class="form-select" id="lead_status">
                                <option selected>Choose...</option>
                                @foreach($lead_status as $status)
                                <option value="{{$status->id}}">{{$status->lead_status_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary" id="lead_search"><i class="bi bi-search"></i> Search</button>
                            <a href="{{url('leads/add')}}" class="btn btn-success"><i class="bi bi-plus"></i> Add Lead</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body mt-4">
                    <!-- Table with stripped rows -->
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Lead ID</th>
                                    <th>Name</th>
                                    <th>Phone No</th>
                                    <th>Lead Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-content">
                                @foreach ($leads as $lead)
                                <tr>
                                    <td>{{ $lead->id }}</td>
                                    <td>{{ $lead->name }}</td>
                                    <td>{{ $lead->phone }}</td>
                                    <td>{{ $lead->lead_status }}</td>
                                    <td>
                                        <a href="{{ url('leads/add/' . Crypt::encrypt($lead->id)) }}"><i class="bi bi-pencil-square mx-1"></i></a>&nbsp;&nbsp;
                                        <a href="{{url('leads/view/'.Crypt::encrypt($lead->id))}}"><i class="text-black bi bi-eye"></i></a>&nbsp;&nbsp;
                                        <a href="{{url('leads/delete/'.Crypt::encrypt($lead->id))}}"><i class="text-black bi bi-trash3"></i></a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="/assets/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript"> var SITE_URL = "<?php echo config('constants.SITE_URL');?>/";</script>
<script type="text/javascript"> var ASSETS = "<?php echo config('constants.ASSETS');?>/";</script>  
<script type="text/javascript" src="{{url('public/validations/leads.js')}}"></script>@endsection
