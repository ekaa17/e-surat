<?php

namespace Database\Seeders;

use App\Models\Pemesan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemesanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Pemesan::create([
            'nama_pemesan' => 'John Doe',
            'asal_pemesan' => 'New York',
            'alamat_perusahaan' => 'cilegon',
            'tanggal_pemesan' => '2023-10-01',
        ]);

        Pemesan::create([
            'nama_pemesan' => 'Jane Smith',
            'asal_pemesan' => 'Los Angeles',
            'alamat_perusahaan' => 'Warungkara',
            'tanggal_pemesan' => '2023-10-05',
        ]);
    }
}
