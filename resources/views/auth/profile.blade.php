@extends('layouts.app')
@section('title',$title)
@section('content')
<div id="kt_app_content_container" class="app-container container-xxl">
						<!--begin::Row-->
						<div class="row gy-5 g-xl-10 mt-0">
							<!--begin::Col-->
							<div class="col-md-12">
								<!--begin::Table widget 1-->
								<div class="card card-flush mb-xxl-10">
									<!--begin::Body-->
										<div class="card-body p-9">
											<!--begin::Row-->
											<div class="row mb-7">
												<!--begin::Label-->
												<label class="col-lg-4 fw-semibold text-muted">Name</label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-8">
													<span class="fw-bold fs-6 text-gray-800">{{Session::get('name')}}</span>
												</div>
												<!--end::Col-->
											</div>
											<!--end::Row-->
										</div>
									<!--end: Card Body-->
								</div>
								<!--end::Table widget 1-->
								<div class="card card-flush mb-xxl-10 mt-5">
									<!--begin::Body-->
										<div class="card-body p-9">
											<form class="row g-3 pt-3" name="change_password_form" id="change_password_form" novalidate="novalidate" method="post">
                                            @csrf
                                            <input type="hidden" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : '' }}"> 
												<div class="col-md-7">
												  <label for="password" class="form-label">Password</label>
												  <input type="password" id="current_password" name="current_password" class="form-control">
												</div>
												<div class="col-md-7">
												  <label for="password" class="form-label">New Password</label>
												  <input type="password" id="new_password" name="new_password" class="form-control">
												</div>
												<div class="col-md-7">
												  <label for="password" class="form-label">Confirm New Password</label>
												  <input type="password" id="new_confirm_password" name="new_confirm_password" class="form-control">
												</div>
												<div class="col-md-12 mt-10"> 
													<button type="submit" id="update_password" class="btn btn-primary">Update Password</button>
												  </div>
											</form>
										</div>
									<!--end: Card Body-->
								</div>
							</div>
							<!--end::Col-->
						</div>
						<!--end::Row-->
					</div>
					<script src="{{url('public/validations/user.js')}}"></script>
@endsection