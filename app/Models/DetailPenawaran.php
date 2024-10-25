<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenawaran extends Model
{
    use HasFactory;

    protected $table = 'detail_penawarans';

    protected $fillable = [
        'id_penawaran',
        'id_produk',
        'quantity',
        'total'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
