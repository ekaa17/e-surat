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
        return view('pages.data-pemesan.create'); // Arahkan ke view form create
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required',
            'asal_pemesan' => 'required',
            'tanggal_pemesan' => 'required|date',
        ]);

        Pemesan::create($request->all());
        return redirect()->route('data-pemesan.index')->with('success', 'Pemesan created successfully.');
    }

        public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pemesan' => 'required',
            'asal_pemesan' => 'required',
            'tanggal_pemesan' => 'required|date',
        ]);

        $pemesan = Pemesan::findOrFail($id);
        $pemesan->update($validated);

        return redirect()->route('data-pemesan.index')->with('success', 'Data pemesan berhasil diperbarui.');
    }

        public function destroy($id)
        {
            $data_pelanggan = Pemesan::findOrFail($id);
            $data_pelanggan->delete();

            return redirect()->route('data-pemesan.index')->with('success', 'Produk berhasil dihapus.');
        }
}
