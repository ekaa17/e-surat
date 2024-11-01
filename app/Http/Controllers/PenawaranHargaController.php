<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pemesan;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\PenawaranHarga;
use App\Http\Controllers\Controller;
use App\Models\DetailPenawaran;
use App\Models\Invoice;
use App\Models\PenawaranOrder;
use App\Models\Staff;

class PenawaranHargaController extends Controller
{
    public function index()
    {
        $no = 1;
        $data_Harga = PenawaranHarga::with('pemesan')->get();
        $pemesan = Pemesan::all(); 
        return view('pages.data-PH.index', compact('data_Harga', 'pemesan'));
    }

    public function create()
    {

        $produk = Produk::all(); // Mengambil semua data produk
        $pemesan = Pemesan::all(); // Mengambil semua data pemesan
        return view('pages.data-PH.create', compact('produk', 'pemesan')); // Menampilkan halaman create
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'id_pemesan' => 'required|string|max:255',
            'no_surat'   => 'required|string|max:255',
        ]);

        // Simpan data ke dalam database
        PenawaranHarga::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('data-PH.index')->with('success', 'Data penawaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $no = 1;
        $produk = Produk::all();
        $pemesan = Pemesan::all();
        $penawaran = PenawaranHarga::findOrFail($id);
        $detail_pemesanan = DetailPenawaran::where('id_penawaran', $id)->get();

        return view('pages.data-PH.show', compact('no', 'penawaran', 'produk', 'pemesan', 'detail_pemesanan'));
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
    
    public function setujui($id) {
        $penawaran = PenawaranHarga::findOrFail($id);
        $penawaran->status_pengajuan = 'Disetujui';

        if ($penawaran->save()){
            return redirect()->back()->with('success', 'Surat terkait berhasil Disetujui!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyetujui surat');
        }
    }

    public function surat_ph($id) {
        $no = 1;
        $penawaran = PenawaranHarga::findOrFail($id);
        $data = PenawaranHarga::findOrFail($id);
        $detail_data = DetailPenawaran::where('id_penawaran', $id)->get();
        $total = DetailPenawaran::where('id_penawaran', $id)->sum('total');
        $informasi_perusahaan = Setting::where('id', 1)->first();
        $direktur = Staff::where('role', 'Karyawan')->first();
        return view('pages.surat.surat_penawaran_harga', compact('no', 'data','penawaran', 'detail_data', 'total', 'informasi_perusahaan', 'direktur'));
    }
}
