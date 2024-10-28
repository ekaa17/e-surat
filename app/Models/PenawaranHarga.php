<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranHarga extends Model
{
    use HasFactory;

    protected $table = 'penawaran_hargas';

    protected $fillable = [
        'id_pemesan',
        'id_produk',
        'quantity',
        'total',
        'no_surat',
    ];

    // Relasi dengan model lain jika diperlukan
    public function pemesan()
    {
        return $this->belongsTo(Pemesan::class, 'id_pemesan');
    }

    public function penawaranorders()
    {
        return $this->hasMany(PenawaranOrder::class, 'id_penawaran');
    }
}
