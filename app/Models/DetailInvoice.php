<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInvoice extends Model
{
    use HasFactory;

    
    protected $table = 'detail_invoices';

    protected $fillable = [
        'id_invoice',
        'id_produk',
        'quantity',
        'total'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
