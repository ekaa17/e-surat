<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Perusahaan;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Perusahaan::create([
            'nama_perusahaan' => 'PT. Contoh Satu',
            'alamat_perusahaan' => 'Jl. Contoh No. 1',
            'no_telpon' => '08123456789',
        ]);

        Perusahaan::create([
            'nama_perusahaan' => 'PT. Contoh Dua',
            'alamat_perusahaan' => 'Jl. Contoh No. 2',
            'no_telpon' => '08198765432',
        ]);
    }
}
