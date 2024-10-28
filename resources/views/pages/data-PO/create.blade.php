@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Tambah Penawaran Order Baru</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('data-PO.index') }}">Data Penawaran Order</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('data-PO.store') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label for="id_produk" class="col-sm-2 col-form-label">Produk</label>
                                <div class="col-sm-10">
                                    <select id="id_produk" class="form-select @error('id_produk') is-invalid @enderror" name="id_produk" required onchange="updateTotal()">
                                        <option value="" disabled selected>Pilih Produk</option>
                                            @foreach($produks as $p)
                                                <option value="{{ $p->id }}" data-harga="{{ $p->harga_produk }}" {{ old('produk') == $p->id ? 'selected' : '' }}>
                                                    {{ $p->nama_produk }} | {{ $p->perusahaan->nama_perusahaan }} | Rp. {{ number_format($p->harga_produk, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                    </select>
                                    @error('id_produk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nomor_surat" class="col-sm-2 col-form-label">Nomor Surat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" name="nomor_surat" value="{{ old('nomor_surat') }}">
                                    @error('nomor_surat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
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
                                <label for="total" class="col-sm-2 col-form-label">Total</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total" value="{{ old('total') }}" readonly>
                                    @error('total')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="lokasi_gudang" class="col-sm-2 col-form-label">Lokasi Gudang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('lokasi_gudang') is-invalid @enderror" name="lokasi_gudang" value="{{ old('lokasi_gudang') }}" required>
                                    @error('lokasi_gudang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                           

                            <div class="row mb-3">
                                <label for="id_penawaran" class="col-sm-2 col-form-label">ID Penawaran (Opsional)</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('id_penawaran') is-invalid @enderror" name="id_penawaran" value="{{ old('id_penawaran') }}">
                                    @error('id_penawaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="bukti" class="col-sm-2 col-form-label">Bukti</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('bukti') is-invalid @enderror" name="bukti" value="{{ old('bukti') }}" required>
                                    @error('bukti')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="waktu_penyerahan_barang" class="col-sm-2 col-form-label">Waktu Penyerahan Barang</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control @error('waktu_penyerahan_barang') is-invalid @enderror" name="waktu_penyerahan_barang" value="{{ old('waktu_penyerahan_barang') }}" required>
                                    @error('waktu_penyerahan_barang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="waktu_pembayaran" class="col-sm-2 col-form-label">Waktu Pembayaran</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control @error('waktu_pembayaran') is-invalid @enderror" name="waktu_pembayaran" value="{{ old('waktu_pembayaran') }}" required>
                                    @error('waktu_pembayaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="ppn" class="col-sm-2 col-form-label">PPN</label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" class="form-control @error('ppn') is-invalid @enderror" name="ppn" value="{{ old('ppn') }}" required>
                                    @error('ppn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('data-PO.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function updateTotal() {
            const produkSelect = document.getElementById('id_produk');
            const selectedOption = produkSelect.options[produkSelect.selectedIndex];
            const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            const quantity = parseFloat(document.getElementById('quantity').value) || 0;
            const total = harga * quantity;
            
            document.getElementById('total').value = total;
        }
    </script>  
@endsection
