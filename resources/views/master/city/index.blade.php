@extends('layouts.app')
@section('title', $title)
@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body mt-3">
            <!-- Vertical Form -->
            <form class="row g-3" id="city_form">
                <input type = "hidden" name = "_token" value = '<?php echo csrf_token(); ?>'>
                <input type="text" class="form-control" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : ''}}" hidden>
              <div class="col-12">
                <label for="city_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="city_name" name="city_name" value="{{isset($singleData['city_name']) ? $singleData['city_name'] : ''}}">
              </div>
              <div class="col-md-12">
                <label for="state_id" class="form-label">State</label>
                <select class="form-select" id="state_id" name="state_id">
                    <option value="" {{ !isset($singleData['state_id']) ? 'selected' : '' }}>Choose...</option>
                    @if (!empty($states['results']))
                        @foreach($states['results'] as $state)
                            <option value="{{$state->id}}" {{ isset($singleData['state_id']) && $singleData['state_id'] == $state->id ? 'selected' : ''}}>{{$state->state_name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
              <div class="col-md-12">
                <label for="country_id" class="form-label">Country</label>
                <select class="form-select" id="country_id" name="country_id">
                    <option value="" {{ !isset($singleData['country_id']) ? 'selected' : '' }}>Choose...</option>
                    @if (!empty($countries['results']))
                        @foreach($countries['results'] as $country)
                            <option value="{{$country->id}}" {{ isset($singleData['country_id']) && $singleData['country_id'] == $country->id ? 'selected' : ''}}>{{$country->country_name}}</option>
                        @endforeach
                    @endif
                </select>
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
                  <th width="20%">City Name</th>
                  <th width="20%">State</th>
                  <th width="20%">Country</th>
                  <th width="20%">Status</th>
                  <th width="20%">Action</th>
                </tr>
              </thead>
              <tbody>   
                <tr>
                  @foreach ($cities as $city)
                      
                  <td>{{ $city->city_name}}</td>
                  <td>{{ $city->state_name}}</td>
                  <td>{{ $city->country_name}}</td>
                  <td>{{ $city->status}}</td>
                  <td><a href="{{url('cities/add/'. Crypt::encrypt($city->id))}}"><i class="bi bi-pencil-square mx-1"></i></a>
                      <a href="{{url('cities/delete/'.$city->id)}}">@include('partials.trash-icon')
</a></td>
                </tr>
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
  <script type="text/javascript" src="{{url('public/validations/cities.js')}}"></script>
@endsection