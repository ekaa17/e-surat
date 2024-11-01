<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
   
    use HasFactory;
    protected $table = 'Invoices';

    protected $fillable = [
        'no_surat',
        'id_penawaran',
        'id_order',
        'status',
        'bukti_transaksi',
    ];

    public function penawaran()
    {
        return $this->belongsTo(PenawaranHarga::class, 'id_penawaran');
    }

    /**
     * Get the order that owns the invoice.
     */
    public function order()
    {
        return $this->belongsTo(PenawaranOrder::class, 'id_order');
    }
}
