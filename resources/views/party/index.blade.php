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
            <form class="row g-3 pt-3" id="party_search_id">
              <div class="col-md-3">
                <label for="name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="name">
              </div>
              <div class="col-md-3">
                <label for="code" class="form-label">Customer Code</label>
                <input type="text" class="form-control" id="code">
              </div>
              <div class="col-md-3">
                <label for="phone" class="form-label">Phone No</label>
                <input type="number" class="form-control" id="phone">
              </div>
              <div class="col-md-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email">
              </div>
              <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select mb-2">
                  <option value="">Select status</option>
                  <option value="0">Active</option>
                  <option value="1">Inactive</option>
              </select>
              </div>
              <div class="col-md-3 mt-3 pt-3">
                <button type="button" class="btn btn-primary" id="party_search"><i class="bi bi-search"></i> Search</button>
                <a href="{{url('party/add')}}" type="submit" class="btn btn-success"><i class="bi bi-plus"></i> &nbsp;Add Customer</a>
              </div>
            </form><!-- End Multi Columns Form -->

          </div>
        </div>
        <div class="card">
          <div class="card-body mt-4">
            <!-- Table with stripped rows -->
            <div class="">
              <table class="table table-bordered">
                <thead>
                    <tr>
                      <th>Party Name</th>
                      <th>Party code</th>
                      <th>Party Type</th>
                      <th>Phone No</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                    @if(!empty($parties['results']))
                    <tbody id="table-content">
                      @foreach($parties['results'] as $party)
                    <tr>
                      <td>{{ $party->name}}</td>
                      <td>{{ $party->code}}</td>
                      <td>{{ $party->party_type}}</td>
                      <td>{{ $party->phone}}</td>
                      <td>{{ $party->email}}</td>
                      <td>{{ $party->status}}</td>
                      <td>
                        <a href="{{ url('party/add/' . Crypt::encrypt($party->id)) }}"><i class="bi bi-pencil-square mx-1"></i></a>&nbsp;&nbsp;
                                        <a href="{{url('party/view/'.Crypt::encrypt($party->id))}}"><i class="text-black bi bi-eye"></i></a>&nbsp;&nbsp;
                                        <a href="{{url('party/delete/'.$party->id)}}">@include('partials.trash-icon')
</a>

                      </td>
                    </tr>   
                    @endforeach
                    @endif                 
                  </tbody>
                </table>
                <?php if(count($parties)){?>
                  <div class="row">
                     <?php  ?>
                     <div class="col-lg-9 col-md-6">
                         <div class="row form-group">
                             <div class="col-lg-12 col-md-6">
                                 <label class="text-muted mt-1 m-b-0" id="showing">
                                     Showing 1 to
                                     <?php echo $limit_upto = ($parties['totalCount'] >
                                     10) ? 10 : $parties['totalCount'];?> of
                                     <?php echo $parties['totalCount'];?>
                                     records.
                                 </label>
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-3 col-md-6">
                         <div id="pagination" class="float-right">
                             <?php $limit = count($parties); $remaining = $parties['totalCount']%$limit;$total_page = ($remaining > 0) ? (int)($parties['totalCount']/$limit)+1 : (int)($parties['totalCount']/$limit); ?>
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
<script type="text/javascript" src="{{url('public/validations/parties.js')}}"></script>@endsection
