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
                        <div class="d-flex align-items-center justify-content-between flex-wrap mb-3">
                            <h5 class="card-title">Total: Surat report PH</h5>
                            
                            <div class="d-flex flex-wrap gap-2 align-items-end">
                                <form action="/laporan_PH" method="GET" class="d-flex flex-wrap align-items-end gap-2">
                                    <div class="form-group">
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
                    
                                    <div class="form-group">
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
                    
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-filter"></i>
                                        </button>
                                </form>
                    
                                <a href="{{ route('laporan_PH', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" 
                                    class="btn btn-success " target="_blank">
                                    <i class="bi bi-printer"></i> Cetak
                                </a>
                            </div>
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
