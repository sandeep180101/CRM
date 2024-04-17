@extends('layouts.app')
@section('title',"Contact add") 
@section('content')
<div class="app-main flex-column flex-row-fluid" id="">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Add Contact</h1>
                    </div>
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3" >
                        <a href="{{url('roles')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>Back</a>
                    </div>     
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar container-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Row-->
                    <div class="row gx-5 gx-xl-12">
                        <div class="col-xl-12">
                            <div class="card">
                                      <!--start::Form-->
                                      <form class="form" id="kt_modal_upload_form" name="contact_form">
                                        <input type="text" class="form-control" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : ''}}" hidden>
                                        <!--begin::Modal body-->
                                        <input type = "hidden" name = "_token" value = '<?php echo csrf_token(); ?>'>
                                        <div class="modal-body my-2 px-lg-17">
                                            <div class="row">
                                              <div class="col-md-12">
                                                <label for="name" class="form-label">Contact name : </label>
                                                <input type="text" class="form-control" id="contact_name" name="contact_name" value="{{isset($singleData['contact_name']) ? $singleData['contact_name'] : ''}}">
                                              </div>
                                              <div class="col-md-12">
                                                <label for="email" class="form-label">Contact Email : </label>
                                                <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{isset($singleData['contact_email']) ? $singleData['contact_email'] : ''}}">
                                              </div>
                                              <div class="col-md-12">
                                                <label for="email" class="form-label">Contact Phone : </label>
                                                <input type="tel" class="form-control" id="contact_phone" name="contact_phone" value="{{isset($singleData['contact_phone']) ? $singleData['contact_phone'] : ''}}">
                                              </div>
                                              <div class="col-md-12">
                                                <label for="message" class="form-label">Address : </label>
                                                <input type="tel" class="form-control" id="contact_address" name="contact_address" value="{{isset($singleData['contact_address']) ? $singleData['contact_address'] : ''}}">
                                              </div>
                                              <div class="col-md-12">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" id="status" aria-label="Select a Status" data-control="select2" data-placeholder="Choose..." class="form-select mb-2">
                                                    <option value="0" {{isset($singleData['status']) && $singleData['status'] == 0 ? 'selected' : ''}}>Active</option>
                                                    <option value="1" {{isset($singleData['status']) && $singleData['status'] == 1 ? 'selected' : ''}}>Inactive</option>
                                                </select>
                                              </div>
                                            <div class="d-flex justify-content-start mt-1">
                                                <button type="submit" class="btn btn-success" id="submitbutton"><i class="fa-solid fa-floppy-disk"></i>Submit</button>
                                                <button class="btn btn-success" type="button" id="display_processing" style="display:none"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...</button>&nbsp;
                                            </div>
                                        </div>
                                        <!--end::Modal body-->
                                    </form>
                                    <!--end::Form-->
                                    <!--end::Form-->
                                <!--end::Card body-->
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
<!--end:::Main-->

<script type="text/javascript"> var SITE_URL = "<?php echo config('constants.SITE_URL');?>/";</script>
<script type="text/javascript"> var ASSETS = "<?php echo config('constants.ASSETS');?>/";</script>  
<script type="text/javascript" src="{{url('public/validations/contactsc.js')}}"></script>@endsection
