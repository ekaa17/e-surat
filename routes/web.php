<?php

use App\Http\Controllers\DetailinvoiceController;
use App\Http\Controllers\detailkwitansiController;
use App\Http\Controllers\DetailOrderController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KwitansiController;
use App\Http\Controllers\laporan_PHController;
use App\Http\Controllers\laporan_POController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemesanController;
use App\Http\Controllers\PenawaranHargaController;
use App\Http\Controllers\PenawaranOrderController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\reportPOController;
use App\Http\Controllers\SettingController;
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
    Route::resource('/data-kwitansi', KwitansiController::class)->names('data-kwitansi');
    Route::get('/setujui-surat-ph/{id}', [PenawaranHargaController::class, 'setujui']);
    Route::get('/setujui-surat-po/{id}', [PenawaranOrderController::class, 'setujui']);
    Route::get('/setujui-surat-invoice/{id}', [InvoiceController::class, 'setujui']);
    Route::get('/surat-penawaran-harga/{id}', [PenawaranHargaController::class, 'surat_ph']);
    Route::get('/surat-purchase-order/{id}', [PenawaranOrderController::class, 'surat_order']);
    Route::get('/surat-invoice/{id}', [InvoiceController::class, 'surat_invoice']);
    Route::get('/surat-kwitansi/{id}', [KwitansiController::class, 'surat_kwitansi']);
    Route::get('/validasi-surat-ph/{id}', [PenawaranHargaController::class, 'validasi']);
    Route::resource('/detail-data', DetailPesananController::class)->names('detail-data');
    Route::resource('/detail-order', DetailOrderController::class)->names('detail-order');
    Route::resource('/detail-invoice', DetailinvoiceController::class)->names('detail-invoice');
    Route::resource('/data-perusahaan', PerusahaanController::class)->names('data-perusahaan');
    Route::resource('/data-produk', ProdukController::class)->names('data-produk');
    Route::resource('/data-pemesan', PemesanController::class)->names('data-pemesan');
    Route::resource('/data-setting', SettingController::class)->names('data-setting');
    Route::resource('/data-jabatan', JabatanController::class)->names('data-jabatan');
    Route::resource('/laporan_PH', laporan_PHController::class)->names('laporan_PH');
    Route::get('/surat_report_PH', [laporan_PHController::class, 'Laporan_PH'])->name('laporan_PH');
    Route::resource('/laporan_PO', laporan_POController::class)->names('laporan_PO');
    // Route::get('/surat_report_PO', [laporan_POController::class, 'Laporan_PO']);
    Route::get('/surat_report_PO', [laporan_POController::class, 'laporan_PO'])->name('laporan_PO');

    
    
});
Route::group(['middleware' => 'cekrole:Karyawan'], function() {
    
});