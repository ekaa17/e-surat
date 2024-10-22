<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenawaranHargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penawaran_hargas')->insert([
            [
                'id_pemesan' => rand(1,2),
                'id_produk' => rand(1,2),
                'quantity' => 10,
                'total' => 500000.00,
                'status_pengajuan' => 'belum disetujui',
                'status_validity' => 'belum divalidasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pemesan' => rand(1,2),
                'id_produk' => rand(1,2),
                'quantity' => 10,
                'total' => 800000.00,
                'status_pengajuan' => 'belum disetujui',
                'status_validity' => 'belum divalidasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
