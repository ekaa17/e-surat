@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Penawaran Order</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Data Penawaran Order</li>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                <i class="bi bi-plus"></i> Data Baru
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>penawaran</th>
                                        <th>Waktu Penyerahan</th>
                                        <th>Waktu Pembayaran</th>
                                        <th>Lokasi Gudang</th>
                                        {{-- <th>Bukti</th> --}}
                                        <th>PPN</th>
                                        <th>Data</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->nomor_surat }}</td>
                                            <td>{{ $order->penawaran ? $order->penawaran->no_surat : 'Tidak ada penawaran' }}</td>
                                            <td>{{ $order->waktu_penyerahan_barang }}</td>
                                            <td>{{ $order->waktu_pembayaran }}</td>
                                            <td>{{ $order->lokasi_gudang }}</td>
                                            <td>{{ $order->ppn }}</td>
                                            <td>
                                                 <!-- Detail Data -->
                                                <a href="{{ route('data-PO.show', $order->id) }}" class="btn btn-danger" >
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            
                                            <!-- Download Data -->
                                            <a href="/surat-purchase-order/{{ $order->id }} " class="btn btn-primary" target="_blank">
                                                <i class="ti ti-download"></i>
                                            </a> 
                                                <td>  
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal-{{ $order->id }}">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $order->id }}">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>     
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal-{{ $order->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $order->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel-{{ $order->id }}">Edit Data Order</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('data-PO.update', $order->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT') <!-- Menentukan metode PUT untuk update -->
                                                        <div class="modal-body">
                                                            <!-- Nomor Surat -->
                                                            <div class="mb-3">
                                                                <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                                                <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $order->nomor_surat) }}" required>
                                                            </div>
                                        
                                                            <!-- Pemesan -->
                                                            <div class="row mb-3">
                                                                <label for="id_penawaran" class="col-md-4 col-lg-3 col-form-label">Penawaran</label>
                                                                <div class="col-md-8 col-lg-9">
                                                                    <select name="id_penawaran" id="id_penawaran" class="form-control @error('id_penawaran') is-invalid @enderror">
                                                                        <option value="">Pilih Penawaran</option>
                                                                        @foreach($penawaran as $p)
                                                                            <option value="{{ $p->id }}" {{ (old('id_penawaran', $order->id_penawaran) == $p->id) ? 'selected' : '' }}>{{ $p->no_surat }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('id_penawaran')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                        
                                                            <!-- Waktu Penyerahan Barang -->
                                                            <div class="row mb-3">
                                                                <label for="waktu_penyerahan_barang" class="col-sm-4 col-form-label">Waktu Penyerahan Barang</label>
                                                                <div class="col-sm-8">
                                                                    <input type="datetime-local" class="form-control @error('waktu_penyerahan_barang') is-invalid @enderror" name="waktu_penyerahan_barang" value="{{ old('waktu_penyerahan_barang', \Carbon\Carbon::parse($order->waktu_penyerahan_barang)->format('Y-m-d\TH:i')) }}" required>
                                                                    @error('waktu_penyerahan_barang')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                        
                                                            <!-- Waktu Pembayaran -->
                                                            <div class="row mb-3">
                                                                <label for="waktu_pembayaran" class="col-sm-4 col-form-label">Waktu Pembayaran</label>
                                                                <div class="col-sm-8">
                                                                    <input type="datetime-local" class="form-control @error('waktu_pembayaran') is-invalid @enderror" name="waktu_pembayaran" value="{{ old('waktu_pembayaran', \Carbon\Carbon::parse($order->waktu_pembayaran)->format('Y-m-d\TH:i')) }}" required>
                                                                    @error('waktu_pembayaran')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                        
                                                            <!-- Lokasi Gudang -->
                                                            <div class="mb-3">
                                                                <label for="lokasi_gudang" class="form-label">Lokasi Gudang</label>
                                                                <input type="text" class="form-control" id="lokasi_gudang" name="lokasi_gudang" value="{{ old('lokasi_gudang', $order->lokasi_gudang) }}" required>
                                                            </div>
                                        
                                                            <!-- Bukti (File Upload) -->
                                                            <div class="mb-3">
                                                                <label for="bukti" class="form-label">Bukti (jpg, jpeg, png, pdf)</label>
                                                                <input type="file" class="form-control @error('bukti') is-invalid @enderror" name="bukti" id="bukti">
                                                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah bukti.</small>
                                                                @error('bukti')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                        
                                                            <!-- PPN -->
                                                            <div class="mb-3">
                                                                <label for="ppn" class="form-label">PPN</label>
                                                                <input type="number" class="form-control" id="ppn" name="ppn" value="{{ old('ppn', $order->ppn) }}" required>
                                                            </div>
                                                        </div>
                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
    
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal-{{ $order->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $order->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel-{{ $order->id }}">Hapus Data Order</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus data ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('data-PO.destroy', $order->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Tidak ada data penawaran order.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Create -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Data Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('data-PO.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Nomor Surat -->
                        <div class="mb-3">
                            <label for="nomor_surat" class="form-label">Nomor Surat</label>
                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                        </div>
    
                        <!-- Pemesan -->
                        <div class="row mb-3">
                            <label for="id_penawaran" class="col-md-4 col-lg-3 col-form-label">Penawaran</label>
                            <div class="col-md-8 col-lg-9">
                                <select name="id_penawaran" id="id_penawaran" class="form-control @error('id_penawaran') is-invalid @enderror">
                                    <option value="">Pilih Penawaran</option>
                                    @foreach($penawaran as $p)
                                        <option value="{{ $p->id }}" {{ old('id_penawaran') == $p->id ? 'selected' : '' }}>{{ $p->no_surat }}</option>
                                    @endforeach
                                </select>
                                @error('id_penawaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
    
                        <!-- Waktu Penyerahan Barang -->
                        <div class="row mb-3">
                            <label for="waktu_penyerahan_barang" class="col-sm-4 col-form-label">Waktu Penyerahan Barang</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control @error('waktu_penyerahan_barang') is-invalid @enderror" name="waktu_penyerahan_barang" value="{{ old('waktu_penyerahan_barang') }}" required>
                                @error('waktu_penyerahan_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
    
                        <!-- Waktu Pembayaran -->
                        <div class="row mb-3">
                            <label for="waktu_pembayaran" class="col-sm-4 col-form-label">Waktu Pembayaran</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control @error('waktu_pembayaran') is-invalid @enderror" name="waktu_pembayaran" value="{{ old('waktu_pembayaran') }}" required>
                                @error('waktu_pembayaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
    
                        <!-- Lokasi Gudang -->
                        <div class="mb-3">
                            <label for="lokasi_gudang" class="form-label">Lokasi Gudang</label>
                            <input type="text" class="form-control" id="lokasi_gudang" name="lokasi_gudang" required>
                        </div>
    
                        <!-- Bukti (File Upload) -->
                        <div class="mb-3">
                            <label for="bukti" class="form-label">Bukti (jpg, jpeg, png, pdf)</label>
                            <input type="file" class="form-control @error('bukti') is-invalid @enderror" name="bukti" id="bukti">
                            @error('bukti')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
    
                        <!-- PPN -->
                        <div class="mb-3">
                            <label for="ppn" class="form-label">PPN</label>
                            <input type="number" class="form-control" id="ppn" name="ppn" required>
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
