<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JabatanController extends Controller
{
    public function index()
    {
        $data = Jabatan::all(); // Mengambil semua data jabatan
        return view('pages.data-jabatan.index', compact('data'));
    }

    /**
     * Simpan data jabatan baru.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'nama_jabatan' => 'required|string|max:255'
        ]);

        // Simpan data ke database
        Jabatan::create([
            'nama_jabatan' => $request->jabatan
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('data-jabatan.index')->with('success', 'Data jabatan berhasil ditambahkan');
    }

    /**
     * Update data jabatan yang ada.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'nama_jabatan' => 'required|string|max:255'
        ]);

        // Cari jabatan berdasarkan ID dan update datanya
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->update([
            'jabatan' => $request->jabatan
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('data-jabatan.index')->with('success', 'Data jabatan berhasil diperbarui');
    }

    /**
     * Hapus data jabatan.
     */
    public function destroy($id)
    {
        // Cari jabatan berdasarkan ID dan hapus
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('data-jabatan.index')->with('success', 'Data jabatan berhasil dihapus');
    }
}
