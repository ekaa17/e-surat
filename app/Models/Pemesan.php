<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model
{
    use HasFactory;

    protected $table = 'pemesans';

    protected $fillable = [
        'nama_pemesan',
        'asal_pemesan',
        'no_po',
        'alamat_perusahaan',
        'tanggal_pemesan',
    ];

    public function penawarans()
    {
        return $this->hasMany(PenawaranHarga::class, 'id_pemesan');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'id_pemesan');
    }
}
