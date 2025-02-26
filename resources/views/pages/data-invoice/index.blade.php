@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Invoice</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Data Invoice</li>
            </ol>
        </nav>
    </div>

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
                            <h5 class="card-title">Total: {{ $invoicecount}} Surat Invoice</h5>
                            @if (auth()->user()->role == 'Admin')
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                    <i class="bi bi-plus"></i> Data Baru
                                </button>
                            @endif
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat</th>
                                        <th>Nama Klien</th>
                                        <th>Status Kirim</th>
                                        <th>Status Pengajuan</th>
                                        <th>Bukti Transaksi</th>
                                        @if (auth()->user()->role == 'Admin')
                                            <th>Data</th>
                                            <th>Actions</th>
                                        @else
                                            <th>Unduh Surat</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $index => $invoice)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $invoice->no_surat }}</td>
                                            <td>{{ $invoice->pemesan ? $invoice->pemesan->asal_pemesan : 'Tidak Ada' }}</td>
                                            <td>{{ $invoice->status }}</td>
                                            <td>
                                                @if ($invoice->status_pengajuan == "Belum Disetujui")
                                                    @if (auth()->user()->role == 'Admin') 
                                                        <span class="badge me-2 badge-pill bg-secondary">{{ $invoice->status_pengajuan }}</span>
                                                    @else
                                                        <button type="button" class="btn mb-1 me-1 btn-secondary" data-bs-toggle="modal" data-bs-target="#pengajuan{{ $invoice->id }}">
                                                            Setujui
                                                        </button>
                                                        <div id="pengajuan{{ $invoice->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myModalLabel">Setujui invoice Harga</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h6>Apakah benar anda menyetujui invoice terkait?</h6>
                                                                    </div>
                                                                    <div class="modal-footer"> 
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                                                                        <a href="/setujui-surat-invoice/{{ $invoice->id }}" class="btn btn-primary">Ya</a> 
                                                                    </div>
                                                                </div> <!-- /.modal-content -->
                                                            </div> <!-- /.modal-dialog -->
                                                        </div> <!-- /.modal -->
                                                    @endif
                                                @else
                                                    <span class="badge me-2 badge-pill bg-primary">{{ $invoice->status_pengajuan }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($invoice->bukti_transaksi)
                                                    <img src="{{ asset('assets/img/bukti_transaksi/' . $invoice->bukti_transaksi) }}" alt="bukti_transaksi" width="50">
                                                @else
                                                    Tidak Ada Tanda Tangan
                                                @endif
                                            </td>
                                            <td>
                                                @if (auth()->user()->role == 'Admin')
                                                <!-- Detail Data -->
                                                <a href="{{ route('data-invoice.show', $invoice->id) }}" class="btn btn-danger">
                                                    <i class="ti ti-eye"></i>
                                                </a>      
                                            @endif
                                            <!-- Download Data -->
                                                <a href="/surat-invoice/{{ $invoice->id }}" class="btn btn-primary" target="_blank"><i class="ti ti-download"></i></a> 
                                            </td>
                                            @if (auth()->user()->role == 'Admin')
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal-{{ $invoice->id }}">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $invoice->id }}">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>     
                                                </td>
                                            @endif 
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal-{{ $invoice->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Data Invoice</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('data-invoice.update', $invoice->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="no_surat" class="form-label">No Surat</label>
                                                                <input type="text" class="form-control" id="no_surat" name="no_surat" value="{{ $invoice->no_surat }}" required>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="id_pemesan" class="col-md-4 col-lg-3 col-form-label">Pemesan</label>
                                                                <div class="col-md-8 col-lg-9">
                                                                    <select name="id_pemesan" id="id_pemesan" class="form-control @error('id_pemesan') is-invalid @enderror" required>
                                                                        <option value="">Pilih Pemesan</option>
                                                                        @foreach($pemesan as $p)
                                                                            <option value="{{ $p->id }}" {{ $invoice->id_pemesan == $p->id ? 'selected' : '' }}>
                                                                                {{ $p->asal_pemesan }}
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
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-select" id="status" name="status" required>
                                                                    <option value="Pending" {{ $invoice->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                    <option value="Completed" {{ $invoice->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="ppn" class="form-label">PPN</label>
                                                                <input type="number" class="form-control" id="ppn" name="ppn" value="{{ old('ppn', $invoice->ppn) }}" required>
                                                            </div>

                                                        <div class="form-group">
                                                            <label for="bukti_transaksi">Bukti Transaksi</label>
                                                            <input type="file" class="form-control" name="bukti_transaksi" id="bukti_transaksi">
                                                            @if($invoice->bukti_transaksi)
                                                                <img src="{{ asset('assets/img/bukti_transaksi/' . $invoice->bukti_transaksi) }}" alt="bukti_transaksi" width="100">
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal-{{ $invoice->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Hapus Data Invoice</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus data invoice dengan No Surat "{{ $invoice->no_surat }}"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('data-invoice.destroy', $invoice->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
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

    <!-- Modal Create -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Data Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('data-invoice.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="no_surat" class="form-label">No Surat</label>
                            <input type="text" class="form-control" id="no_surat" name="no_surat" value="" required>
                        </div>
                        <div class="row mb-3">
                            <label for="id_pemesan" class="col-md-4 col-lg-3 col-form-label">Pemesan</label>
                            <div class="col-md-8 col-lg-9">
                                <select name="id_pemesan" id="id_pemesan" class="form-control @error('id_pemesan') is-invalid @enderror" required>
                                    <option value="">Pilih Pemesan</option>
                                    @foreach($pemesan as $p)
                                        <option value="{{ $p->id }}" {{ old('id_pemesan') == $p->id ? 'selected' : '' }}>{{ $p->asal_pemesan }}</option>
                                    @endforeach
                                </select>
                                @error('id_pemesan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ppn" class="form-label">PPN</label>
                            <input type="number" class="form-control" id="ppn" name="ppn" required>
                            </div>
                        <div class="mb-3">
                            <label for="bukti_transaksi" class="form-label">Bukti Transaksi</label>
                            <input type="file" class="form-control" id="bukti_transaksi" name="bukti_transaksi" accept=".jpg, .jpeg, .png, .pdf">
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
