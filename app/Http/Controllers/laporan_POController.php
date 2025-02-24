<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Setting;
use App\Models\Perusahaan;
use App\Models\Detailorder;
use Illuminate\Http\Request;
use App\Models\PenawaranHarga;
use App\Models\PenawaranOrder;
use App\Models\DetailPenawaran;
use App\Http\Controllers\Controller;

class laporan_POController extends Controller
{
    public function index(Request $request)
    {
        $no = 1;
        $orders = PenawaranOrder::with('penawaran')->get();
        $penawaran = PenawaranHarga::all(); 
        $perusahaans = Perusahaan::all();
        // Mengirim data ke view 'pages.data-PO.index'
        $query = PenawaranOrder::query();

    if ($request->filled('bulan')) {
        $query->whereMonth('created_at', $request->bulan);
    }

    if ($request->filled('tahun')) {
        $query->whereYear('created_at', $request->tahun);
    }

    $orders = $query->get();
        return view('pages.laporan.laporan_PO', compact('no','orders','penawaran','perusahaans'));
    }


    public function Laporan_PO(Request $request) {
        $no = 1;
        $data_show = Detailorder::all();
        $data = PenawaranOrder::all();
        $informasi_perusahaan = Setting::where('id', 1)->first();
        $direktur = Staff::where('role', 'Karyawan')->first();
        
        // Mulai query dari PenawaranOrder
        $query = PenawaranOrder::query();
    
        // Tambahkan filter bulan jika ada
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }
    
        // Tambahkan filter tahun jika ada
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }
    
        // Ambil hasil query setelah filter
        $orders = $query->get();
    
        // Kirim data ke view
        return view('pages.surat_report.surat_report_PO', compact('no', 'data', 'data_show', 'orders', 'informasi_perusahaan', 'direktur'));
    }
}
