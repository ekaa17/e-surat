<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Pemesan;
use App\Models\PenawaranHarga;
use App\Models\PenawaranOrder;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Pastikan Anda memiliki view login.blade.php
    }

    public function dashboard()
    {
        $total_staff = Staff::count();
        $total_PO = PenawaranOrder::count();
        $total_PH = PenawaranHarga::count();
        $total_pemesan = Pemesan::count();
        $total_perusahaan = Perusahaan::count();
        $total_invoice = Invoice::count();
        // Your logic here, e.g., returning a view
        return view('pages.dashboard', compact('total_staff','total_PO','total_PH','total_invoice','total_pemesan','total_perusahaan'));
    }

    public function login(Request $request) {
        // dd($request);
        $request->validate([
            'email' => 'required',
            'password'=> 'required' 
         ], [
            'email.required' => 'Kolom Email tidak boleh kosong.',
            'password.required' => 'Kolom Password tidak boleh kosong.',
        ]);


        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            if ($user->role === 'Admin' || $user->role === 'Karyawan') {
                return redirect('/dashboard');
            } else {
                return redirect('/')->with('wrong', 'Role tidak Ditemukan !');
            }
        } else {
            return redirect('/login')->with('wrong', 'Email dan password tidak tersedia');
        }
    }

    public function logout() {
        if (Auth::check()) {
            $role = Auth::user()->role;
    
           if ($role === 'Admin' || $role === 'Karyawan') {
                Auth::logout();
            }
        } 
        return redirect('/');
    }

}
