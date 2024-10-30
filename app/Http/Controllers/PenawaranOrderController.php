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
        $request->validate([
            'nomor_surat' => 'nullable|string',
            'lokasi_gudang' => 'required|string',
            'id_penawaran' => 'nullable|exists:penawaran_hargas,id',
            'waktu_penyerahan_barang' => 'required|date',
            'waktu_pembayaran' => 'required|date',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_perusahaan' => 'required|exists:perusahaans,id',
            'ppn' => 'required|numeric',
        ]);
    
        // Proses file bukti jika ada
        if ($request->hasFile('bukti')) {
            $bukti = $request->file('bukti');
            $buktiName = now()->format('YmdHis') . '_bukti_' . $request->nomor_surat . '.' . $bukti->extension();
            $bukti->move(public_path('assets/img/bukti/'), $buktiName);
        } else {
            $buktiName = null;
        }
    
        // Buat data PenawaranOrder dengan data yang telah diproses
        PenawaranOrder::create([
            'nomor_surat' => $request->nomor_surat,
            'lokasi_gudang' => $request->lokasi_gudang,
            'id_penawaran' => $request->id_penawaran,
            'waktu_penyerahan_barang' => $request->waktu_penyerahan_barang,
            'waktu_pembayaran' => $request->waktu_pembayaran,
            'bukti' => $buktiName,
            'id_perusahaan' => $request->id_perusahaan,
            'ppn' => $request->ppn,
        ]);
    
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
        'bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'id_perusahaan' => 'required|exists:perusahaans,id',
        'ppn' => 'required|numeric',
    ]);

    $order = PenawaranOrder::findOrFail($id);
    
    // Data yang akan di-update
    $data = $request->only('nomor_surat', 'lokasi_gudang', 'id_penawaran', 'waktu_penyerahan_barang', 'waktu_pembayaran', 'ppn', 'id_perusahaan');

    if ($request->hasFile('bukti')) {
        $bukti = $request->file('bukti');
        $buktiName = now()->format('YmdHis') . '_bukti_' . $request->nomor_surat . '.' . $bukti->extension();
        $bukti->move(public_path('assets/img/bukti/'), $buktiName);

        // Hapus file bukti lama jika ada
        if ($order->bukti) {
            $oldBuktiPath = public_path('assets/img/bukti/') . $order->bukti;
            if (file_exists($oldBuktiPath)) {
                unlink($oldBuktiPath);
            }
        }

        // Tambahkan nama file baru ke data
        $data['bukti'] = $buktiName;
    } else {
        $data['bukti'] = $order->bukti;
    }

    // Update data order dengan data yang sudah lengkap
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


    public function setujui($id) {
        $order = PenawaranOrder::findOrFail($id);
        $order->status_pengajuan = 'Disetujui';

        if ($order->save()){
            return redirect()->back()->with('success', 'Surat terkait berhasil Disetujui!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyetujui surat');
        }
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
        $terbilang = $this->terbilang($total);
        return view('pages.surat.surat-purchase-order', compact('no','terbilang', 'order', 'detail_order', 'total','ppn', 'jumlah','informasi_perusahaan', 'direktur'));
    }
    private function terbilang($number) {
        $number = abs($number);
        $words = [
            '','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas'];
        $result = '';
        if ($number < 12) {
            $result = ' ' . $words[$number];
        } elseif ($number < 20) {
            $result = $this->terbilang($number - 10) . ' Belas';
        } elseif ($number < 100) {
            $result = $this->terbilang($number / 10) . ' Puluh' . $this->terbilang($number % 10);
        } elseif ($number < 200) {
            $result = ' Seratus' . $this->terbilang($number - 100);
        } elseif ($number < 1000) {
            $result = $this->terbilang($number / 100) . ' Ratus' . $this->terbilang($number % 100);
        } elseif ($number < 2000) {
            $result = ' Seribu' . $this->terbilang($number - 1000);
        } elseif ($number < 1000000) {
            $result = $this->terbilang($number / 1000) . ' Ribu' . $this->terbilang($number % 1000);
        } elseif ($number < 1000000000) {
            $result = $this->terbilang($number / 1000000) . ' Juta' . $this->terbilang($number % 1000000);
        }
        return $result;
    }
    
}
