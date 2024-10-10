<aside class="left-sidebar">
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="{{ url('/') }}" class="text-nowrap logo-img">
        <img src="{{ asset('assets/images/logos/logoicon.png') }}" width="180" alt="Logo" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>

    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ url('/dashboard') }}" aria-expanded="false">
            <span><i class="ti ti-layout-dashboard"></i></span>
            <span class="hide-menu">Dashboard</span>
          </a>
          @if (auth()->user()->role == 'Admin')
          <a class="sidebar-link" href="{{ url('/data-staff') }}" aria-expanded="false">
            <span><i class="ti ti-user"></i></span>
            <span class="hide-menu">Data Karyawan</span>
          </a>
          @endif
          <a class="sidebar-link dropdown-toggle" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="ti ti-mail"></i> Menu Surat
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="{{ url('/data-PO') }}">Penawaran Order</a></li>
            <li><a class="dropdown-item" href="{{ url('/data-invoice') }}">Invoice</a></li>
            <li><a class="dropdown-item" href="{{ url('/data-PH') }}">Penawaran Harga</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>
