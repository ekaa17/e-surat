@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Invoice</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Data Invoice</li>
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
                            <a href="{{ route('data-invoice.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus"></i> Data Baru
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable" id="inovice">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bill To</th>
                                        <th>No Invoice</th>
                                        <th>PO Number</th>
                                        <th>Description</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Subtotal</th>
                                        <th>PPN</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tbody>
                                        @forelse($invoices as $invoice)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $invoice->bill_to }}</td>
                                            <td>{{ $invoice->no_invoice }}</td>
                                            <td>{{ $invoice->po_number }}</td>
                                            <td>{{ $invoice->description }}</td>
                                            <td>{{ number_format($invoice->unit_price, 2) }}</td>
                                            <td>{{ $invoice->quantity }}</td>
                                            <td>{{ number_format($invoice->amount, 2) }}</td>
                                            <td>{{ number_format($invoice->subtotal, 2) }}</td>
                                            <td>{{ number_format($invoice->ppn, 2) }}</td>
                                            <td>{{ number_format($invoice->total, 2) }}</td>
                                            <td>
                                                <a href="{{ route('data-invoice.edit', $invoice->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <form action="{{ route('data-invoice.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="11" class="text-center">Tidak ada invoice tersedia.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
