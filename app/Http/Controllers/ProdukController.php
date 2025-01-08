<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('perusahaan')->get();
        $perusahaans = Perusahaan::all(); // Untuk dropdown di modal
        return view('pages.data-produk.index', compact('produks', 'perusahaans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string|max:255',
            'harga_produk' => 'required|integer',
            'id_perusahaan' => 'required|exists:perusahaans,id',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
        ]);

        Produk::create($request->all());
        return redirect()->back()->with('success', 'Data produk berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string|max:255',
            'harga_produk' => 'required|integer',
            'id_perusahaan' => 'required|exists:perusahaans,id',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());
        return redirect()->back()->with('success', 'Data produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->back()->with('success', 'Data produk berhasil dihapus.');
    }
}
