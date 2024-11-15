@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Detail Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Detail Invoice</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12 mt-3">
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

            <div class="col-xl-12 mt-3">
                <div class="card">
                    <div class="card-body pt-3">
                        <table class="table datatable" id="pegawai">
                            <thead>
                                <tr>
                                        <th>Nomor Surat</th>
                                        <th>perusahaan</th>
                                        <th>Status</th>
                                        <th>bukti</th>
                                        <th>Status Pengajuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>{{ $invoice->no_surat }}</td>
                                        <td>{{ $invoice->pemesan ? $invoice->pemesan->asal_pemesan : 'Tidak Ada' }}</td>
                                        <td>{{ $invoice->status }}</td>
                                        <td>
                                            @if($invoice->bukti_transaksi)
                                                <img src="{{ asset('assets/img/bukti_transaksi/' . $invoice->bukti_transaksi) }}" alt="bukti_transaksi" width="50">
                                            @else
                                                Tidak Ada Tanda Tangan
                                            @endif
                                        </td>
                                        <td>
                                            @if ($invoice->status_pengajuan == "belum disetujui")
                                                <span class="badge me-2 badge-pill bg-secondary">{{ $invoice->status_pengajuan }}</span>
                                            @else
                                                <span class="badge me-2 badge-pill bg-success">{{ $invoice->status_pengajuan }}</span>
                                            @endif
                                        </td>

                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center my-2">
                <a href="{{ route('data-invoice.index') }}" class="btn btn-primary">
                    kembali ke halaman penawaran harga
                </a>
            </div>

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="d-flex align-items-center justify-content-between m-3">
                            <h5 class="card-title">Total : {{count($detail_invoice)}}  Produk</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProduk">
                                <i class="bi bi-plus"></i> Tambah Produk
                            </button>
                            <div class="modal fade" id="tambahProduk" tabindex="-1" aria-labelledby="tambahProdukLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahProdukLabel">Tambah Produk</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('detail-invoice.store') }}" method="POST">
                                                @csrf
                                                <div class="row mb-3">
                                                    <input type="hidden" name="id_invoice" value="{{ $invoice->id }}">
                                                    <label for="produk" class="col-md-4 col-lg-3 col-form-label">Jenis Produk</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <select name="produk" id="produk" class="form-control @error('produk') is-invalid @enderror" onchange="updateTotal()">
                                                            <option value="">Pilih Produk</option>
                                                            @foreach($produk as $p)
                                                                <option value="{{ $p->id }}" data-harga="{{ $p->harga_produk }}" {{ old('produk') == $p->id ? 'selected' : '' }}>
                                                                    {{ $p->nama_produk }} | {{ $p->perusahaan->nama_perusahaan }} | Rp. {{ number_format($p->harga_produk, 0, ',', '.') }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('produk')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="quantity" class="col-md-4 col-lg-3 col-form-label">Quantity</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" oninput="updateTotal()">
                                                        @error('quantity')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="total" class="col-md-4 col-lg-3 col-form-label">Total</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total" value="{{ old('total') }}" readonly>
                                                        @error('total')
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
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable" id="pegawai">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail_invoice as $index => $order)
                                        <tr>
                                            <td> {{ $index + 1 }} </td>
                                            <td> {{ $order->produk?->nama_produk ?? '-' }} </td>
                                            <td> Rp. {{ number_format($order->produk?->harga_produk ?? 0, 0, ',', '.') }} </td>
                                            <td> {{ $order->quantity }} {{ $order->produk?->unit ?? '-' }}</td>
                                            <td> Rp {{ number_format($order->total, 0, ',', '.') }} </td>
                                            <td></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $order->id }}">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                                
                                                <!-- Modal Hapus -->
                                                <div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $order->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel{{ $order->id }}">Hapus Produk Dalam List</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus produk <strong>{{ $order->produk?->nama_produk ?? 'Produk tidak tersedia' }}</strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('detail-invoice.destroy', $order->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
        function updateTotal() {
            const produkSelect = document.getElementById('produk');
            const selectedOption = produkSelect.options[produkSelect.selectedIndex];
            const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            const quantity = parseFloat(document.getElementById('quantity').value) || 0;
            const total = harga * quantity;
            
            document.getElementById('total').value = total;
        }
    </script>  
@endsection
