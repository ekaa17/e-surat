@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Pemesan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Data Pemesan</li>
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
                            <h5 class="card-title">Total : Pemesan</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModalPemesan">
                                <i class="bi bi-plus"></i> Data Baru
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable" id="pegawai">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Pemesan</th>
                                        <th>Asal Pemesan</th>
                                        <th>Tanggal Pemesan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pemesans as $pemesan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pemesan->nama_pemesan }}</td>
                                            <td>{{ $pemesan->asal_pemesan }}</td>
                                            <td>{{ $pemesan->tanggal_pemesan }}</td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $pemesan->id }}">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                            
                                                <!-- Tombol Hapus -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $pemesan->id }}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </td>   
                                        </tr>
                                        <!-- Modal Edit Pemesan -->
                                        <div class="modal fade" id="editModal{{ $pemesan->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $pemesan->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $pemesan->id }}">Edit Data Pemesan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- Form untuk mengedit data pemesan --}}
                                                        <form action="{{ route('data-pemesan.update', $pemesan->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="nama_pemesan{{ $pemesan->id }}" class="form-label">Nama Pemesan</label>
                                                                <input type="text" class="form-control" id="nama_pemesan{{ $pemesan->id }}" name="nama_pemesan" value="{{ $pemesan->nama_pemesan }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="asal_pemesan{{ $pemesan->id }}" class="form-label">Asal Pemesan</label>
                                                                <input type="text" class="form-control" id="asal_pemesan{{ $pemesan->id }}" name="asal_pemesan" value="{{ $pemesan->asal_pemesan }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tanggal_pemesan{{ $pemesan->id }}" class="form-label">Tanggal Pemesan</label>
                                                                <input type="date" class="form-control" id="tanggal_pemesan{{ $pemesan->id }}" name="tanggal_pemesan" value="{{ $pemesan->tanggal_pemesan }}" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Edit Pemesan --> 
                                        <!-- Modal Hapus Pemesan -->
                                        <div class="modal fade" id="deleteModal{{ $pemesan->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $pemesan->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $pemesan->id }}">Hapus Data Pemesan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus pemesan <strong>{{ $pemesan->nama_pemesan }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('data-pemesan.destroy', $pemesan->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Hapus Pemesan -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal Tambah Data Pemesan -->
<div class="modal fade" id="createModalPemesan" tabindex="-1" aria-labelledby="createModalLabelPemesan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabelPemesan">Tambah Data Pemesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('data-pemesan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                        <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" required>
                    </div>
                    <div class="mb-3">
                        <label for="asal_pemesan" class="form-label">Asal Pemesan</label>
                        <input type="text" class="form-control" id="asal_pemesan" name="asal_pemesan" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_pemesan" class="form-label">Tanggal Pemesan</label>
                        <input type="date" class="form-control" id="tanggal_pemesan" name="tanggal_pemesan" required>
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
<!-- End Modal Tambah Data Pemesan -->
@endsection
