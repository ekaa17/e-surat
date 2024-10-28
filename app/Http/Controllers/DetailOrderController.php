<?php

namespace App\Http\Controllers;

use App\Models\Detailorder;
use Illuminate\Http\Request;

class DetailOrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'produk'   => 'required',
            'quantity'   => 'required',
            'total'   => 'required',
        ]);

        $data = new Detailorder();
        $data->id_produk = $request->produk;
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
        $data = Detailorder::findOrFail($id);

        if ($data->delete()) {
            return redirect()->back()->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
