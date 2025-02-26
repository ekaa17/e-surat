@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Jabatan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Data Jabatan</li>
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
                            <h5 class="card-title">Total :{{ $Jabatan }} Jabatan</h5>
                            <!-- Button untuk modal create -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                <i class="fas fa-plus fa-sm text-white-50"></i> Data Baru
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable" id="pegawai">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama_jabatan }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $item->id }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            <!-- Tombol Hapus -->
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $item->id }}">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Data Jabatan -->
                                    <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel-{{ $item->id }}">Edit Data Jabatan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('data-jabatan.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="nama_jabatan" class="form-label">Jabatan</label>
                                                            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="{{ $item->nama_jabatan }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Edit Data Jabatan -->

                                    <!-- Modal Hapus Data Jabatan -->
                                    <div class="modal fade" id="deleteModal-{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel-{{ $item->id }}">Hapus Data Jabatan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus jabatan <strong>{{ $item->nama_jabatan }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('data-jabatan.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Hapus Data Jabatan -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal Create Data Jabatan -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Data Jabatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('data-jabatan.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Create Data Jabatan -->

    </section>
@endsection
