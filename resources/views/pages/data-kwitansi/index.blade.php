@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data kwitansi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Data kwitansi</li>
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
                            <h5 class="card-title">Total: {{$kwitansicount}} Surat kwitansi</h5>
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
                                        <th>No Kwitansi</th>
                                        <th>No Invoice</th>
                                        <th>Nama Klien</th>
                                        <th>Status Pengajuan</th>
                                        @if (auth()->user()->role == 'Admin')
                                            <th>Data</th>
                                            <th>Actions</th>
                                        @else
                                            <th>Unduh Surat</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kwitansis as $index => $kwitansi)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $kwitansi->no_kwitansi }}</td>
                                            <td>{{ $kwitansi->invoice ? $kwitansi->invoice->no_surat : 'Tidak Ada' }}</td>
                                            <td>{{ $kwitansi->invoice ? $kwitansi->invoice->pemesan->asal_pemesan : 'Tidak Ada' }}</td>
                                        
                                            <td>
                                                @if ($kwitansi->status_pengajuan == "Belum Disetujui")
                                                    @if (auth()->user()->role == 'Admin') 
                                                        <span class="badge me-2 badge-pill bg-secondary">{{ $kwitansi->status_pengajuan }}</span>
                                                    @else
                                                        <button type="button" class="btn mb-1 me-1 btn-secondary" data-bs-toggle="modal" data-bs-target="#pengajuan{{ $kwitansi->id }}">
                                                            Setujui
                                                        </button>
                                                        <div id="pengajuan{{ $kwitansi->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myModalLabel">Setujui kwitansi Harga</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h6>Apakah benar anda menyetujui kwitansi terkait?</h6>
                                                                    </div>
                                                                    <div class="modal-footer"> 
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                                                                        <a href="/setujui-surat-kwitansi/{{ $kwitansi->id }}" class="btn btn-primary">Ya</a> 
                                                                    </div>
                                                                </div> <!-- /.modal-content -->
                                                            </div> <!-- /.modal-dialog -->
                                                        </div> <!-- /.modal -->
                                                    @endif
                                                @else
                                                    <span class="badge me-2 badge-pill bg-primary">{{ $kwitansi->status_pengajuan }}</span>
                                                @endif
                                            </td>
                                            <td>
                                              
                                            <!-- Download Data -->
                                                <a href="/surat-kwitansi/{{ $kwitansi->id }}" class="btn btn-primary" target="_blank"><i class="ti ti-download"></i></a> 
                                            </td>
                                            @if (auth()->user()->role == 'Admin')
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal-{{ $kwitansi->id }}">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $kwitansi->id }}">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>     
                                                </td>
                                            @endif 
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal-{{ $kwitansi->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Data kwitansi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('data-kwitansi.update', $kwitansi->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="no_kwitansi" class="form-label">No Kwitansi</label>
                                                                <input type="text" class="form-control" id="no_kwitansi" name="no_kwitansi" value="{{ $kwitansi->no_kwitansi }}" required>
                                                            </div>
                                        
                                                            <div class="mb-3">
                                                                <label for="id_invoice" class="form-label">No Invoice</label>
                                                                <select name="id_invoice" id="id_invoice" class="form-control @error('id_invoice') is-invalid @enderror" required>
                                                                    <option value="">Pilih No Invoice</option>
                                                                    @foreach($invoice as $inv)
                                                                        <option value="{{ $inv->id }}" {{ $kwitansi->id_invoice == $inv->id ? 'selected' : '' }}>{{ $inv->no_surat }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('id_invoice')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                        
                                                            <div class="mb-3">
                                                                <label for="id_klien" class="form-label">Klien</label>
                                                                <select name="id_klien" id="id_klien" class="form-control @error('id_klien') is-invalid @enderror" required>
                                                                    <option value="">Pilih Klien</option>
                                                                    @foreach($invoice as $inv)
                                                                        <option value="{{ $inv->pemesan->id }}" {{ $kwitansi->invoice->pemesan->id == $inv->pemesan->id ? 'selected' : '' }}>{{ $inv->pemesan->asal_pemesan }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('id_klien')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                        

                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal-{{ $kwitansi->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Hapus Data Kwitansi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus kwitansi dengan No Kwitansi "{{ $kwitansi->no_kwitansi }}"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('data-kwitansi.destroy', $kwitansi->id) }}" method="POST">
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
                    <h5 class="modal-title" id="createModalLabel">Tambah Data kwitansi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('data-kwitansi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="no_kwitansi" class="form-label">No Kwitansi</label>
                            <input type="text" class="form-control" id="no_kwitansi" name="no_kwitansi" value="" required>
                        </div>
                        <div class="row mb-3">
                            <label for="id_invoice" class="col-md-4 col-lg-3 col-form-label">No Invoice</label>
                            <div class="col-md-8 col-lg-9">
                                <select name="id_invoice" id="id_invoice" class="form-control @error('id_invoice') is-invalid @enderror" required>
                                    <option value="">Pilih No Invoice</option>
                                    @foreach($invoice as $p)
                                        <option value="{{ $p->id }}" {{ old('id_invoice') == $p->id ? 'selected' : '' }}>{{ $p->no_surat }}</option>
                                    @endforeach
                                </select>
                                @error('id_invoice')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="id_invoice" class="col-md-4 col-lg-3 col-form-label">Klien</label>
                            <div class="col-md-8 col-lg-9">
                                <select name="id_invoice" id="id_invoice" class="form-control @error('id_invoice') is-invalid @enderror" required>
                                    <option value="">Pilih Klien</option>
                                    @foreach($invoice as $p)
                                        <option value="{{ $p->id }}" {{ old('id_invoice') == $p->id ? 'selected' : '' }}>{{ $p->pemesan->asal_pemesan }}</option>
                                    @endforeach
                                </select>
                                @error('id_invoice')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
