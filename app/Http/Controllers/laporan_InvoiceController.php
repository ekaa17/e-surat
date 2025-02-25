<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Invoice;
use App\Models\Pemesan;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\DetailInvoice;
use App\Http\Controllers\Controller;

class laporan_InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $no = 1;
        $invoices = Invoice::with('pemesan')->get();
        $pemesan = Pemesan::all(); 
        $invoicecount = invoice::count();
        // Mengirim data ke view 'pages.data-PO.index'
        $query = Invoice::query();

        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $invoices = $query->get();
        return view('pages.laporan.laporan_Invoice', compact('invoices', 'pemesan','invoicecount'));
    }


    public function laporan_Invoice(Request $request) {
        $no = 1;
        $invoices = Invoice::all();
        $data_show = DetailInvoice::all();;
        $informasi_perusahaan = Setting::where('id', 1)->first();
        $direktur = Staff::where('role', 'Karyawan')->first();
        
        // Mulai query dari PenawaranOrder
        $query = Invoice::query();
    
        // Tambahkan filter bulan jika ada
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }
    
        // Tambahkan filter tahun jika ada
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }
    
        // Ambil hasil query setelah filter
        $invoices = $query->get();
        return view('pages.surat_report.surat_report_Invoice', compact('no', 'data_show','direktur','invoices','informasi_perusahaan'));
    }
}
