@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Setting</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Data Setting</li>
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
                            <h5 class="card-title">Total :{{$setting}} Setting</h5>
                            <a href="{{ route('data-setting.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus fa-sm text-white-50"></i> Data Baru
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable" id="pegawai">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Bidang</th>
                                        <th>Alamat</th>
                                        <th>No Telpon</th>
                                        <th>Fax</th>
                                        <th>Email</th>
                                        <th>No Rek</th>
                                        <th>Jenis Bank</th>
                                        <th>Logo</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($perusahaans as $key => $perusahaan)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $perusahaan->nama_perusahaan }}</td>
                                            <td>{{ $perusahaan->bidang }}</td>
                                            <td>{{ $perusahaan->alamat }}</td>
                                            <td>{{ $perusahaan->no_telpon }}</td>
                                            <td>{{ $perusahaan->fax }}</td>
                                            <td>{{ $perusahaan->email }}</td>
                                            <td>{{ $perusahaan->no_rek }}</td>
                                            <td>{{ $perusahaan->jenis_bank }}</td>
                                            <td>
                                                @if($perusahaan->logo)
                                                    <img src="{{ asset('assets/img/logo/' . $perusahaan->logo) }}" alt="logo" width="50">
                                                @else
                                                    Tidak Ada Tanda Tangan
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('data-setting.edit', $perusahaan->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $perusahaan->id }}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal Hapus Perusahaan -->
                                        <div class="modal fade" id="deleteModal{{ $perusahaan->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $perusahaan->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $perusahaan->id }}">Hapus Data Setting</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus Setting <strong>{{ $perusahaan->nama_perusahaan }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('data-setting.destroy', $perusahaan->id) }}" method="POST">
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
@endsection
