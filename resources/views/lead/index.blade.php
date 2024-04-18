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
                            <input type="text" class="form-control" id="leadname" name="leadname">
                        </div>
                        <div class="col-md-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name">
                        </div>
                        <div class="col-md-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-md-3">
                            <label for="fdate" class="form-label">From Date</label>
                            <input type="date" class="form-control" id="fdate" name="fdate">
                          </div>
                          <div class="col-md-3">
                            <label for="tdate" class="form-label">Too Date</label>
                            <input type="date" class="form-control" id="tdate" name="tdate">
                          </div>
                          <div class="col-md-3">
                            <label for="lead_source" class="form-label">Lead Source</label>
                            <select class="form-select" id="lead_source" name="lead_source">
                                <option selected>Choose...</option>
                                @foreach($lead_source as $source)
                                <option value="{{$source->id}}">{{$source->lead_source_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="lead_status" class="form-label">Lead Status</label>
                            <select class="form-select" id="leadstatus" name="leadstatus">
                                <option selected>Choose...</option>
                                @foreach($lead_status as $status)
                                <option value="{{$status->id}}">{{$status->lead_status_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary" id="searchButton"><i class="bi bi-search"></i> Search</button>
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
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Company Name</th>
                                    <th>Phone No</th>
                                    <th>Email</th>
                                    <th>Lead Status</th>
                                    <th>Lead Source</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-content">
                                @foreach ($leads as $lead)
                                <tr>
                                    <td>{{ $lead->id }}</td>
                                    <td>{{ $lead->date}}</td>
                                    <td>{{ $lead->name }}</td>
                                    <td>{{ $lead->company_name }}</td>
                                    <td>{{ $lead->phone }}</td>
                                    <td>{{ $lead->email }}</td>
                                    <td>{{ $lead->lead_status_name }}</td>
                                    <td>{{ $lead->lead_source_name }}</td>
                                    <td>
                                        <a href="{{ url('leads/add/' . Crypt::encrypt($lead->id)) }}"><i class="bi bi-pencil-square mx-1"></i></a>&nbsp;&nbsp;
                                        <a href="{{url('leads/view/'.Crypt::encrypt($lead->id))}}"><i class="text-black bi bi-eye"></i></a>&nbsp;&nbsp;
                                        <a href="{{url('leads/delete/'.Crypt::encrypt($lead->id))}}"><i class="text-black bi bi-trash3"></i></a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="datatable-bottom">
                            <nav class="datatable-pagination" aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    @if ($leads->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link" aria-hidden="true">&laquo; Previous</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $leads->previousPageUrl() }}" rel="prev" aria-label="Previous">&laquo; Previous</a>
                                        </li>
                                    @endif
                                    @for ($i = 1; $i <= $leads->lastPage(); $i++)
                                        <li class="page-item {{ ($i == $leads->currentPage()) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $leads->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    @if ($leads->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $leads->nextPageUrl() }}" rel="next" aria-label="Next">Next &raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link" aria-hidden="true">Next &raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                                           
           
                         </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="/assets/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript"> var SITE_URL = "<?php echo config('constants.SITE_URL');?>/";</script>
<script type="text/javascript"> var ASSETS = "<?php echo config('constants.ASSETS');?>/";</script>  
<script type="text/javascript" src="{{url('public/validations/lead.js')}}"></script>@endsection
