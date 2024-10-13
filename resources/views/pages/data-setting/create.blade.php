@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Tambah Staff</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('data-staff.index') }}">Staff</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <form action="{{ route('data-setting.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_perusahaan">Nama Perusahaan</label>
                                <input type="text" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan') }}" required>
                            </div>
            
                            <div class="form-group">
                                <label for="bidang">Bidang</label>
                                <input type="text" name="bidang" class="form-control" value="{{ old('bidang') }}" required>
                            </div>
            
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}" required>
                            </div>
            
                            <div class="form-group">
                                <label for="no_telpon">No Telpon</label>
                                <input type="text" name="no_telpon" class="form-control" value="{{ old('no_telpon') }}" required>
                            </div>
            
                            <div class="form-group">
                                <label for="fax">Fax</label>
                                <input type="text" name="fax" class="form-control" value="{{ old('fax') }}">
                            </div>
            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
            
                            <div class="form-group">
                                <label for="no_rek">No Rekening</label>
                                <input type="text" name="no_rek" class="form-control" value="{{ old('no_rek') }}" required>
                            </div>
            
                            <div class="form-group">
                                <label for="jenis_bank">Jenis Bank</label>
                                <input type="text" name="jenis_bank" class="form-control" value="{{ old('jenis_bank') }}" required>
                            </div>
            
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" name="logo" class="form-control">
                            </div>
            
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection