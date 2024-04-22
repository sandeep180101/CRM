@extends('layouts.app')
@section('title', $title)
@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <!-- Multi Columns Form -->
            <form class="row g-3 pt-3" id="party_form">
                @csrf
                <input type="hidden" class="form-control" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : ''}}">
              <div class="col-md-3">
                <label for="name" class="form-label">Customer Name <span>*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="{{isset($singleData['name']) ? $singleData['name'] : ''}}" >
                @error('name')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
              </div> 
              <div class="col-md-3">
                <label for="code" class="form-label">Customer Code <span>*</span></label>
                <input type="text" class="form-control" id="code" name="code" value="{{isset($singleData['code']) ? $singleData['code'] : ''}}" >
                @error('code')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
              </div>
              <div class="col-md-3">
                <label for="industry" class="form-label">Industry</label>
                <select class="form-select" id="industry" name="industry">
                    <option value="" {{ !isset($singleData['industry_id']) || $singleData['industry_id'] == 'default' ? 'selected' : '' }}>Choose...</option>
    @if (!empty($industries['results']))

    @foreach($industries['results'] as $industry)
        <option value="{{$industry->id}}" {{ isset($singleData['industry_id']) && $singleData['industry_id'] == $industry->id ? 'selected' : ''}}>{{$industry->industry_name}}</option>
    @endforeach
    @endif
</select>
              </div>
              <div class="col-md-3">
                <label for="business" class="form-label">Business Type</label>
                    <select class="form-select" id="business" name="business">
                        <option value="" {{ !isset($singleData['business_id']) || $singleData['business_id'] == 'default' ? 'selected' : '' }}>Choose...</option>
        @if (!empty($businesses['results']))
    
        @foreach($businesses['results'] as $business)
            <option value="{{$business->id}}" {{ isset($singleData['business_id']) && $singleData['business_id'] == $business->id ? 'selected' : ''}}>{{$business->business_name}}</option>
        @endforeach
        @endif
    </select>
</div>
              <div class="col-md-3">
                <label for="phone" class="form-label">Phone No</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="{{isset($singleData['phone']) ? $singleData['phone'] : ''}}">
              </div>
              <div class="col-md-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{isset($singleData['email']) ? $singleData['email'] : ''}}">
              </div>
              <div class="col-md-3">
                <label for="whatsapp" class="form-label">WhatsApp</label>
                <input type="tel" class="form-control" id="whatsapp" name="whatsapp" value="{{isset($singleData['whatsapp']) ? $singleData['whatsapp'] : ''}}">
              </div>
              <div class="col-md-3">
                <label for="skype" class="form-label">Skype</label>
                <input type="tel" class="form-control" id="skype" name="skype" value="{{isset($singleData['skype']) ? $singleData['skype'] : ''}}">
              </div>
              <div class="col-md-3">
                <label for="gst" class="form-label">Gst</label>
                <input type="text" class="form-control" id="gst" name="gst" value="{{isset($singleData['gst']) ? $singleData['gst'] : ''}}">
              </div>
              <div class="col-md-3">
                <label for="website" class="form-label">Website</label>
                <input type="text" class="form-control" id="website" name="website" value="{{isset($singleData['website']) ? $singleData['website'] : ''}}">
              </div>
              <div class="col-md-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{isset($singleData['address']) ? $singleData['address'] : ''}}">
              </div>
              <div class="col-md-3">
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
            <div class="col-md-3">
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

            <div class="col-md-3">
                <label for="city_id" class="form-label">City</label>
                <select class="form-select" id="city_id" name="city_id">
                    <option value="" {{ !isset($singleData['city_id']) ? 'selected' : '' }}>Choose...</option>
                    @if (!empty($cities['results']))
                    @foreach($cities['results'] as $city)
                        <option value="{{$city->id}}" {{ isset($singleData['city_id']) && $singleData['city_id'] == $city->id ? 'selected' : ''}}>{{$city->city_name}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
              <div class="col-md-3">
                <label for="pincode" class="form-label">Pincode</label>
                <input type="number" class="form-control" id="pincode" name="pincode" value="{{isset($singleData['pincode']) ? $singleData['pincode'] : ''}}">
              </div>
              <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" aria-label="Select a Status" data-control="select2" data-placeholder="Choose..." class="form-select mb-2">
                    <option value="0" {{isset($singleData['status']) && $singleData['status'] == 0 ? 'selected' : ''}}>Active</option>
                    <option value="1" {{isset($singleData['status']) && $singleData['status'] == 1 ? 'selected' : ''}}>Inactive</option>
                </select>
                @error('status')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-purple"><i class="bi bi-floppy"></i> &nbsp;Submit</button>
              </div>
            </form><!-- End Multi Columns Form -->

          </div>
        </div>
      </div>
    </div>
  </section>
<script type="text/javascript"> var SITE_URL = "<?php echo config('constants.SITE_URL');?>/";</script>
<script type="text/javascript"> var ASSETS = "<?php echo config('constants.ASSETS');?>/";</script>  
<script type="text/javascript" src="{{url('public/validations/parties.js')}}"></script>

@endsection
