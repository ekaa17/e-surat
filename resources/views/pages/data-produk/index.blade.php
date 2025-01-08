@extends('layouts.main')

@section('content')
<div class="pagetitle">
    <h1>Data Produk</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Data Produk</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-xl-12">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <h5 class="card-title">Total Produk: {{ $produks->count() }}</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModalProduk">
                            <i class="bi bi-plus"></i> Tambah Produk
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Produk</th>
                                    <th>Alamat Perusahaan</th>
                                    <th>Harga</th>
                                    <th>Perusahaan</th>
                                    <th>Unit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produks as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->nama_produk }}</td>
                                        <td>{{ $produk->alamat_perusahaan }}</td>
                                        <td>{{ $produk->harga_produk }}</td>
                                        <td>{{ $produk->perusahaan->nama_perusahaan ?? '-' }}</td>
                                        <td>{{ $produk->unit }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $produk->id }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            <!-- Tombol Hapus -->
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $produk->id }}">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal{{ $produk->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $produk->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Produk</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('data-produk.update', $produk->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="nama_produk" class="form-label">Nama Produk</label>
                                                            <input type="text" class="form-control" name="nama_produk" value="{{ $produk->nama_produk }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="alamat_perusahaan" class="form-label">Alamat Perusahaan</label>
                                                            <input type="text" class="form-control" name="alamat_perusahaan" value="{{ $produk->alamat_perusahaan }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harga_produk" class="form-label">Harga</label>
                                                            <input type="number" class="form-control" name="harga_produk" value="{{ $produk->harga_produk }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="id_perusahaan" class="form-label">Perusahaan</label>
                                                            <select class="form-select" name="id_perusahaan" required>
                                                                @foreach ($perusahaans as $perusahaan)
                                                                    <option value="{{ $perusahaan->id }}" {{ $perusahaan->id == $produk->id_perusahaan ? 'selected' : '' }}>
                                                                        {{ $perusahaan->nama_perusahaan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="unit" class="form-label">Unit</label>
                                                            <input type="text" class="form-control" name="unit" value="{{ $produk->unit }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="description" class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" name="description" rows="3">{{ $produk->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="deleteModal{{ $produk->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $produk->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Hapus Produk</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus produk <strong>{{ $produk->nama_produk }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('data-produk.destroy', $produk->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah -->
<div class="modal fade" id="createModalProduk" tabindex="-1" aria-labelledby="createModalLabelProduk" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('data-produk.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_perusahaan" class="form-label">Alamat Perusahaan</label>
                        <input type="text" class="form-control" name="alamat_perusahaan" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_produk" class="form-label">Harga Produk</label>
                        <input type="number" class="form-control" name="harga_produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_perusahaan" class="form-label">Perusahaan</label>
                        <select class="form-select" name="id_perusahaan" required>
                            <option disabled selected>Pilih Perusahaan</option>
                            @foreach ($perusahaans as $perusahaan)
                                <option value="{{ $perusahaan->id }}">{{ $perusahaan->nama_perusahaan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" class="form-control" name="unit" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
