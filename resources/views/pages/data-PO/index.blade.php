@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Penawaran Order</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Data Penawaran Order</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

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
                            <h5 class="card-title">Total :  Surat</h5>
                            <a href="{{ route('data-PO.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus"></i> Data Baru
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable" id="pegawai">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Purchase No</th>
                                        <th>Nama PT</th>
                                        <th>Alamat Kirim</th>
                                        <th>Quantity</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah Amount</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($penawaranOrders as $penawaranOrder)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $penawaranOrder->purchase_no }}</td>
                                            <td>{{ $penawaranOrder->nama_perusahaan }}</td>
                                            <td>{{ $penawaranOrder->Alamat_kirim }}</td>
                                            <td>{{ $penawaranOrder->quantity }}</td>
                                            <td>{{ $penawaranOrder->harga_satuan }}</td>
                                            <td>{{ $penawaranOrder->jumlah_amount }}</td>
                                            <td>
                                                <a href="{{ route('data-PO.edit', $penawaranOrder->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <form action="{{ route('data-PO.destroy', $penawaranOrder->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data penawaran order.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
