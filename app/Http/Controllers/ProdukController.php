<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        // $no = 1;
        // $penawaranOrders = Perusahaan::orderBy('purchase_no')->get();
        
        // Mengirim data ke view 'pages.data-PO.index'
        return view('pages.data-produk.index');
    }
}
