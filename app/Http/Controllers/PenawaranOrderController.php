<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenawaranOrder;
use App\Http\Controllers\Controller;

class PenawaranOrderController extends Controller
{
    public function index()
    {
        $no = 1;
        $penawaranOrders = PenawaranOrder::orderBy('purchase_no')->get();
        
        // Mengirim data ke view 'pages.data-PO.index'
        return view('pages.data-PO.index', compact('no','penawaranOrders'));
    }

    public function create()
{
    return view('pages.data-PO.create');
}

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'purchase_no' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_kirim' => 'required|string|max:255',
            'quantity' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric',
            'jumlah_amount' => 'required|numeric',
        ]);

        // Menyimpan data ke database
        PenawaranOrder::create($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('data-PO.index')->with('success', 'Data Penawaran Order berhasil ditambahkan.');
    }

        public function edit($id)
    {
        $penawaranOrder = PenawaranOrder::findOrFail($id);
        return view('pages.data-PO.edit', compact('penawaranOrder'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'purchase_no' => 'required',
            'nama_perusahaan' => 'required',
            'alamat_kirim' => 'required',
            'quantity' => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'jumlah_amount' => 'required|numeric',
        ]);

        $penawaranOrder = PenawaranOrder::findOrFail($id);
        $penawaranOrder->update($request->all());

        return redirect()->route('data-PO.index')->with('success', 'Penawaran Order berhasil diperbarui');
    }

    public function destroy($id)
    {
        $penawaranOrder = PenawaranOrder::findOrFail($id);
        $penawaranOrder->delete();

        return redirect()->route('data-PO.index')->with('success', 'Penawaran Order berhasil dihapus');
    }
}
