<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="./index.html" class="text-nowrap logo-img">
        <img src="../../assets/img/profile/Logo.jpg" class="dark-logo" width="130" alt="" />
        {{-- <img src="../../dist/images/logos/light-logo.svg" class="light-logo"  width="180" alt="" /> --}}
      </a>
      <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8 text-muted"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar>
      <ul id="sidebarnav">
        <!-- ============================= -->
        <!-- Home -->
        <!-- ============================= -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <!-- =================== -->
        <!-- Dashboard -->
        <!-- =================== -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="./dashboard" aria-expanded="false">
            <span>
              <i class="bi bi-speedometer2"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./data-staff" aria-expanded="false">
            <span>
              <i class="bi-person-circle"></i>
            </span>
            <span class="hide-menu">Data Karyawan</span>
          </a>
        </li>
        @if (auth()->user()->role == 'Admin')
        <li class="sidebar-item">
          <a class="sidebar-link" href="./data-jabatan" aria-expanded="false">
            <span>
              <i class="bi-table"></i>
            </span>
            <span class="hide-menu">Data Jabatan</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./data-perusahaan" aria-expanded="false">
            <span>
              <i class="bi-building"></i>
            </span>
            <span class="hide-menu">Data Perusahaan</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./data-produk" aria-expanded="false">
            <span>
              <i class="bi bi-cart"></i>
            </span>
            <span class="hide-menu">Data Product</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./data-pemesan" aria-expanded="false">
            <span>
              <i class="bi-person-fill"></i>
            </span>
            <span class="hide-menu">Data Pemesan</span>
          </a>
        </li>
        @else
        @endif
        <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
            <span>
              <i class="bi bi-folder"></i>
            </span>
            <span class="hide-menu">Data Dokumen</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="./data-PH" class="sidebar-link">
                <span>
                  <i class="bi bi-file-earmark"></i>
                </span>
                <span class="hide-menu">Data Penawaran Harga</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="./data-PO" class="sidebar-link">
                <span>
                  <i class="bi bi-file-earmark"></i>
                </span>
                <span class="hide-menu">Data Pree Order</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="./data-invoice" class="sidebar-link">
                <span>
                  <i class="bi bi-file-earmark"></i>
                </span>
                <span class="hide-menu">Data Invoice</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a href="./data-setting" class="sidebar-link">
            <span>
              <i class="bi bi-gear"></i>
            </span>
            <span class="hide-menu">Bagian Seting</span>
          </a>
        </li>
  </div>
  <!-- End Sidebar scroll-->
</aside>