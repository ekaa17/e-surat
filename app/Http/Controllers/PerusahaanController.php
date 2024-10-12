<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        // $no = 1;
        // $penawaranOrders = Perusahaan::orderBy('purchase_no')->get();
        
        // Mengirim data ke view 'pages.data-PO.index'
        return view('pages.data-perusahaan.index');
    }
}
