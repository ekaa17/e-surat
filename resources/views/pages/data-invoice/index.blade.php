@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Invoice</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Data Invoice Belum Jadi</li>
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
                            @if (auth()->user()->role == 'Admin')
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                <i class="bi bi-plus"></i> Data Baru
                            </button>
                            @else
                            @endif
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat</th>
                                        <th>Id Penawaran</th>
                                        <th>Id Order</th>
                                        <th>Status</th>
                                        <th>Bukti Transaksi</th>
                                        @if (auth()->user()->role == 'Admin')
                                            <th>Data</th>
                                            <th>Actions</th>
                                        @else
                                        <th>
                                            Unduh Surat
                                        </th>
                                        @endif
                                    </tr>
                                </thead>
                              
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Data Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('data-invoice.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="no_surat" class="form-label">No Surat</label>
                        <input type="text" class="form-control" id="no_surat" name="no_surat" required>
                    </div>
                    <!-- Pemesan -->
                    <div class="row mb-3">
                        <label for="id_penawaran" class="col-md-4 col-lg-3 col-form-label">Penawaran</label>
                        <div class="col-md-8 col-lg-9">
                            <select name="id_penawaran" id="id_penawaran" class="form-control @error('id_penawaran') is-invalid @enderror">
                                <option value="">Pilih Penawaran</option>
                                @foreach($penawaran as $p)
                                    <option value="{{ $p->id }}" {{ old('id_penawaran') == $p->id ? 'selected' : '' }}>{{ $p->no_surat }}</option>
                                @endforeach
                            </select>
                            @error('id_penawaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="id_order" class="col-md-4 col-lg-3 col-form-label">ID Order</label>
                        <div class="col-md-8 col-lg-9">
                            <select name="id_order" id="id_order" class="form-control @error('id_order') is-invalid @enderror">
                                <option value="">Pilih Order</option>
                                @foreach($orders as $p)
                                    <option value="{{ $p->id }}" {{ old('id_order') == $p->id ? 'selected' : '' }}>{{ $p->nomor_surat }}</option>
                                @endforeach
                            </select>
                            @error('id_order')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bukti_transaksi" class="form-label">Bukti Transaksi</label>
                        <input type="file" class="form-control" id="bukti_transaksi" name="bukti_transaksi" accept=".jpg, .jpeg, .png, .pdf">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
