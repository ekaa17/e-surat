<?php

namespace App\Http\Controllers;

use App\Models\DetailPenawaran;
use Illuminate\Http\Request;

class DetailPesananController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'produk'   => 'required',
            'quantity'   => 'required',
            'total'   => 'required',
        ]);

        $data = new DetailPenawaran();
        $data->id_produk = $request->produk;
        $data->id_penawaran = $request->id_penawaran;
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
        $data = DetailPenawaran::findOrFail($id);

        if ($data->delete()) {
            return redirect()->back()->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
        
}
