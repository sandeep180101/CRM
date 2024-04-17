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

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  </div>

							<!--begin::Form-->
							<form class="row g-3 needs-validation" novalidate id="login_form" name='login_form' method="post" action="{{ route('login') }}">
							    @csrf
								<div class="col-12 b">
									<label for="email" class="form-label"><strong>Email</strong></label>
									  <input type="email" name="email" class="form-control" id="email" required>
									  <div class="invalid-feedback">Please enter your email.</div>
								  </div>
			  
								  <div class="col-12 b">
									<label for="password" class="form-label"><strong>Password</strong></label>
									<input type="password" name="password" class="form-control" id="password" required>
									<div class="invalid-feedback">Please enter your password!</div>
								  </div>
			  
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8 justify-content-end">
									<a href="{{url('forgot-password')}}" class="link-primary">Forgot Password ?</a>
								</div>
								
								<?php 
                                 $value = Session::get('message');
                                 $status = Session::get('status');
                                 if(isset($value)):?>
                                    <div class="alert alert-danger" role="alert"><strong>Oh snap!</strong> <?php echo $value; ?></div>
                                 <?php endif; ?>
								 <div class="col-12">
									<button class="btn btn-primary w-100" type="submit">Login</button>
								  </div>
								{{-- <div class="col-12">
									<p class="small mb-0">Don't have account? <a href="{{url('register')}}">Create an account</a></p>
								  </div> --}}
							</form>
						</div>
					</div>
	  
				  </div>
				</div>
			  </div>
	  
			</section>
	  
		  </div>
		</main>
		{{-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> --}}
	  
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