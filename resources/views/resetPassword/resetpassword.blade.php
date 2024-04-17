<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href="" />
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8" />
    <meta name="description" content="@yield('title')" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="canonical" href="#" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="public/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="public/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="public/assets/css/toastr.css" rel="stylesheet" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .capital-word {
            text-transform: uppercase;
        }
        .error{
            color: red;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_app_body" data-kt-app-layout="dark-header" data-kt-app-header-fixed="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::App-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10 mt-0">
            <!--begin::Col-->
            <div class="col-md-12">
                <!--begin::Table widget 1-->
                <div class="card card-flush mb-xxl-10">
                    <!--begin::Body-->
                    {{--  {{$url}}  --}}
                    <!--end: Card Body-->
                </div>
                <!--end::Table widget 1-->
                <div class="card card-flush mb-xxl-10 mt-5">
                    <!--begin::Body-->
                    <div class="card-body p-9">
                        <form class="row g-3 pt-3" name="reset_password_form" id="reset_password_form" novalidate="novalidate" method="post" action="{{ route('password.update', ['id' => $user->id]) }}">
                            @csrf
                            <div class="col-md-7">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" id="current_password" name="current_password" class="form-control">
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-7">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" id="new_password" name="new_password" class="form-control">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-7">
                                <label for="new_confirm_password" class="form-label">Confirm New Password</label>
                                <input type="password" id="new_confirm_password" name="new_confirm_password" class="form-control">
                                @error('new_confirm_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-10">
                                <button type="submit" id="reset_password" class="btn btn-primary">Reset Password</button>
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
    <!--end::App-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->
    <!--begin::Javascript-->
    <script src="public/assets/js/scripts.bundle.js"></script>
    <!--end::Javascript-->
    <script type="text/javascript" src="public/assets/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{asset('validation/forgotpassword.js')}}"></script>

</body>
<!--end::Body-->
</html>
