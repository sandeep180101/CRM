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
                    <form class="row g-3 pt-3" id="lead_search_id">
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
@csrf
                        <div class="col-md-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="col-md-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name">
                        </div>
                        <div class="col-md-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
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
                            <label for="lead_source_id" class="form-label">Lead Source</label>
                            <select name="lead_source_id" id="lead_source_id" aria-label="Select a Language" data-control="select2" data-placeholder="Choose..." class="form-select mb-2">
                                <option value="">Select</option>
                                @foreach($lead_source as $source)
                                    <option value="{{$source->id}}">{{ $source->lead_source_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="lead_status_id" class="form-label">Lead Status</label>
                            <select class="form-select" id="lead_status_id" name="lead_status_id">
                                <option value="">Select</option>
                                @foreach($lead_status['results'] as $status)
                                <option value="{{$status->id}}">{{$status->lead_status_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary" id="lead_search"><i class="bi bi-search"></i> Search</button>
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
                            @if(!empty($leads['results']))
                                
                            <tbody id="table-content">
                                @foreach ($leads['results'] as $lead)
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
                                        <a href="{{url('leads/delete/'.$lead->id)}}">@include('partials.trash-icon')</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif

                        <?php if(count($leads)){?>
                            <div class="row">
                               <?php  ?>
                               <div class="col-lg-9 col-md-6">
                                   <div class="row form-group">
                                       <div class="col-lg-12 col-md-6">
                                           <label class="text-muted mt-1 m-b-0" id="showing">
                                               Showing 1 to
                                               <?php echo $limit_upto = ($leads['totalCount'] >
                                               10) ? 10 : $leads['totalCount'];?> of
                                               <?php echo $leads['totalCount'];?>
                                               records.
                                           </label>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-lg-3 col-md-6">
                                   <div id="pagination" class="float-right">
                                       <?php $limit = count($leads); $remaining = $leads['totalCount']%$limit;$total_page = ($remaining > 0) ? (int)($leads['totalCount']/$limit)+1 : (int)($leads['totalCount']/$limit); ?>
                                       <ul class="pagination justify-content-center">
                                           <li class="page-item strt filter" data-limit="<?php echo $limit;?>" data-start="0"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                           <li class="page-item prev filter" data-limit="<?php echo $limit;?>" data-start="0">
                                               <a class="page-link" href="javascript:void(0);">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-left" viewBox="0 0 16 16">
                                                       <path fill-rule="evenodd" d="M9.224 1.553a.5.5 0 0 1 .223.67L6.56 8l2.888 5.776a.5.5 0 1 1-.894.448l-3-6a.5.5 0 0 1 0-.448l3-6a.5.5 0 0 1 .67-.223z" />
                                                   </svg>
                                               </a>
                                           </li>
                                           <li class="page-item pageActive"><a class="page-link disp" href="javascript:void(0);">1</a></li>
                                           <li class="page-item next filter" data-limit="<?php echo $limit;?>" data-start="<?php echo ($total_page > 1) ? $limit : 0;?>">
                                               <a class="page-link" href="javascript:;">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
                                                       <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671z" />
                                                   </svg>
                                               </a>
                                           </li>
                                           <li class="page-item last filter" data-limit="<?php echo $limit;?>" data-start="<?php echo ($total_page-1)*$limit;?>"><a class="page-link" href="javascript:;">Next</a></li>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                           <?php } else{?>
                           <div class="row">
                               <div class="col-lg-9 col-md-6">
                                   <div class="row form-group">
                                       <div class="col-lg-12 col-md-6">
                                           <label class="text-muted mt-1 m-b-0" id="showing">
                                           </label>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-lg-3 col-md-6">
                                   <div id="pagination" class="float-right">
                                       <ul class="pagination justify-content-center">
                                           <li class="page-item strt filter" data-limit="" data-start="0"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                           <li class="page-item prev filter" data-limit="" data-start="0">
                                               <a class="page-link" href="javascript:void(0);">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-left" viewBox="0 0 16 16">
                                                       <path fill-rule="evenodd" d="M9.224 1.553a.5.5 0 0 1 .223.67L6.56 8l2.888 5.776a.5.5 0 1 1-.894.448l-3-6a.5.5 0 0 1 0-.448l3-6a.5.5 0 0 1 .67-.223z" />
                                                   </svg>
                                               </a>
                                           </li>
                                           <li class="page-item pageActive"><a class="page-link disp" href="javascript:void(0);"></a></li>
                                           <li class="page-item next filter" data-limit="" data-start="">
                                               <a class="page-link" href="javascript:;">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
                                                       <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671z" />
                                                   </svg>
                                               </a>
                                           </li>
                                           <li class="page-item last filter" data-limit="" data-start=""><a class="page-link" href="javascript:;">Next</a></li>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                           <?php } ?>
                                           
           
                         </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

<script type="text/javascript" src="/assets/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript"> var SITE_URL = "<?php echo config('constants.SITE_URL');?>/";</script>
<script type="text/javascript"> var ASSETS = "<?php echo config('constants.ASSETS');?>/";</script>  
<script type="text/javascript" src="{{url('public/validations/leads.js')}}"></script>@endsection
