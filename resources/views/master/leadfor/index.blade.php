@extends('layouts.app')
@section('title', $title)
@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body mt-3">
            <!-- Vertical Form -->
            <form class="row g-3" id="lead_for_form">
                <input type = "hidden" name = "_token" value = '<?php echo csrf_token(); ?>'>
                <input type="text" class="form-control" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : ''}}" hidden>
              <div class="col-12">
                <label for="lead_for_name" class="form-label">Lead For</label>
                <input type="text" class="form-control" id="lead_for_name" name="lead_for_name" value="{{isset($singleData['lead_for_name']) ? $singleData['lead_for_name'] : ''}}">
              </div>
              <div class="col-md-12">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" aria-label="Select a Status" data-control="select2" data-placeholder="Choose..." class="form-select mb-2">
                    <option value="0" {{isset($singleData['status']) && $singleData['status'] == 0 ? 'selected' : ''}}>Active</option>
                    <option value="1" {{isset($singleData['status']) && $singleData['status'] == 1 ? 'selected' : ''}}>Inactive</option>
                </select>
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-purple"><i class="bi bi-floppy"></i> &nbsp;Submit</button>
              </div>
            </form><!-- Vertical Form -->

          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body pt-3">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">lead for name</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>   
                <tr>
                  @foreach ($leadfor as $for)  
                  @if($for->status == "Active")
                  <td>{{ $for->lead_for_name}}</td>
                  <td>{{ $for->status}}</td>
                  <td><a href="{{url('lead_for/add/'. Crypt::encrypt($for->id))}}"><i class="bi bi-pencil-square mx-1"></i></a>
                      <a href="{{url('lead_for/delete/'.$for->id)}}">@include('partials.trash-icon')
</a></td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script type="text/javascript" src="/assets/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript"> var SITE_URL = "<?php echo config('constants.SITE_URL');?>/";</script>
  <script type="text/javascript"> var ASSETS = "<?php echo config('constants.ASSETS');?>/";</script>  
  <script type="text/javascript" src="{{url('public/validations/leadfor.js')}}"></script>
@endsection