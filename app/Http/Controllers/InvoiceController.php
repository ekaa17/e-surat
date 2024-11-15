<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Produk;
use App\Models\Invoice;
use App\Models\Setting;
use App\Models\Detailorder;
use Illuminate\Http\Request;
use App\Models\DetailInvoice;
use App\Models\PenawaranHarga;
use App\Models\PenawaranOrder;
use App\Http\Controllers\Controller;
use App\Models\Pemesan;

class InvoiceController extends Controller
{
    public function index()
    {
        $no = 1;
        $invoices = Invoice::with('pemesan')->get();
        $pemesan = Pemesan::all(); 
        $invoicecount = invoice::count();
        return view('pages.data-invoice.index', compact('invoices', 'pemesan','invoicecount'));
    }

    public function create()
    {
        $pemesan = Pemesan::all();
        return view('pages.data-invoice.create', compact('pemesan'));
    }
    
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'no_surat' => 'required|unique:invoices,no_surat',
            'id_pemesan' => 'required|exists:pemesans,id',
            'status' => 'required',
            'ppn' => 'required|numeric',
            'bukti_transaksi' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);
    
        // Proses file bukti_transaksi jika ada
        if ($request->hasFile('bukti_transaksi')) {
            $bukti = $request->file('bukti_transaksi');
            $buktiName = now()->format('YmdHis') . '_bukti_' . $request->no_surat . '.' . $bukti->extension();
            $bukti->move(public_path('assets/img/bukti_transaksi/'), $buktiName);
        } else {
            $buktiName = null;
        }
    
        // Buat data invoice baru
        Invoice::create([
            'no_surat' => $request->no_surat,
            'id_pemesan' => $request->id_pemesan,
            'status' => $request->status,
            'ppn' => $request->ppn,
            'bukti_transaksi' => $buktiName,
        ]);
    
        return redirect()->route('data-invoice.index')->with('success', 'Invoice berhasil ditambahkan.');
    }

    public function show($id)
    {
        $no = 1;
        $invoice = Invoice::with(['pemesan'])->findOrFail($id);
        $pemesan = Pemesan::all();
        $produk = Produk::all();
        $detail_invoice = DetailInvoice::where('id_invoice', $id)->get();
        
        return view('pages.data-invoice.show', compact('no', 'invoice', 'produk', 'pemesan', 'detail_invoice')); // Sesuaikan dengan nama view Anda
    }


    public function edit( $id)
    {
        $invoice = Invoice::findOrFail($id);
        $pemesan = Pemesan::all();
        return view('pages.data-invoice.edit', compact('invoice','pemesan'));
    }


        public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'no_surat' => 'required|unique:invoices,no_surat,' . $id,
            'id_pemesan' => 'required|exists:pemesans,id',
            'status' => 'required',
            'ppn' => 'required|numeric',
            'bukti_transaksi' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $invoice = Invoice::findOrFail($id);

        // Proses file bukti_transaksi jika ada file baru yang diupload
        if ($request->hasFile('bukti_transaksi')) {
            // Hapus file bukti lama jika ada
            if ($invoice->bukti_transaksi) {
                $oldPath = public_path('assets/img/bukti_transaksi/' . $invoice->bukti_transaksi);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Upload bukti_transaksi baru
            $bukti = $request->file('bukti_transaksi');
            $buktiName = now()->format('YmdHis') . '_bukti_' . $request->no_surat . '.' . $bukti->extension();
            $bukti->move(public_path('assets/img/bukti_transaksi/'), $buktiName);

            $validated['bukti_transaksi'] = $buktiName;
        }

        // Update data pada model Invoice, termasuk file jika ada
        $invoice->update($validated);

        return redirect()->route('data-invoice.index')->with('success', 'Invoice berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('data-invoice.index')->with('success', 'Invoice berhasil dihapus.');
    }


    public function setujui($id) {
        $invoice = Invoice::findOrFail($id);
        $invoice->status_pengajuan = 'Disetujui';

        if ($invoice->save()){
            return redirect()->back()->with('success', 'Surat terkait berhasil Disetujui!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyetujui surat');
        }
    }


    public function surat_invoice($id) {
        $no = 1;
        $invoice = Invoice::findOrFail($id);
        $data = Invoice::findOrFail($id);
        $detail_order = DetailInvoice::where('id_invoice', $id)->get();
        $total = DetailInvoice::where('id_invoice', $id)->sum('total');
        // $detail_data = DetailInvoice::where('id_invoice', $id)->get();
        // $total = DetailInvoice::where('id_invoice', $id)->sum('total');
        $ppn = $total*(($invoice->ppn)/100);
        $jumlah = $total-$ppn;
        $informasi_perusahaan = Setting::where('id', 1)->first();
        $direktur = Staff::where('role', 'Karyawan')->first();
        return view('pages.surat.surat-invoice', compact('no', 'data','direktur','invoice','ppn', 'jumlah', 'detail_order', 'total','informasi_perusahaan'));
    }
}
