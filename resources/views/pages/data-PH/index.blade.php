@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Penawaran Harga</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Data Penawaran Harga</li>
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
                            <h5 class="card-title">Total :  Surat</h5>
                            <a href="{{ route('data-PH.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus"></i> Data Baru
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable" id="pegawai">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Id Pemesan</th>
                                        <th>Id Produk</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>No Surat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_Harga as $penawaran)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td> <!-- Nomor urut -->
                                            <td>{{ $penawaran->pemesan->nama_pemesan }}</td> <!-- Id Pemesan -->
                                            <td>{{ $penawaran->produk->nama_produk }}</td> <!-- Id Produk -->
                                            <td>{{ $penawaran->quantity }}</td> <!-- Jumlah produk -->
                                            <td>{{ number_format($penawaran->total, 0, ',', '.') }}</td> <!-- Total Harga -->
                                            <td>{{ $penawaran->no_surat }}</td> <!-- Nomor Surat -->
                                            <th>
                                                <a href="{{ route('data-PH.edit', $penawaran->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $penawaran->id }}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </th>
                                        </tr>
                                         <!-- Modal Hapus data staff-->
                                         <div class="modal fade" id="deleteModal{{ $penawaran->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $penawaran->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $penawaran->id }}">Hapus Data Staff</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus Penawaran Harga <strong>{{ $penawaran->name }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('data-PH.destroy', $penawaran->id) }}" method="POST">
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
