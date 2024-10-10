<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenawaranHargaController;
use App\Http\Controllers\PenawaranOrderController;
use App\Http\Controllers\StaffController;
use App\Models\Invoice;
use App\Models\PenawaranOrder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpage');
});

// Route untuk menampilkan halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk menangani login dengan metode POST
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Route untuk logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'cekrole:Admin,Karyawan'], function() {
    Route::get('/dashboard', [LoginController::class, 'dashboard']);
    Route::resource('/data-staff', StaffController::class)->names('data-staff');
    Route::resource('/data-PO', PenawaranOrderController::class)->names('data-PO');
    Route::resource('/data-invoice', InvoiceController::class)->names('data-invoice');
    Route::resource('/data-PH', PenawaranHargaController::class)->names('data-PH');
    
});
Route::group(['middleware' => 'cekrole:Karyawan'], function() {
    
});