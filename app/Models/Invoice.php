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
        'id_pemesan',
        'status',
        'ppn',
        'bukti_transaksi',
    ];

    public function pemesan()
    {
        return $this->belongsTo(Pemesan::class, 'id_pemesan');
    }

    /**
     * Get the order that owns the invoice.
     */
}
