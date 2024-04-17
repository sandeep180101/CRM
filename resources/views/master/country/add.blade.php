@extends('layouts.app')
@section('title',$title) 
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <a href="{{url('countries')}}"><button class="btn btn-primary">Back</button></a>
            <br><br>
            <div class="card">
                <div class="card-body">
                    <!-- Multi Columns Form -->
                                      <form class="form" id="country_form" name="country_form">
                                        <input type="text" class="form-control" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : ''}}" hidden>
                                        <!--begin::Modal body-->
                                        <input type = "hidden" name = "_token" value = '<?php echo csrf_token(); ?>'>
                                        <div class="modal-body my-2 px-lg-17">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="name" class="form-label">Country name : </label>
                                                    <input type="text" class="form-control" id="country_name" name="country_name" value="{{isset($singleData['country_name']) ? $singleData['country_name'] : ''}}">
                                                                              @error('country_name')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>                                    
                                              <div class="col-md-12">
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
                                            <div class="d-flex justify-content-start mt-1">
                                                <button type="submit" class="btn btn-success" id="submitbutton"><i class="fa-solid fa-floppy-disk"></i>Submit</button>
                                                <button class="btn btn-success" type="button" id="display_processing" style="display:none"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...</button>&nbsp;
                                            </div>
                                        </div>
                                        <!--end::Modal body-->
                                    </form>
                                    
                </div>
            </div>


        </div>
    </div>
</section>
<script type="text/javascript"> var SITE_URL = "<?php echo config('constants.SITE_URL');?>/";</script>
<script type="text/javascript"> var ASSETS = "<?php echo config('constants.ASSETS');?>/";</script>  
<script type="text/javascript" src="{{url('public/validations/countries.js')}}"></script>
@endsection
