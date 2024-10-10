<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranOrder extends Model
{
    use HasFactory;
    protected $table = 'PenawaranOrders';

    protected $fillable = [
        'purchase_no',
        'nama_perusahaan',
        'alamat_kirim',
        'quantity',
        'harga_satuan',
        'jumlah_amount'
    ];
}
