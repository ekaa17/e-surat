@extends('layouts.main')

@section('title', 'PT.INDOKARYA JASA PRIMA')

@section('content')
<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body row justify-content-center text-center m-2">
        <img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid w-50 mt-3">
        <h6>SELAMAT DATANG <br> DI <br> E-SURAT</h6>
        <h4>PT.INDOKARYA JASA PRIMA</h4>
      </div>
    </div>
  </div>
</div>
<div class="row">
    
  <!-- GuruCard -->
  <div class="col-xxl-3 col-md-6">
    <div class="card info-card sales-card">

      <div class="card-body">
        <h5 class="card-title">Total Staff</h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-person-badge-fill"></i>
          </div>
          <div class="ps-3">
            <h6> {{ $total_staff }} </h6>
          </div>
        </div>
      </div>

    </div>
  </div><!-- End GuruCard -->

  <!-- Siswa Card -->
  <div class="col-xxl-3 col-md-6">
    <div class="card info-card revenue-card">

      <div class="card-body">
        <h5 class="card-title"> Total Penawaran Order </h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-people-fill"></i>
          </div>
          <div class="ps-3">
            <h6> {{ $total_PO }} </h6>
          </div>
        </div>
      </div>

    </div>
  </div><!-- End Siswa Card -->

  <!-- Mapel Card -->
  <div class="col-xxl-3 col-md-6">

    <div class="card info-card customers-card">

      <div class="card-body">
        <h5 class="card-title"> Total Penawaran Invoice </h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-book"></i>
          </div>
          <div class="ps-3">
            <h6>{{ $total_invoice }}  </h6>
          </div>
        </div>

      </div>
    </div>

  </div><!-- End Mapel Card -->
  
  <!-- Jurusan Card -->
  <div class="col-xxl-3 col-md-6">

    <div class="card info-card customers-card">

      <div class="card-body">
        <h5 class="card-title"> Total Penawaran Harga </h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-bookmark"></i>
          </div>
          <div class="ps-3">
            <h6>  </h6>
          </div>
        </div>

      </div>
    </div>

  </div><!-- End Jurusan Card -->

</div>
</section>
@endsection
