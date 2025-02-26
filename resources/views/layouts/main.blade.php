<!doctype html>
<html lang="en">

<head>
  <!--  Title -->
  <title>PT.Indokarya Jasa Prima</title>
  <!--  Required Meta Tag -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="handheldfriendly" content="true" />
  <meta name="MobileOptimized" content="width" />
  <meta name="description" content="Mordenize" />
  <meta name="author" content="" />
  <meta name="keywords" content="Mordenize" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!--  Favicon -->
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/profile/Logo.jpg') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Owl Carousel  -->
  <link rel="stylesheet" href="../../dist/libs/owl.carousel/dist/assets/owl.carousel.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <!-- Core Css -->
  <link  id="themeColors"  rel="stylesheet" href="../../dist/css/style.min.css" />
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="body-wrapper">
      
      <!-- Header -->
      @include('layouts.header')
      
      <!-- Content -->
      <div class="container-fluid">
        @yield('content')
      </div>

      <!-- Footer -->
      @include('layouts.footer')

    </div>
  </div>
    <!--  Customizer -->
    <button class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
      <i class="ti ti-settings fs-7" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Settings"></i>
    </button>
    <div class="offcanvas offcanvas-end customizer" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" data-simplebar="">
      <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
        <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">Settings</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body p-4">
        <div class="theme-option pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Theme Option</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <a href="javascript:void(0)"  onclick="toggleTheme('../../dist/css/style.min.css')"  class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 light-theme text-dark">
              <i class="ti ti-brightness-up fs-7 text-primary"></i>
              <span class="text-dark">Light</span>
            </a>
            <a href="javascript:void(0)" onclick="toggleTheme('../../dist/css/style-dark.min.css')" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 dark-theme text-dark">
              <i class="ti ti-moon fs-7 "></i>
              <span class="text-dark">Dark</span>
            </a>
          </div>
        </div>
        <div class="theme-direction pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Theme Direction</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <a href="./index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
              <i class="ti ti-text-direction-ltr fs-6 text-primary"></i>
              <span class="text-dark">LTR</span>
            </a>
            <a href="../rtl/index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
              <i class="ti ti-text-direction-rtl fs-6 text-dark"></i>
              <span class="text-dark">RTL</span>
            </a>
          </div>
        </div>
        <div class="theme-colors pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Theme Colors</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <ul class="list-unstyled mb-0 d-flex gap-3 flex-wrap change-colors">
              <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                <a href="javascript:void(0)" class="rounded-circle position-relative d-block customizer-bgcolor skin1-bluetheme-primary active-theme " onclick="toggleTheme('../../dist/css/style.min.css')"  data-color="blue_theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="BLUE_THEME"><i class="ti ti-check text-white d-flex align-items-center justify-content-center fs-5"></i></a>
              </li>
              <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                <a href="javascript:void(0)"  class="rounded-circle position-relative d-block customizer-bgcolor skin2-aquatheme-primary " onclick="toggleTheme('../../dist/css/style-aqua.min.css')"  data-color="aqua_theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="AQUA_THEME"><i class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
              </li>
              <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                <a href="javascript:void(0)" class="rounded-circle position-relative d-block customizer-bgcolor skin3-purpletheme-primary" onclick="toggleTheme('../../dist/css/style-purple.min.css')"  data-color="purple_theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="PURPLE_THEME"><i class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
              </li>
              <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                <a href="javascript:void(0)" class="rounded-circle position-relative d-block customizer-bgcolor skin4-greentheme-primary" onclick="toggleTheme('../../dist/css/style-green.min.css')"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="GREEN_THEME"><i class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
              </li>
              <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                <a href="javascript:void(0)" class="rounded-circle position-relative d-block customizer-bgcolor skin5-cyantheme-primary" onclick="toggleTheme('../../dist/css/style-cyan.min.css')"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="CYAN_THEME"><i class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
              </li>
              <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                <a href="javascript:void(0)" class="rounded-circle position-relative d-block customizer-bgcolor skin6-orangetheme-primary" onclick="toggleTheme('../../dist/css/style-orange.min.css')"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ORANGE_THEME"><i class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="layout-type pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Layout Type</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <a href="./index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">              
              <i class="ti ti-layout-sidebar fs-6 text-primary"></i>
              <span class="text-dark">Vertical</span>
            </a>
            <a href="../horizontal/index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
              <i class="ti ti-layout-navbar fs-6 text-dark"></i>
              <span class="text-dark">Horizontal</span>
            </a>
          </div>
        </div>
        <div class="container-option pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Container Option</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <a href="javascript:void(0)" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 boxed-width text-dark">              
              <i class="ti ti-layout-distribute-vertical fs-7 text-primary"></i>
              <span class="text-dark">Boxed</span>
            </a>
            <a href="javascript:void(0)" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 full-width text-dark">
              <i class="ti ti-layout-distribute-horizontal fs-7"></i>
              <span class="text-dark">Full</span>
            </a>
          </div>
        </div>
        <div class="sidebar-type pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Sidebar Type</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <a  href="javascript:void(0)" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 fullsidebar">              
              <i class="ti ti-layout-sidebar-right fs-7"></i>
              <span class="text-dark">Full</span>
            </a>
            <a  href="javascript:void(0)" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center text-dark sidebartoggler gap-2">
              <i class="ti ti-layout-sidebar fs-7"></i>
              <span class="text-dark">Collapse</span>
            </a>
          </div>
        </div>
        <div class="card-with pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Card With</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <a href="javascript:void(0)" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 text-dark cardborder">              
              <i class="ti ti-border-outer fs-7"></i>
              <span class="text-dark">Border</span>
            </a>
            <a href="javascript:void(0)" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 cardshadow">
              <i class="ti ti-border-none fs-7"></i>
              <span class="text-dark">Shadow</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <!--  Customizer -->

  <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--  core files -->
  <script src="../../dist/js/app.min.js"></script>
  <script src="../../dist/js/app.init.js"></script>
  <script src="../../dist/js/app-style-switcher.js"></script>
  <script src="../../dist/js/sidebarmenu.js"></script>
  <script src="../../dist/js/custom.js"></script>
  <!--  current page js files -->
  <script src="../../dist/libs/owl.carousel/dist/owl.carousel.min.js"></script>
  <script src="../../dist/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../../dist/js/dashboard.js"></script>
</body>

</html>
