<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $fillable = [
        'nama_produk',
        'alamat_perusahaan',
        'harga_produk',
        'id_perusahaan',
        'description',
        'unit'
    ];

    // Define the relationship with Perusahaan model
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }

    public function penawarans()
    {
        return $this->hasMany(PenawaranHarga::class, 'id_produk');
    }

    public function penawaranorders()
    {
        return $this->hasMany(PenawaranOrder::class, 'id_produk');
    }
}
