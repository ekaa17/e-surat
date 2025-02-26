@extends('layouts.main')

@section('content')

          <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            </nav>
          </div><!-- End Page Title -->

          <div class="row">
            <div class="col-lg-12">
                <div class="row justify-content-center">
                    <!-- Card -->
                    <div class="col-lg-8">

                        <div class="card">
                            <div class="card-body row justify-content-center text-center m-2">
                                <img src="{{ asset('assets/img/profile/Logo.jpg') }}" alt="" class="img-fluid w-50 mt-3">
                                <h5> SELAMAT DATANG <br> DI <br> E-SURAT </h5>
                                <h4> PT.INDOKARYA JASA PRIMA </h4>
                            </div>
                        </div>

                    </div><!-- End Card -->
                </div>
            </div>
          </div>
          <!--  Owl carousel -->
          <div class="owl-carousel counter-carousel owl-theme">
            <div class="item">
              <div class="card border-0 zoom-in bg-light-info shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <img src="../../dist/images/svgs/icon-dd-invoice.svg" width="50" height="50" class="mb-3" alt="" />
                    <p class="fw-semibold fs-3 text-info mb-1">Surat Invoice</p>
                    <h5 class="fw-semibold text-info mb-0">{{$total_invoice}}</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-light-info shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <img src="../../dist/images/svgs/icon-dd-cart.svg" width="50" height="50" class="mb-3" alt="" />
                    <p class="fw-semibold fs-3 text-info mb-1">Surat PO</p>
                    <h5 class="fw-semibold text-info mb-0">{{$total_PO}}</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-light-info shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <img src="../../dist/images/svgs/icon-credit-card.svg" width="50" height="50" class="mb-3" alt="" />
                    <p class="fw-semibold fs-3 text-info mb-1">Surat Kwitansi</p>
                    <h5 class="fw-semibold text-info mb-0">{{$kwitansicount}}</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-light-info shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <img src="../../dist/images/svgs/icon-office-bag-2.svg" width="50" height="50" class="mb-3" alt="" />
                    <p class="fw-semibold fs-3 text-info mb-1">Surat PH</p>
                    <h5 class="fw-semibold text-info mb-0">{{$total_PH}}</h5>
                  </div>
                </div>
              </div>
            </div>
              <div class="item">
                <div class="card border-0 zoom-in bg-light-warning shadow-none">
                  <div class="card-body">
                    <div class="text-center">
                      <img src="../../dist/images/svgs/icon-briefcase.svg" width="50" height="50" class="mb-3" alt="" />
                      <p class="fw-semibold fs-3 text-warning mb-1">Klien</p>
                      <h5 class="fw-semibold text-warning mb-0">{{ $total_pemesan }}</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="card border-0 zoom-in bg-light-info shadow-none">
                  <div class="card-body">
                    <div class="text-center">
                      <img src="../../dist/images/svgs/icon-mailbox.svg" width="50" height="50" class="mb-3" alt="" />
                      <p class="fw-semibold fs-3 text-info mb-1">Supplier</p>
                      <h5 class="fw-semibold text-info mb-0">{{$total_perusahaan}}</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="card border-0 zoom-in bg-light-primary shadow-none">
                  <div class="card-body">
                    <div class="text-center">
                      <img src="../../dist/images/svgs/icon-account.svg" width="50" height="50" class="mb-3" alt="" />
                      <p class="fw-semibold fs-3 text-primary mb-1"> Data Karyawan </p>
                      <h5 class="fw-semibold text-primary mb-0">{{ $total_staff }}</h5>
                    </div>
                  </div>
                </div>
              </div>
          </div>

          
          @endsection
 