<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // $no = 1;
        $perusahaans = Setting::all();
        $setting = Setting::count();
        return view('pages.data-setting.index', compact('perusahaans','setting'));
    }

    public function create()
    {
        return view('pages.data-setting.create');
    }

    // Menyimpan data perusahaan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'bidang' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
            'no_rek' => 'required',
            'jenis_bank' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $imageName = now()->format('YmdHis') . $request->email . '.' . $logo->extension();
            $logo->move(public_path('assets/img/logo/'), $imageName);
           } else {
            $imageName=null;
           }

        Setting::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'bidang' => $request->bidang,
            'alamat' => $request->alamat,
            'no_telpon' => $request->no_telpon,
            'fax' => $request->fax,
            'email' => $request->email,
            'no_rek' => $request->no_rek,
            'jenis_bank' => $request->jenis_bank,
            'logo' => $logo,
        ]);

        return redirect()->route('data-setting.index')->with('success', 'Setting created successfully.');
    }

    // Menampilkan form edit perusahaan
    public function edit($id)
    {
        $perusahaan = Setting::findOrFail($id);
        return view('pages.data-setting.edit', compact('perusahaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'bidang' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
            'no_rek' => 'required',
            'jenis_bank' => 'required',
        ]);

        $perusahaan = Setting::findOrFail($id);
        $perusahaan->update($request->all());

        return redirect()->route('data-setting.index')->with('success', 'Setting berhasil diperbarui');
    }

    // Hapus perusahaan
    public function destroy($id)
    {
        $perusahaan = Setting::findOrFail($id);
        $perusahaan->delete();

        return redirect()->route('data-setting.index')->with('success', 'Setting berhasil dihapus');
    }
}
