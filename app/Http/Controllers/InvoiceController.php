<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\PenawaranHarga;
use App\Http\Controllers\Controller;
use App\Models\PenawaranOrder;

class InvoiceController extends Controller
{
    public function index()
    {
        $no = 1;
        $invoices = Invoice::all();
        $penawaran = PenawaranHarga::all(); // Ambil data penawaran
        $orders = PenawaranOrder::all(); // Ambil data penawaran
        return view('pages.data-invoice.index', compact('invoices', 'penawaran','orders'));
    }

    public function create()
    {
        $orders = PenawaranOrder::all(); 
        $penawaran = PenawaranHarga::all();
        return view('pages.data-invoice.create', compact('penawaran','orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'required|unique:invoices,no_surat',
            'id_penawaran' => 'required|exists:penawaran_hargas,id',
            'id_order' => 'required|exists:orders,id',
            'status' => 'required',
            'bukti_transaksi' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $invoice = new Invoice();
        $invoice->no_surat = $request->no_surat;
        $invoice->id_penawaran = $request->id_penawaran;
        $invoice->id_order = $request->id_order;
        $invoice->status = $request->status;
        
       // Proses file bukti jika ada
       if ($request->hasFile('bukti')) {
        $bukti = $request->file('bukti');
        $buktiName = now()->format('YmdHis') . '_bukti_' . $request->no_surat . '.' . $bukti->extension();
        $bukti->move(public_path('assets/img/bukti_transaksi/'), $buktiName);
    } else {
        $buktiName = null;
    }

        Invoice::create([
            'no_surat' => $request->no_surat,
            'id_penawaran' => $request->id_penawaran,
            'id_order' => $request->id_order,
            'status' => $request->status,
            'bukti_transaksi' => $buktiName,
        ]);

     
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
