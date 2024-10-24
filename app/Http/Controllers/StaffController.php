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
    // Validasi input
    $request->validate([
        'name' => 'required',
        'jabatan' => 'required',
        'no_telepon' => 'required',
        'email' => 'required|unique:staff,email',
        'role' => 'required',
        'password' => 'required',
        'profile' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional: untuk validasi profile
        'tandatangan' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Optional: validasi tanda tangan
    ]);

    // Upload profile jika ada
    if ($request->hasFile('profile')) {
        $profile = $request->file('profile');
        $imageName = now()->format('YmdHis') . $request->email . '.' . $profile->extension();
        $profile->move(public_path('assets/img/profile/'), $imageName);
    } else {
        $imageName = null;
    }

    // Upload tanda tangan jika ada
    if ($request->hasFile('tandatangan')) {
        $tandatangan = $request->file('tandatangan');
        $tandatanganName = now()->format('YmdHis') . '_tandatangan_' . $request->email . '.' . $tandatangan->extension();
        $tandatangan->move(public_path('assets/img/tandatangan/'), $tandatanganName);
    } else {
        $tandatanganName = null;
    }

    // Buat staff baru
    Staff::create([
        'name' => $request->name,
        'jabatan' => $request->jabatan,
        'no_telepon' => $request->no_telepon,
        'email' => $request->email,
        'role' => $request->role,
        'profile' => $imageName,
        'tandatangan' => $tandatanganName, // Menyimpan tanda tangan
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
    // Validasi input
    $request->validate([
        'name' => 'required',
        'jabatan' => 'required',
        'no_telepon' => 'required',
        'email' => 'required',
        'role' => 'required',
        'profile' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional: untuk validasi profile
        'tandatangan' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Optional: validasi tanda tangan
    ]);

    // Temukan user berdasarkan ID
    $user = Staff::findOrFail($id);

    // Upload profile jika ada
    if ($request->hasFile('profile')) {
        $profile = $request->file('profile');
        $imageName = now()->format('YmdHis') . $request->email . '.' . $profile->extension();
        $profile->move(public_path('assets/img/profile/'), $imageName);

        // Hapus profile lama
        if ($user->profile) {
            $oldProfile = public_path('assets/img/profile/') . $user->profile;
            if (file_exists($oldProfile)) {
                unlink($oldProfile);
            }
        }
    } else {
        $imageName = $user->profile;
    }

    // Upload tanda tangan jika ada
    if ($request->hasFile('tandatangan')) {
        $tandatangan = $request->file('tandatangan');
        $tandatanganName = now()->format('YmdHis') . '_tandatangan_' . $request->email . '.' . $tandatangan->extension();
        $tandatangan->move(public_path('assets/img/tandatangan/'), $tandatanganName);

        // Hapus tanda tangan lama
        if ($user->tandatangan) {
            $oldTandatangan = public_path('assets/img/tandatangan/') . $user->tandatangan;
            if (file_exists($oldTandatangan)) {
                unlink($oldTandatangan);
            }
        }
    } else {
        $tandatanganName = $user->tandatangan;
    }

    // Update data user
    $user->update([
        'name' => $request->name,
        'jabatan' => $request->jabatan,
        'no_telepon' => $request->no_telepon,
        'email' => $request->email,
        'role' => $request->role,
        'profile' => $imageName,
        'tandatangan' => $tandatanganName, // Update tanda tangan
        'password' => $request->password ? Hash::make($request->password) : $user->password,
    ]);

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

