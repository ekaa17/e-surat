@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Edit Penawaran Order</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('data-PO.index') }}">Data Penawaran Order</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('data-PO.update', $penawaranOrder->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="purchase_no" class="col-sm-2 col-form-label">Purchase No</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('purchase_no') is-invalid @enderror" name="purchase_no" value="{{ old('purchase_no', $penawaranOrder->purchase_no) }}" required>
                                    @error('purchase_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nama_perusahaan" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" name="nama_perusahaan" value="{{ old('nama_perusahaan', $penawaranOrder->nama_perusahaan) }}" required>
                                    @error('nama_perusahaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="alamat_kirim" class="col-sm-2 col-form-label">Alamat Kirim</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('alamat_kirim') is-invalid @enderror" name="alamat_kirim" value="{{ old('alamat_kirim', $penawaranOrder->Alamat_kirim) }}" required>
                                    @error('alamat_kirim')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity', $penawaranOrder->quantity) }}" required>
                                    @error('quantity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="harga_satuan" class="col-sm-2 col-form-label">Harga Satuan</label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" class="form-control @error('harga_satuan') is-invalid @enderror" name="harga_satuan" value="{{ old('harga_satuan', $penawaranOrder->harga_satuan) }}" required>
                                    @error('harga_satuan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jumlah_amount" class="col-sm-2 col-form-label">Jumlah Amount</label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" class="form-control @error('jumlah_amount') is-invalid @enderror" name="jumlah_amount" value="{{ old('jumlah_amount', $penawaranOrder->jumlah_amount) }}" required>
                                    @error('jumlah_amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('data-PO.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
