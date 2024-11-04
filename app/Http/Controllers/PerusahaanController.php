<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $no = 1;
        $perusahaans = Perusahaan::orderBy('nama_perusahaan')->get();  // Perbaikan nama variabel menjadi $data_pelanggan
        $jumlahperusahaan = Perusahaan::count();
        return view('pages.data-perusahaan.index', compact('no', 'perusahaans','jumlahperusahaan'));  // Konsistensi variabel di compact()
    }

    public function create()
    {
        return view('pages.data-perusahaan.create'); // Arahkan ke view form create
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'no_telpon' => 'required',
        ]);

        Perusahaan::create($request->all());
        return redirect()->route('data-perusahaan.index')->with('success', 'Perusahaan created successfully.');
    }

        public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'no_telpon' => 'required',
        ]);

        $pelanggan = Perusahaan::findOrFail($id);
        $pelanggan->update($validated);

        return redirect()->route('data-perusahaan.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

        public function destroy($id)
        {
            $data_pelanggan = Perusahaan::findOrFail($id);
            $data_pelanggan->delete();

            return redirect()->route('data-perusahaan.index')->with('success', 'Produk berhasil dihapus.');
        }
}
