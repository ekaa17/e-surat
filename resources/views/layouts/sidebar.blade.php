<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between logo-adjust"style="gap: 0;">
        <img src="../../assets/img/logo/Logo.png" class="dark-logo" width="150" alt="" />
    </div>
    
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar>
      <ul id="sidebarnav">
        <!-- ============================= -->
        <!-- Home -->
        <!-- ============================= -->
        <li class="nav-small-cap d-flex align-items-center"style="margin: 0; padding: 15;">
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
            <span class="hide-menu">Data Akun</span>
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
            <span class="hide-menu">Data Supplier</span>
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
            <span class="hide-menu">Data Klien</span>
          </a>
        </li>
        @else
        @endif
        <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
            <span>
              <i class="bi bi-folder"></i>
            </span>
            <span class="hide-menu">E-Surat</span>
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
            <li class="sidebar-item">
              <a href="./data-kwitansi" class="sidebar-link">
                <span>
                  <i class="bi bi-file-earmark"></i>
                </span>
                <span class="hide-menu">Data Kwitansi</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
            <span>
              <i class="bi bi-file-earmark-bar-graph"></i>
            </span>
            <span class="hide-menu">Report E-Surat</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
           
            <li class="sidebar-item">
              <a href="./laporan_PH" class="sidebar-link">
                <span>
                  <i class="bi bi-file-earmark"></i>
                </span>
                <span class="hide-menu">Report Penawaran Harga</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="/laporan_PO" class="sidebar-link">
                <span>
                  <i class="bi bi-file-earmark"></i>
                </span>
                <span class="hide-menu">Report Purchase Order</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="./laporan_Invoice" class="sidebar-link">
                <span>
                  <i class="bi bi-file-earmark"></i>
                </span>
                <span class="hide-menu">Report Invoice</span>
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