<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $no = 1;
        $data = Staff::orderBy('name')->get();
        $karyawan = Staff::where('role','Karyawan')->count();
        $admin = Staff::where('role','Admin')->count();
        return view('pages.data-staff.index', compact('no', 'data', 'karyawan', 'admin'));
    }

    public function create()
    {
        return view('pages.data-staff.create'); // Arahkan ke view form create
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'jabatan' => 'required',
            'no_telepon' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);

       if ($request->hasFile('profile')) {
        $profile = $request->file('profile');
        $imageName = now()->format('YmdHis') . $request->email . '.' . $profile->extension();
        $profile->move(public_path('assets/img/profile/'), $imageName);
       } else {
        $imageName=null;
       }

        Staff::create([
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'role' => $request->role,
            'profile' => $imageName ,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('data-staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Temukan user berdasarkan ID
        $user = Staff::findOrFail($id);
        // Arahkan ke view form edit dan kirimkan data user yang ditemukan
        return view('pages.data-staff.edit', compact('user'));
    }
    
    public function update(Request $request, $id)
    {
        // dd($request);
        // Validasi input
        $request->validate([
            'name' => 'required',
            'jabatan' => 'required',
            'no_telepon' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
    
        // Temukan user berdasarkan ID
        $user = Staff::findOrFail($id);
    
        // Jika ada file profile diupload
        if ($request->hasFile('profile')) {
            // Upload dan ganti gambar profil
            $profile = $request->file('profile');
            $imageName = now()->format('YmdHis') . $request->email . '.' . $profile->extension();
            $profile->move(public_path('assets/img/profile/'), $imageName);
    
            // Hapus file profil lama jika ada
            if ($user->profile) {
                $oldProfile = public_path('assets/img/profile/') . $user->profile;
                if (file_exists($oldProfile)) {
                    unlink($oldProfile);
                }
            }
        } else {
            // Jika tidak ada upload, gunakan profil lama
            $imageName = $user->profile;
        }
    
        // Update data user
        $user->update([
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'role' => $request->role,
            // Hanya update password jika diisi
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
    
        // Redirect kembali ke index data staff dengan pesan sukses
        return redirect()->route('data-staff.index')->with('success', 'Data staff berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan staff berdasarkan ID
        $user = Staff::findOrFail($id);

        // Hapus staff
        $user->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('data-staff.index')->with('success', 'Staff deleted successfully.');
    }

}

