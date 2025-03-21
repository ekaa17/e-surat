<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaans';
    
    protected $fillable = [
        'nama_perusahaan',
        'alamat_perusahaan',
        'no_telpon',
    ];

    public function penawaranorders()
    {
        return $this->hasMany(PenawaranOrder::class, 'id_perusahaan');
    }
}
