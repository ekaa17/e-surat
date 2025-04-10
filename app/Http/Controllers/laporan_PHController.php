<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Pemesan;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\PenawaranHarga;
use App\Models\DetailPenawaran;
use App\Http\Controllers\Controller;
use App\Models\Produk;

class laporan_PHController extends Controller
{
    public function index(Request $request)
    {
        $no = 1;
        $data_Harga = PenawaranHarga::with('pemesan')->get();
        $pemesan = Pemesan::all(); 
        $penawaran = PenawaranHarga::all(); 
        $detail_pemesanan = DetailPenawaran::all();
        $query = PenawaranHarga::query();

    if ($request->filled('bulan')) {
        $query->whereMonth('created_at', $request->bulan);
    }

    if ($request->filled('tahun')) {
        $query->whereYear('created_at', $request->tahun);
    }

    $data_Harga = $query->get();
        return view('pages.laporan.laporan_PH', compact('data_Harga', 'pemesan','detail_pemesanan'));
    }

   

    

    public function Laporan_PH(Request $request) {
        $no = 1;
        $data_Harga = PenawaranHarga::all();
        $data_show = DetailPenawaran::all();
        $data = PenawaranHarga::all();
        // $detail_data = DetailPenawaran::where('id_penawaran', $id)->get();
        // $total = DetailPenawaran::where('id_penawaran', $id)->sum('total');
        $informasi_perusahaan = Setting::where('id', 1)->first();
        $direktur = Staff::where('role', 'Karyawan')->first();

        // Mulai query dari PenawaranOrder
        $query = PenawaranHarga::query();
    
        // Tambahkan filter bulan jika ada
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }
    
        // Tambahkan filter tahun jika ada
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }
    
        // Ambil hasil query setelah filter
        $data = $query->get();
    
        
        return view('pages.surat_report.surat_report_PH', compact('no', 'data','data_show','data_Harga',  'informasi_perusahaan', 'direktur'));
    }


   

    public function surat_ph($id) {
        $no = 1;
        $penawaran = PenawaranHarga::all();
        $data = PenawaranHarga::all();
        $informasi_perusahaan = Setting::where('id', 1)->first();
        $direktur = Staff::where('role', 'Karyawan')->first();
        return view('pages.laporan.laporan_PH', compact('no', 'data','penawaran','informasi_perusahaan', 'direktur'));
    }
}
