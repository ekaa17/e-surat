<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailorder extends Model
{
    use HasFactory;

    protected $table = 'detailorders';

    protected $fillable = [
        'id_order',
        'id_produk',
        'quantity',
        'total'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

}
