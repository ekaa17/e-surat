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
                            <h5 class="card-title">Total: {{ count($data_Harga) }} Surat</h5>
                            <!-- Tombol Tambah Data -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                <i class="bi bi-plus"></i> Data Baru
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable" id="pegawai">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Pemesan</th>
                                        <th>No Surat</th>
                                        <th>Status Pengajuan</th>
                                        <th>Status Validasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_Harga as $penawaran)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $penawaran->pemesan->nama_pemesan }}</td>
                                            <td>{{ $penawaran->no_surat }}</td>
                                            <td>
                                                @if ($penawaran->status_pengajuan == "belum disetujui")
                                                   @if (auth()->user()->role == 'Admin') 
                                                        <span class="badge me-2 badge-pill bg-secondary">{{ $penawaran->status_pengajuan }}</span>
                                                    @else
                                                        <button type="button" class="btn mb-1 me-1 btn-secondary" data-bs-toggle="modal" data-bs-target="#pengajuan{{ $penawaran->id }}" fdprocessedid="tml8fm">
                                                            Setujui
                                                        </button>
                                                        <div id="pengajuan{{ $penawaran->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myModalLabel"> Setujui Penawaran Harga </h4> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h6>Apakah benar anda menyetujui penawaran harga terkait ?</h6>
                                                                    </div>
                                                                    <div class="modal-footer"> 
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Tidak </button>
                                                                        <a href="/setujui-surat-ph/{{ $penawaran->id }}" class="btn btn-primary">Ya</a> 
                                                                    </div>
                                                                </div> <!-- /.modal-content -->
                                                            </div> <!-- /.modal-dialog -->
                                                        </div> <!-- /.modal -->
                                                    @endif
                                                @else
                                                    <a href="/surat-penawaran-harga/{{ $penawaran->id }}" blan class="btn btn-primary" target="_blank">
                                                        <i class="ti ti-download"></i>
                                                    </a> 
                                                @endif
                                            </td>
                                            <td>
                                                @if ($penawaran->status_validity == "belum divalidasi")
                                                    <span class="badge me-2 badge-pill bg-secondary">{{ $penawaran->status_validity }}</span>
                                                @else
                                                    <span class="badge me-2 badge-pill bg-success">{{ $penawaran->status_validity }}</span>
                                                @endif
                                            </td>
                                            <th>
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $penawaran->id }}">
                                                    <i class="ti ti-pencil"></i>
                                                </button>

                                                <a href="{{ route('data-PH.show', $penawaran->id) }}" class="btn btn-primary">
                                                    <i class="ti ti-eye"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $penawaran->id }}">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </th>
                                        </tr>

                                        <!-- Modal Setujui Pengajuan -->
                                            {{-- <div class="modal fade" id="pengajuan{{ $penawaran->id }}" tabindex="-1" role="dialog" aria-labelledby="pengajuanLabel{{ $penawaran->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="pengajuanLabel{{ $penawaran->id }}">Setujui Penawaran Harga</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menyetujui penawaran ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                                                            <a href="/setujui-surat-ph/{{ $penawaran->id }}" class="btn btn-primary">Ya</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                        <!-- Modal Edit Data -->
                                        <div class="modal fade" id="editModal{{ $penawaran->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $penawaran->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $penawaran->id }}">Edit Penawaran Harga</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('data-PH.update', $penawaran->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            
                                                            <div class="row mb-3">
                                                                <label for="id_pemesan" class="col-md-4 col-lg-3 col-form-label">Pemesan</label>
                                                                <div class="col-md-8 col-lg-9">
                                                                    <select name="id_pemesan" id="id_pemesan" class="form-control @error('id_pemesan') is-invalid @enderror" required>
                                                                        <option value="">Pilih Pemesan</option>
                                                                        @foreach($pemesan as $p)
                                                                            <option value="{{ $p->id }}" {{ $penawaran->id_pemesan == $p->id ? 'selected' : '' }}>
                                                                                {{ $p->nama_pemesan }}
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
                                
                                                            <div class="row mb-3">
                                                                <label for="no_surat" class="col-md-4 col-lg-3 col-form-label">Nomor Surat</label>
                                                                <div class="col-md-8 col-lg-9">
                                                                    <input type="text" class="form-control @error('no_surat') is-invalid @enderror" id="no_surat" name="no_surat" value="{{ old('no_surat', $penawaran->no_surat) }}" required>
                                                                    @error('no_surat')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Hapus Data -->
                                        <div class="modal fade" id="deleteModal{{ $penawaran->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $penawaran->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $penawaran->id }}">Hapus Data Penawaran Harga</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus penawaran harga <strong>{{ $penawaran->no_surat }}</strong>?
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal Tambah Data -->
                        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createModalLabel">Tambah Data Penawaran Harga</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('data-PH.store') }}" method="POST">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="id_pemesan" class="col-md-4 col-lg-3 col-form-label">Pemesan</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <select name="id_pemesan" id="id_pemesan" class="form-control @error('id_pemesan') is-invalid @enderror" required>
                                                        <option value="">Pilih Pemesan</option>
                                                        @foreach($pemesan as $p)
                                                            <option value="{{ $p->id }}" {{ old('id_pemesan') == $p->id ? 'selected' : '' }}>{{ $p->nama_pemesan }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_pemesan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <div class="row mb-3">
                                                <label for="no_surat" class="col-md-4 col-lg-3 col-form-label">No Surat</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input type="text" class="form-control @error('no_surat') is-invalid @enderror" id="no_surat" name="no_surat" value="{{ old('no_surat') }}" required>
                                                    @error('no_surat')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <button type="submit" class="btn btn-primary">Simpan</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Tambah Data -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
