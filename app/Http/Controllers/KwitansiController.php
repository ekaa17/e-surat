<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Invoice;
use App\Models\Setting;
use App\Models\Kwitansi;
use Illuminate\Http\Request;
use App\Models\DetailInvoice;
use App\Http\Controllers\Controller;

class KwitansiController extends Controller
{
    public function index()
    {
        $no = 1;
        $kwitansis = Kwitansi::all();
        $detail_invoice = DetailInvoice::all();
        $invoice = Invoice::all(); 
        $kwitansicount = Kwitansi::count();

        return view('pages.data-kwitansi.index', compact('kwitansis','kwitansicount','invoice','detail_invoice'));
    }

    public function create()
    {
        $detail_invoice = DetailInvoice::all();
        $invoice = Invoice::all(); 
        return view('pages.data-kwitansi.create', compact('detail_invoice','invoice'));
    }
    
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'no_kwitansi' => 'required|unique:kwitansis,no_kwitansi',
            'id_invoice' => 'required|exists:invoices,id', 
            // 'id_detail_invoice' => 'required|exists:detail_invoices,id', 
        ]);
    
        // Buat data invoice baru
        Kwitansi::create([
            'no_kwitansi' => $request->no_kwitansi,
            'id_invoice' => $request->id_invoice,
            // 'id_detail_invoice' => $request->id_detail_invoice,
        ]);
    
        return redirect()->route('data-kwitansi.index')->with('success', 'kwitansi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kwitansi = Kwitansi::findOrFail($id);
        $invoices = Invoice::all();
        $detail_invoices = DetailInvoice::all();
    
        return view('pages.data-kwitansi.edit', compact('kwitansi', 'invoices', 'detail_invoices'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_kwitansi' => 'required|unique:kwitansis,no_kwitansi,' . $id,
            'id_invoice' => 'required|exists:invoices,id', 
        ]);
    
        $kwitansi = Kwitansi::findOrFail($id);
        $kwitansi->update([
            'no_kwitansi' => $request->no_kwitansi,
            'id_invoice' => $request->id_invoice,
        ]);
    
        return redirect()->route('data-kwitansi.index')->with('success', 'Kwitansi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kwitansi = Kwitansi::findOrFail($id);
        $kwitansi->delete();
    
        return redirect()->route('data-kwitansi.index')->with('success', 'Kwitansi berhasil dihapus.');
    }



    public function setujui($id) {
        $kwitansis = Kwitansi::findOrFail($id);
        $kwitansis->status_pengajuan = 'Disetujui';

        if ($kwitansis->save()){
            return redirect()->back()->with('success', 'Surat terkait berhasil Disetujui!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyetujui surat');
        }
    }








    public function surat_kwitansi($id) {
        $no = 1;
        $kwitansis = Kwitansi::findOrFail($id);
        $invoice = Invoice::findOrFail($id);
        $data = Invoice::findOrFail($id);
        $detail_order = DetailInvoice::where('id_invoice', $id)->get();
        
        // $detail_data = DetailInvoice::where('id_invoice', $id)->get();
        $informasi_perusahaan = Setting::where('id', 1)->first();
        $direktur = Staff::where('role', 'Karyawan')->first();
        $total = DetailInvoice::where('id_invoice', $id)->sum('total');
        $ppn = $total*(($invoice->ppn)/100);
        $jumlah = $total-$ppn;
        $harga_terbilang = $this->terbilang($total);
        return view('pages.surat.surat_kwitansi', compact('no','harga_terbilang','total','ppn','jumlah', 'data','direktur','kwitansis','detail_order','informasi_perusahaan'));
    }

    private function terbilang($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");

        if ($nilai < 12) {
            return " " . $huruf[$nilai];
        } elseif ($nilai < 20) {
            return $this->terbilang($nilai - 10) . " Belas";
        } elseif ($nilai < 100) {
            return $this->terbilang($nilai / 10) . " Puluh" . $this->terbilang($nilai % 10);
        } elseif ($nilai < 200) {
            return " Seratus" . $this->terbilang($nilai - 100);
        } elseif ($nilai < 1000) {
            return $this->terbilang($nilai / 100) . " Ratus" . $this->terbilang($nilai % 100);
        } elseif ($nilai < 2000) {
            return " Seribu" . $this->terbilang($nilai - 1000);
        } elseif ($nilai < 1000000) {
            return $this->terbilang($nilai / 1000) . " Ribu" . $this->terbilang($nilai % 1000);
        } elseif ($nilai < 1000000000) {
            return $this->terbilang($nilai / 1000000) . " Juta" . $this->terbilang($nilai % 1000000);
        }
    }
}
