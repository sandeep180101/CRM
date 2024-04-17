@extends('layouts.app')
@section('title', 'Lead')
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Multi Columns Form -->
                    <form class="row g-3 pt-3" novalidate id="lead_form">
                        @csrf
                        <input type="hidden" class="form-control" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : ''}}">
                        <div class="col-md-3">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ isset($singleData['date']) ? $singleData['date'] : date('Y-m-d') }}" required>
                            @error('date')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        

                        <div class="col-md-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{isset($singleData['name']) ? $singleData['name'] : ''}}" required>
                            @error('name')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{isset($singleData['email']) ? $singleData['email'] : ''}}">
                            @error('email')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{isset($singleData['phone']) ? $singleData['phone'] : ''}}">
                            @error('phone')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="address" class="form-label text-center">Address </label>
                            <input type="text" class="form-control" id="address" name="address" value="{{isset($singleData['address']) ? $singleData['address'] : ''}}" >
                        </div>                        
                        <div class="col-md-3">
                            <label for="country_id" class="form-label">Country</label>
                            <select class="form-select" id="country_id" name="country_id">
                                <option value="" {{ !isset($singleData['country_id']) ? 'selected' : '' }}>Choose...</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}" {{ isset($singleData['country_id']) && $singleData['country_id'] == $country->id ? 'selected' : ''}}>{{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="state_id" class="form-label">State</label>
                            <select class="form-select" id="state_id" name="state_id">
                                <option value="" {{ !isset($singleData['state_id']) ? 'selected' : '' }}>Choose...</option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}" {{ isset($singleData['state_id']) && $singleData['state_id'] == $state->id ? 'selected' : ''}}>{{$state->state_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="city_id" class="form-label">City</label>
                            <select class="form-select" id="city_id" name="city_id">
                                <option value="" {{ !isset($singleData['city_id']) ? 'selected' : '' }}>Choose...</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{ isset($singleData['city_id']) && $singleData['city_id'] == $city->id ? 'selected' : ''}}>{{$city->city_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="pincode" class="form-label">Pincode</label>
                            <input type="text" class="form-control" id="pincode" name="pincode" value="{{isset($singleData['pincode']) ? $singleData['pincode'] : ''}}">
                        </div>

                        <div class="col-md-3">
                            <label for="product_details" class="form-label">Product Interested In <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="product_details" name="product_details" value="{{isset($singleData['product_details']) ? $singleData['product_details'] : ''}}" required>
                            @error('product_details')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="approximate_amount" class="form-label">Approximate Amount <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="approximate_amount" name="approximate_amount" value="{{isset($singleData['approximate_amount']) ? $singleData['approximate_amount'] : ''}}" required>
                            @error('approximate_amount')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="lead_source_id" class="form-label">Lead Source  <span class="text-danger">*</span></label>
                            <select class="form-select" id="lead_source_id" name="lead_source_id">
                                <option value="" {{ !isset($singleData['lead_source_id']) || $singleData['lead_source_id'] == 'default' ? 'selected' : '' }}>Choose...</option>
                                @foreach($leadsourcestatus as $source)
                                    <option value="{{$source->id}}" {{ isset($singleData['lead_source_id']) && $singleData['lead_source_id'] == $source->id ? 'selected' : ''}}>{{$source->lead_source_name}}</option>
                                @endforeach
                            </select>
                            
                            @error('lead_source_id')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="lead_status_id" class="form-label">Lead Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="lead_status_id" name="lead_status_id">
                                <option value="" {{ !isset($singleData['lead_status_id']) ? 'selected' : '' }}>Choose...</option>
                                @foreach($leadstatus as $status)
                                    <option value="{{$status->id}}" {{ isset($singleData['lead_status_id']) && $singleData['lead_status_id'] == $status->id ? 'selected' : ''}}>{{$status->lead_status_name}}</option>
                                @endforeach
                            </select>
                            @error('lead_status_id')
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
<script type="text/javascript" src="{{url('public/validations/lead.js')}}"></script>

@endsection
