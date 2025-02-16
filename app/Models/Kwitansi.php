<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model
{
    use HasFactory;
    
    protected $table = 'kwitansis';

    protected $fillable = [
        'no_kwitansi',
        'id_invoice',        
        // 'id_detail_invoice'

    ];

    // public function detail_invoice()
    // {
    //     return $this->belongsTo(DetailInvoice::class, 'id_detail_invoice');
    // }

    public function invoice()
    {
        return $this->belongsTo(invoice::class, 'id_invoice');
    }
}
