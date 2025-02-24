@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data report PH</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Data report PH</li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="d-flex align-items-center justify-content-between m-3">
                            <h5 class="card-title">Total:  Surat reportPO</h5>
                            <a href="/surat_report_PH" class="btn btn-primary" target="_blank">Cetak</a> 
                           
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>NO PH</th>
                                        <th>Asal Klen</th>
                                        <th>Nama Supplier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_Harga as $penawaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($penawaran->created_at)->format('d/m/Y') }}</td>
                                        <td>{{ $penawaran->no_surat }}</td>
                                        <td>{{ $penawaran->pemesan->asal_pemesan }}</td>
                                        <td>{{ $penawaran->pemesan->nama_pemesan }}</td>
                                      
                                        <td>
                                        </td>
                                    </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
