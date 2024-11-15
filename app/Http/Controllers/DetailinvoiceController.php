<?php

namespace App\Http\Controllers;

use App\Models\DetailInvoice;
use Illuminate\Http\Request;

class DetailinvoiceController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'produk'   => 'required',
            'quantity'   => 'required',
            'total'   => 'required',
        ]);

        $data = new DetailInvoice();
        $data->id_produk = $request->produk;
        $data->id_invoice = $request->id_invoice;
        $data->quantity = $request->quantity;
        $data->total = $request->total;

        if ($data->save()) {
            return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function destroy($id)
    {
        $data = DetailInvoice::findOrFail($id);

        if ($data->delete()) {
            return redirect()->back()->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
