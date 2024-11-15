<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranOrder extends Model
{
    use HasFactory;
    protected $table = 'penawaranorders';

    protected $fillable = [
        'id_produk',
        'id_penawaran',
        'nomor_surat',
        'quantity',
        'total',
        'lokasi_gudang',
        'bukti',
        'waktu_penyerahan_barang',
        'id_perusahaan',
        'waktu_pembayaran',
        'ppn',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function penawaran()
    {
        return $this->belongsTo(PenawaranHarga::class, 'id_penawaran');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }

}
