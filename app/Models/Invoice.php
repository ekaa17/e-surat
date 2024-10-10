<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
   
    use HasFactory;
    protected $table = 'Invoices';

    protected $fillable = [
        'bill_to',
        'no_invoice',
        'po_number',
        'description',
        'unit_price',
        'quantity',
        'unit',
        'amount',
        'subtotal',
        'ppn',
        'total',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'ppn' => 'decimal:2',
        'total' => 'decimal:2',
    ];
}
