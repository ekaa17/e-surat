<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{
    public function index()
    {
        $no = 1;
        $data = Pegawai::all();
        $jabatans = Jabatan::all();
        $pegawai = Pegawai::with('jabatan')->get();
        return view('pages.data-pegawai.index', compact('no','pegawai', 'data','jabatans'));
    }


    public function create()
    {
        $jabatans = Jabatan::all(); // Fetch all companies to assign to the product
        // dd($jabatans);
        return view('pages.data-pegawai.create', compact('jabatans')); // Arahkan ke view form create
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_jabatan' => 'required|exists:jabatans,id',
            'no_telp' => 'nullable|string|max:15',
            'email' => 'required|email|unique:pegawais,email',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
        ]);

        Pegawai::create($request->all());

        return redirect()->route('data-pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_jabatan' => 'required|exists:jabatans,id',
            'no_telp' => 'nullable|string|max:15',
            'email' => 'required|email|unique:pegawais,email,' . $id,
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
        ]);
        
        $pegawai->update($request->all());

        return redirect()->route('data-pegawai.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('data-pegawai.index')->with('success', 'Data pegawai berhasil dihapus!');
    }
}
