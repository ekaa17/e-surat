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
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <form action="{{ route('data-invoice.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="bill_to">Bill To</label>
                                <input type="text" class="form-control" id="bill_to" name="bill_to" required>
                            </div>
                            <div class="form-group">
                                <label for="no_invoice">No Invoice</label>
                                <input type="text" class="form-control" id="no_invoice" name="no_invoice" required>
                            </div>
                            <div class="form-group">
                                <label for="po_number">PO Number</label>
                                <input type="text" class="form-control" id="po_number" name="po_number" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="unit_price">Unit Price</label>
                                <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <input type="text" class="form-control" id="unit" name="unit" required>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                            </div>
                            <div class="form-group">
                                <label for="subtotal">subtotal</label>
                                <input type="number" step="0.01" class="form-control" id="subtotal" name="subtotal" required>
                            </div>
                            <div class="form-group">
                                <label for="ppn">PPN</label>
                                <input type="number" step="0.01" class="form-control" id="ppn" name="ppn" required>
                            </div>
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" step="0.01" class="form-control" id="total" name="total" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection