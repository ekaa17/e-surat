<?php

namespace App\Http\Controllers;

use App\Models\PenawaranHarga;
use Illuminate\Http\Request;

class PenawaranHargaController extends Controller
{
    public function index()
    {
        $no = 1;
        $data_Harga = PenawaranHarga::orderBy('nama_pt')->get();
        return view('pages.data-PH.index', compact('no', 'data_Harga'));
    }
}
