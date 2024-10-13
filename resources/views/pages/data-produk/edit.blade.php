@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Edit Staff</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('data-staff.index') }}">Staff</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <form action="{{ route('data-produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- To send a PUT request for updating -->

                            <div class="form-group p-2">
                                <label for="nama_produk">Nama Produk</label>
                                <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="{{ old('nama_produk', $product->nama_produk) }}" placeholder="Masukkan nama produk" required>
                            </div>
                        
                            <div class="form-group p-2">
                                <label for="alamat_perusahaan">Alamat Perusahaan</label>
                                <input type="text" name="alamat_perusahaan" id="alamat_perusahaan" class="form-control" value="{{ old('alamat_perusahaan', $product->alamat_perusahaan) }}" placeholder="Masukkan alamat perusahaan" required>
                            </div>
                        
                            <div class="form-group p-2">
                                <label for="harga_produk">Harga Produk</label>
                                <input type="number" name="harga_produk" id="harga_produk" class="form-control" value="{{ old('harga_produk', $product->harga_produk) }}" placeholder="Masukkan harga produk" required>
                            </div>

                            <div class="form-group p-2">
                                <label for="id_perusahaan">Perusahaan</label>
                                <select name="id_perusahaan" id="id_perusahaan" class="form-control" required>
                                    <option value="" disabled>Pilih perusahaan</option>
                                    @foreach ($perusahaans as $perusahaan)
                                        <option value="{{ $perusahaan->id }}" {{ old('id_perusahaan', $product->id_perusahaan) == $perusahaan->id ? 'selected' : '' }}>
                                            {{ $perusahaan->nama_perusahaan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group p-2">
                                <label for="description">Deskripsi Produk</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Deskripsi produk" rows="3" required>{{ old('description', $product->description) }}</textarea>
                            </div>
                        
                            <div class="form-group p-2">
                                <label for="unit">Unit</label>
                                <input type="text" name="unit" id="unit" class="form-control" value="{{ old('unit', $product->unit) }}" placeholder="Unit produk (misal: kg, liter)" required>
                            </div>

                            <div class="m-2 d-flex justify-content-between align-items-center">
                                <a href="{{ route('data-produk.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
