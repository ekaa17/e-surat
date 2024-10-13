<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    public function index()
    {

        $products = Produk::with('perusahaan')->get();
        return view('pages.data-produk.index', compact('products'));
    }

    public function create()
    {
        $perusahaans = Perusahaan::all(); // Fetch all companies to assign to the product
        return view('pages.data-produk.create', compact('perusahaans'));
    }

    // Store a newly created product in the database
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string|max:255',
            'harga_produk' => 'required|numeric',
            'id_perusahaan' => 'required|exists:perusahaans,id',
            'description' => 'nullable|string',
            'unit' => 'required|integer',
        ]);

        // Create the product
        Produk::create($request->all());

        return redirect()->route('pages.data-produk.index')->with('success', 'Product created successfully.');
    }

    // Show the form for editing the specified product
    public function edit($id)
{
    $product = Produk::findOrFail($id);
    $perusahaans = Perusahaan::all(); // If you are fetching related companies
    return view('pages.data-produk.edit', compact('product', 'perusahaans'));
}

    // Update the specified product in the database
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string|max:255',
            'harga_produk' => 'required|numeric',
            'id_perusahaan' => 'required|exists:perusahaans,id',
            'description' => 'nullable|string',
            'unit' => 'required|integer',
        ]);

        // Find the product and update it
        $product = Produk::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('data-produk.index')->with('success', 'Product updated successfully.');
    }

    // Remove the specified product from the database
    public function destroy($id)
    {
        $product = Produk::findOrFail($id);
        $product->delete();

        return redirect()->route('data-produk.index')->with('success', 'Product deleted successfully.');
    }
}
