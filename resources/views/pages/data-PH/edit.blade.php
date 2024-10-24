@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Edit Data Penawaran Harga</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('data-PH.index') }}">Data Penawaran Harga</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">

                        <!-- Form Edit -->
                        <form action="{{ route('data-PH.update', $penawaran->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-3">
                                <label for="id_pemesan" class="col-md-4 col-lg-3 col-form-label">Pemesan</label>
                                <div class="col-md-8 col-lg-9">
                                    <select name="id_pemesan" id="id_pemesan" class="form-control @error('id_pemesan') is-invalid @enderror" required>
                                        <option value="">Pilih Pemesan</option>
                                        @foreach($pemesan as $p)
                                            <option value="{{ $p->id }}" {{ $penawaran->id_pemesan == $p->id ? 'selected' : '' }}>
                                                {{ $p->nama_pemesan }}
                                            </option>
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
                                <label for="no_surat" class="col-md-4 col-lg-3 col-form-label">Nomor Surat</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="text" class="form-control @error('no_surat') is-invalid @enderror" id="no_surat" name="no_surat" value="{{ old('no_surat', $penawaran->no_surat) }}" required>
                                    @error('no_surat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('data-PH.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form><!-- End Form Edit -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
