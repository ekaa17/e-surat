<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pemesan;
use Illuminate\Http\Request;
use App\Models\PenawaranHarga;
use App\Http\Controllers\Controller;

class PenawaranHargaController extends Controller
{
    public function index()
    {
        $no = 1;
        $data_Harga = PenawaranHarga::orderBy('id')->get();
        return view('pages.data-PH.index', compact('no', 'data_Harga'));
    }

    public function create()
    {

        $produk = Produk::all(); // Mengambil semua data produk
        $pemesan = Pemesan::all(); // Mengambil semua data pemesan
        return view('pages.data-PH.create', compact('produk', 'pemesan')); // Menampilkan halaman create
    }

    /**
     * Menyimpan data penawaran baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'id_pemesan' => 'required|string|max:255',
            'id_produk'  => 'required|string|max:255',
            'quantity'   => 'required|integer|min:1',
            'total'      => 'required|numeric|min:0',
            'no_surat'   => 'required|string|max:255',
        ]);

        // Simpan data ke dalam database
        PenawaranHarga::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('data-PH.index')->with('success', 'Data penawaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penawaran = PenawaranHarga::findOrFail($id);
        $produk = Produk::all(); // Mengambil semua data produk
        $pemesan = Pemesan::all(); // Mengambil semua data pemesan

        return view('pages.data-PH.edit', compact('penawaran', 'produk', 'pemesan'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_pemesan' => 'required|exists:pemesans,id',
            'id_produk'  => 'required|exists:produks,id',
            'quantity'   => 'required|integer|min:1',
            'total'      => 'required|numeric|min:0',
            'no_surat'   => 'required|string|max:255',
        ]);

        $penawaran = PenawaranHarga::findOrFail($id);
        $penawaran->update($validatedData);

        return redirect()->route('data-PH.index')->with('success', 'Data penawaran berhasil diubah.');
    }

    public function destroy($id)
{
    try {
        // Cari data penawaran berdasarkan ID
        $penawaran = PenawaranHarga::findOrFail($id);

        // Hapus data penawaran
        $penawaran->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('data-PH.index')->with('success', 'Data penawaran berhasil dihapus.');

    } catch (\Exception $e) {
        // Jika terjadi error, redirect dengan pesan error
        return redirect()->route('data-PH.index')->with('error', 'Gagal menghapus data penawaran.');
    }
}
}
