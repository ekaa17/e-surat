<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Produk;
use App\Models\Pemesan;
use App\Models\Setting;
use App\Models\Perusahaan;
use App\Models\Detailorder;
use Illuminate\Http\Request;
use App\Models\PenawaranHarga;
use App\Models\PenawaranOrder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PenawaranOrderController extends Controller
{
    public function index()
    {
        $no = 1;
        $orders = PenawaranOrder::with('penawaran')->get();
        $penawaran = PenawaranHarga::all(); 
        $perusahaans = Perusahaan::all();
        // Mengirim data ke view 'pages.data-PO.index'
        return view('pages.data-PO.index', compact('no','orders','penawaran','perusahaans'));
    }

    public function create()
    {
        $produk = Produk::all();
        $penawaran = PenawaranHarga::all();
        $perusahaans = Perusahaan::all();
        return view('pages.data-PO.create',compact('penawaran','produk','perusahaans')); // Sesuaikan dengan nama view Anda
    }

    // Menyimpan penawaran order baru
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nomor_surat' => 'nullable|string',
            'lokasi_gudang' => 'required|string',
            'id_penawaran' => 'nullable|exists:penawaran_hargas,id',
            'waktu_penyerahan_barang' => 'required|date',
            'waktu_pembayaran' => 'required|date',
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'id_perusahaan' => 'required|exists:perusahaans,id',
        ]);

        if ($request->hasFile('bukti')) {
            $bukti = $request->file('bukti');
            $buktiName = now()->format('YmdHis') . '_bukti_' . $request->nomor_surat . '.' . $bukti->extension();
            $bukti->move(public_path('assets/img/bukti/'), $buktiName);
        } else {
            $buktiName = null;
        }
        PenawaranOrder::create($request->all());

        return redirect()->route('data-PO.index')->with('success', 'Penawaran order berhasil dibuat.');
    }

    //menampilkan detail penawaran order
        public function show($id)
    {
        $no = 1;
        $produk = Produk::all();
        $order = PenawaranOrder::with(['penawaran', 'perusahaan'])->findOrFail($id);
        $detail_order = Detailorder::where('id_order', $id)->get();
        
        return view('pages.data-PO.show', compact('no', 'order', 'produk', 'detail_order')); // Sesuaikan dengan nama view Anda
    }

        // Menampilkan form untuk mengedit penawaran order
        public function edit($id)
    {
        $order = PenawaranOrder::findOrFail($id);
        $perusahaans = Perusahaan::all();
        return view('data-PO.edit', compact('order','perusahaans')); // Sesuaikan dengan nama view Anda
    }

// Memperbarui penawaran order yang ada
public function update(Request $request, $id)
{
    $request->validate([
        'nomor_surat' => 'nullable|string',
        'lokasi_gudang' => 'required|string',
        'id_penawaran' => 'nullable|exists:penawaran_hargas,id',
        'waktu_penyerahan_barang' => 'required|date',
        'waktu_pembayaran' => 'required|date',
        'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // ubah menjadi nullable jika tidak wajib
        'id_perusahaan' => 'required|exists:perusahaans,id',
    ]);

    $order = PenawaranOrder::findOrFail($id);
    
    // Menyimpan data yang tidak terkait file
    $data = $request->only('nomor_surat', 'lokasi_gudang', 'id_penawaran', 'waktu_penyerahan_barang', 'waktu_pembayaran', 'ppn');

    if ($request->hasFile('bukti')) {
        // Hapus bukti lama jika ada
        if ($order->bukti) {
            Storage::delete('public/' . $order->bukti); // Hapus bukti lama
        }
        // Simpan file baru
        $data['bukti'] = $request->file('bukti')->store('bukti', 'public');
    }

    // Update data order dengan data baru
    $order->update($data);

    return redirect()->route('data-PO.index')->with('success', 'Penawaran order berhasil diperbarui.');
}

    // Menghapus penawaran order
    public function destroy($id)
    {
        $order = PenawaranOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('data-PO.index')->with('success', 'Penawaran order berhasil dihapus.');
    }

    public function surat_order($id) {
        $no = 1;
        $order = PenawaranOrder::findOrFail($id);
        $detail_order = Detailorder::where('id_order', $id)->get();
        $total = Detailorder::where('id_order', $id)->sum('total');
        $ppn = $total*(($order->ppn)/100);
        $jumlah = $total-$ppn;
        // dd($total_akhir);
        $informasi_perusahaan = Setting::where('id', 1)->first();
        $direktur = Staff::where('role', 'Karyawan')->first();
        return view('pages.surat.surat-purchase-order', compact('no', 'order', 'detail_order', 'total','ppn', 'jumlah','informasi_perusahaan', 'direktur'));
    }
}
