@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data report PO</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Data report PO</li>
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
                            <form action="/laporan_PO" method="GET" class="mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="bulan" class="form-label">Pilih Bulan</label>
                                        <select name="bulan" id="bulan" class="form-control">
                                            <option value="">-- Semua Bulan --</option>
                                            @for($m = 1; $m <= 12; $m++)
                                                <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tahun" class="form-label">Pilih Tahun</label>
                                        <select name="tahun" id="tahun" class="form-control">
                                            <option value="">-- Semua Tahun --</option>
                                            @for($y = now()->year; $y >= now()->year - 5; $y--)
                                                <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                                    {{ $y }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form><a href="{{ route('laporan_PO', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" 
                                class="btn btn-primary" 
                                target="_blank">
                                Cetak
                             </a> 
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nomor Surat</th>
                                        <th>Lokasi Gudang</th>
                                        <th>Nama Perusahaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $PO)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($PO->created_at)->format('d/m/Y') }}</td>
                                        <td>{{ $PO->nomor_surat }}</td>
                                        <td>{{ $PO->lokasi_gudang }}</td>
                                        <td>{{ $PO->perusahaan->nama_perusahaan }}</td>
                                        
                                      
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
