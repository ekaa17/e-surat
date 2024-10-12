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
        'tanggal_pemesan',
    ];
}
