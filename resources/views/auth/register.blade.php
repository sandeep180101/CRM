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

              <div class="card mb-3 w-100" >

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  </div>

                                       <!--begin::Form-->
									   <form class="form" method="POST" action="{{ route('register') }}" name="register_form" id="register_form">
										@csrf <!-- CSRF protection -->
										<!--begin::Input group-->
										<div class="fv-row mb-3">
										   <!--begin::Name-->
										   <label for="name">Full Name</label>
										   <input type="text" placeholder="Name" name="name" id="name" value="{{ old('name') }}" autocomplete="off" class="form-control bg-transparent hitenter @error('name') is-invalid @enderror"/>
										   @error('name')
										   <div class="invalid-feedback" role="alert">
											  {{ $message }}
										   </div>
										   @enderror
										   <!--end::Name-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-3">
										   <!--begin::Email-->
										   <label for="email">Email</label>
										   <input type="email" placeholder="Email" name="email" id="email" class="form-control bg-transparent hitenter @error('name') is-invalid @enderror" value="{{ old('email') }}" />
										   @error('email')
										   <div class="invalid-feedback" role="alert">
											  {{ $message }}
										   </div>
										   @enderror
										   <!--end::Email-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-3">
										   <!--begin::Password-->
										   <label for="password">Password</label>
										   <input type="password" placeholder="Password" name="password" id="password" class="form-control bg-transparent hitenter @error('name') is-invalid @enderror"  />
										   @error('password')
										   <div class="invalid-feedback" role="alert">
											  {{ $message }}
										   </div>
										   @enderror
										   <!--end::Password-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-3">
										   <!--begin::Password Confirmation-->
										   <label for="password_confirmation">Confirm Password</label>
										   <input type="password" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" class="form-control bg-transparent hitenter @error('name') is-invalid @enderror"  />
										   @error('password_confirmation')
										   <div class="invalid-feedback" role="alert">
											  {{ $message }}
										   </div>
										   @enderror
										   <!--end::Password Confirmation-->
										</div>
										<!--end::Input group-->
										<!--begin::Action-->
										<div class="text-center">
										   <!--begin::Submit button-->
										   <button type="submit" class="btn btn-lg btn-primary">
											  <!--begin::Indicator label-->
											  <span class="indicator-label">Register</span>
										   </button>
										   <!--end::Submit button-->
										</div>
										<!--end::Action-->
									 </form>
									 <!--end::Form-->

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 <!-- Vendor JS Files -->
 <script src="{{ ASSETS }}/vendor/apexcharts/apexcharts.min.js"></script>
 <script src="{{ ASSETS }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="{{ ASSETS }}/vendor/chart.js/chart.umd.js"></script>
 <script src="{{ ASSETS }}/vendor/echarts/echarts.min.js"></script>
 <script src="{{ ASSETS }}/vendor/quill/quill.min.js"></script>
 <script src="{{ ASSETS }}/vendor/simple-datatables/simple-datatables.js"></script>
 <script src="{{ ASSETS }}/vendor/tinymce/tinymce.min.js"></script>
 <script src="{{ ASSETS }}/vendor/php-email-form/validate.js"></script>
 <!-- Template Main JS File -->
 <script src="{{ ASSETS }}/js/main.js"></script>
  <!-- searchable dropdown -->
  <script src="{{ ASSETS }}/js/jquery.dropdownsearchlist.js"></script>
  <script src="test/fstdropdown.js"></script>
  <script src="test/fstdropdown.min.js"></script>
  <!-- multiselect -->
  <script src="{{ ASSETS }}/js/multiselect.js"></script>
  <!-- <script src="{{ ASSETS }}/js/bootstrap.bundal.min.js"></script> -->
  
  <script type="text/javascript"
  src="/assets/js/toastr.min.js"
  integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{{ asset('validation/login.js') }}"></script>
</body>

</html>