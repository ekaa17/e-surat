@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Perusahaan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Data Perusahaan</li>
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
                            <h5 class="card-title">Total : Perusahaan</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                <i class="bi bi-plus"></i> Data Baru
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable" id="pegawai">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Alamat Perusahaan</th>
                                        <th>No Telpon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($perusahaans as $perusahaan)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $perusahaan->nama_perusahaan }}</td>
                                            <td>{{ $perusahaan->alamat_perusahaan }}</td>
                                            <td>{{ $perusahaan->no_telpon }}</td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $perusahaan->id }}">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                            
                                                <!-- Tombol Hapus -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $perusahaan->id }}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </td>                                            
                                        </tr>
                                             <!-- Modal Edit Perusahaan -->
                                            <div class="modal fade" id="editModal{{ $perusahaan->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $perusahaan->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $perusahaan->id }}">Edit Data Perusahaan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{-- Form untuk mengedit data perusahaan --}}
                                                            <form action="{{ route('data-perusahaan.update', $perusahaan->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="nama_perusahaan{{ $perusahaan->id }}" class="form-label">Nama Perusahaan</label>
                                                                    <input type="text" class="form-control" id="nama_perusahaan{{ $perusahaan->id }}" name="nama_perusahaan" value="{{ $perusahaan->nama_perusahaan }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="alamat_perusahaan{{ $perusahaan->id }}" class="form-label">Alamat Perusahaan</label>
                                                                    <input type="text" class="form-control" id="alamat_perusahaan{{ $perusahaan->id }}" name="alamat_perusahaan" value="{{ $perusahaan->alamat_perusahaan }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="no_telpon{{ $perusahaan->id }}" class="form-label">No Telpon</label>
                                                                    <input type="text" class="form-control" id="no_telpon{{ $perusahaan->id }}" name="no_telpon" value="{{ $perusahaan->no_telpon }}" required>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal Edit Perusahaan -->
                                             <!-- Modal Hapus Perusahaan -->
                                            <div class="modal fade" id="deleteModal{{ $perusahaan->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $perusahaan->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel{{ $perusahaan->id }}">Hapus Data Perusahaan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus perusahaan <strong>{{ $perusahaan->nama_perusahaan }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('data-perusahaan.destroy', $perusahaan->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal Hapus Perusahaan -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Modal Tambah Data -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Data Perusahaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('data-perusahaan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_perusahaan" class="form-label">Alamat Perusahaan</label>
                        <input type="text" class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telpon" class="form-label">No Telpon</label>
                        <input type="text" class="form-control" id="no_telpon" name="no_telpon" required>
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

@endsection
