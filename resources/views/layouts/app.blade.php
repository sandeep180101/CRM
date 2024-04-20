<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{$title}}</title>
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
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
   {{-- <script type="text/javascript" src="{{ url('public/assets/js/toastr.min.js') }}" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

   <style>
    .error{
      color: red;
    }
   </style>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{ ASSETS }}/img/logo.png" alt="">
        <span class="d-none d-lg-block">CRM</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <div class="flex mt-2">
        <div class="heading1">
          <h5>Lead </h5>
        </div>
        <div class="flex mt-1"><i class="bi bi-arrow-right-short"></i></div>
        <div class="heading2 pt-1">
          <b class="text-red">{{$title}}</b>
        </div>
      </div>
    </div><!-- End Search Bar -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="message-item">
              <a href="#">
                <img src="{{ ASSETS }}/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="{{ ASSETS }}/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="{{ ASSETS }}/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->
@php

$userId = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
    $user = \App\Models\User::where('id', $userId)->select('name', 'user_type')->first();
    $name = $user->name ?? '';
    $userType = $user->user_type ?? '';
@endphp
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ ASSETS }}/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{$name}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{url('logout')}}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item pt-2">
        <a class="nav-link collapsed" href="{{url('home')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link active" href="{{url('leads')}}">
          <i class="bi bi-person-check"></i>
          <span>Lead</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('party')}}">
          <i class="bi bi-people"></i>
          <span>Customer</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('contacts')}}">
          <i class="bi bi-phone"></i>
          <span>Contact</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="quote.html">
          <i class="bi bi-card-list"></i>
          <span>Quote</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="activity.html">
          <i class="bi bi-activity"></i>
          <span>Activity</span>
        </a>
      </li>
      @if($userType == 1)
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('user')}}">
          <i class="bi bi-person"></i>
          <span>User</span>
        </a>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('master')}}">
          <i class="bi bi-gear"></i>
          <span>Setting</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
@yield('content')
  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
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
   <script type="text/javascript" src="{{url('public/validations/common.js')}}"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>

   <!-- <script src="/assets/js/bootstrap.bundal.min.js"></script> -->

</body>

</html>