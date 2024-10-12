@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Tambah Staff</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('data-staff.index') }}">Staff</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <!-- Modal Tambah Data -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Data Perusahaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('data-perusahaan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_perusahaan" class="form-label">Alamat Perusahaan</label>
                        <input type="text" class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telpon" class="form-label">No Telpon</label>
                        <input type="text" class="form-control" id="no_telpon" name="no_telpon" required>
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

    </section>
@endsection