@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Tambah Data Penawaran Harga</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('data-staff.index') }}">Data Penawaran Harga</a></li>
                <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Form untuk menambah data -->
                        <form action="{{ route('data-PH.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="id_pemesan" class="col-md-4 col-lg-3 col-form-label">Pemesan</label>
                                <div class="col-md-8 col-lg-9">
                                    <select name="id_pemesan" id="id_pemesan" class="form-control @error('id_pemesan') is-invalid @enderror" required>
                                        <option value="">Pilih Pemesan</option>
                                        @foreach($pemesan as $p)
                                            <option value="{{ $p->id }}" {{ old('id_pemesan') == $p->id ? 'selected' : '' }}>{{ $p->nama_pemesan }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pemesan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="id_produk" class="col-md-4 col-lg-3 col-form-label">Produk</label>
                                <div class="col-md-8 col-lg-9">
                                    <select name="id_produk" id="id_produk" class="form-control @error('id_produk') is-invalid @enderror" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach($produk as $p)
                                            <option value="{{ $p->id }}" {{ old('id_produk') == $p->id ? 'selected' : '' }}>{{ $p->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_produk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="quantity" class="col-md-4 col-lg-3 col-form-label">Quantity</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
                                    @error('quantity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="total" class="col-md-4 col-lg-3 col-form-label">Total Harga</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total" value="{{ old('total') }}" required>
                                    @error('total')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_surat" class="col-md-4 col-lg-3 col-form-label">No Surat</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="text" class="form-control @error('no_surat') is-invalid @enderror" id="no_surat" name="no_surat" value="{{ old('no_surat') }}" required>
                                    @error('no_surat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('data-staff.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form><!-- End form -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
