<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $no = 1;
        $invoices = Invoice::orderBy('bill_to')->get();
        return view('pages.data-invoice.index', compact('no', 'invoices'));
    }

    public function create()
    {
        return view('pages.data-invoice.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bill_to' => 'required',
            'no_invoice' => 'required',
            'po_number' => 'required',
            'description' => 'required',
            'unit_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'unit' => 'required',
            'amount' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'ppn' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        Invoice::create($validated);

        return redirect()->route('data-invoice.index')->with('success', 'Invoice berhasil ditambahkan.');
    }


    public function edit( $id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('pages.data-invoice.edit', compact('invoice'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'bill_to' => 'required',
            'no_invoice' => 'required',
            'po_number' => 'required',
            'description' => 'required',
            'unit_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'unit' => 'required',
            'amount' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'ppn' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());

        return redirect()->route('data-invoice.index')->with('success', 'Invoice berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('data-invoice.index')->with('success', 'Invoice berhasil dihapus.');
    }
}
