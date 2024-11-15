<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use Illuminate\Http\Request;

class PemesanController extends Controller
{
    public function index()
    {
        $no = 1;
        $pemesans = Pemesan::orderBy('nama_pemesan')->get();  // Perbaikan nama variabel menjadi $data_pelanggan
        $pemesan = Pemesan::count();
        return view('pages.data-pemesan.index', compact('no', 'pemesans','pemesan'));  // Konsistensi variabel di compact()
    }

    public function create()
    {
        return view('pages.data-pemesan.create'); 
    }

    // Menyimpan data pemesan baru
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255', 
            'asal_pemesan' => 'required|string|max:255', 
            'alamat_perusahaan' => 'required|string|max:255', 
            'no_po' => 'nullable|string|max:255', 
            'tanggal_pemesan' => 'required|date', 
        ]);

        // Menyimpan pemesan baru
        Pemesan::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('data-pemesan.index')->with('success', 'Pemesan berhasil ditambahkan.');
    }

    // Mengupdate data pemesan
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255', 
            'asal_pemesan' => 'required|string|max:255', 
            'alamat_perusahaan' => 'required|string|max:255', 
            'no_po' => 'nullable|string|max:255', 
            'tanggal_pemesan' => 'required|date', 
        ]);

        // Mencari pemesan berdasarkan ID dan mengupdate datanya
        $pemesan = Pemesan::findOrFail($id);
        $pemesan->update($validated); 

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('data-pemesan.index')->with('success', 'Data pemesan berhasil diperbarui.');
    }

    // Menghapus data pemesan
    public function destroy($id)
    {
        // Mencari pemesan berdasarkan ID dan menghapusnya
        $pemesan = Pemesan::findOrFail($id);
        $pemesan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('data-pemesan.index')->with('success', 'Pemesan berhasil dihapus.');
    }
}
