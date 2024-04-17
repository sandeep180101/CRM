<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CRM</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ ASSETS }}/img/favicon.png" rel="icon">
  <link href="{{ ASSETS }}/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="{{ ASSETS }}/img/favicon.png" rel="icon">
  <link href="{{ ASSETS }}/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{ ASSETS }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ ASSETS }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ ASSETS }}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ ASSETS }}/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{ ASSETS }}/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{ ASSETS }}/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ ASSETS }}/vendor/simple-datatables/style.css" rel="stylesheet">  
  <!-- Template Main CSS File -->
  <link href="{{ ASSETS }}/css/style.css" rel="stylesheet">
  <link href="{{ ASSETS }}/css/custom.css" rel="stylesheet">
   <!-- searchable dropdown -->
   <link href="{{ ASSETS }}/css/jquery.dropdownsearchlist.css" rel="stylesheet">
   <link href="test/fstdropdown.css" rel="stylesheet">
   <link href="test/fstdropdown.min.css" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
   <style>
    .error{
      color: red;
    }
   </style>
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="{{ ASSETS }}/img/crm_1548182.png" alt="">
                  <span class="d-none d-lg-block">CRM</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3 w-100">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Forgot/Reset Password</h5>
                  </div>


<!--begin::Form-->
<form class="form w-100" novalidate id="forgot_password_form" name="forgot_password_form" method="post" action="{{ url()->current() }}">

      @csrf
      								<!--begin::Heading-->
                                      <div class="text-center mb-11">
                                        <!--begin::Title-->
                                        <h1 class="text-dark fw-bolder mb-3">Email</h1>
                                        <!--end::Title-->
                                    </div>
                                    <!--begin::Heading-->
                                    <!--begin::Input group=-->
                                     <div class="fv-row mb-8">
                                  <input type="email" placeholder="Email Id" name="contact_email" id="contact_email" autocomplete="off" class="form-control bg-transparent hitenter @error('contact_email') is-invalid @enderror"/>
                                  
                                  <!-- Display validation error for email -->
                                  @error('contact_email')
                                     <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                     </div>
                                  @enderror
                            </div>
                            <br>
                           @if(Session::has('success'))
                               <div class="alert alert-success" role="alert">
                                  {{ Session::get('success') }}
                               </div>
                            @else
                            <div class="col-12 text-center">
                              <button class="btn btn-primary" type="submit">Send Link</button>
                              </div>
                            @endif
                                    <!--end::Submit button-->
    </div>
</form>
</div>
<!--end::Wrapper-->
</div>
<!--end::Card-->
</div>
<!--end::Body-->
</div>
<!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->

    <!--begin::Javascript-->
    <script>var hostUrl = "/assets/";</script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="/assets/plugins/global/plugins.bundle.js"></script>
    <script src="/assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>

    <script type="text/javascript" src="/assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/assets/js/additional-methods.min.js"></script>
    <script type="text/javascript" src="/validations/common.js"></script>
    <script type="text/javascript"
            src="/assets/js/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{url('public/validations/forgotpassword.js')}}"></script>

</body>
</html>
