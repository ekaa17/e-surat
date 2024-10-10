<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenawaranOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penawaranorders')->insert([
            [
                'purchase_no' => 'PO001',
                'nama_perusahaan' => 'PT ABC',
                'alamat_kirim' => 'Jl. Sudirman No. 123, Jakarta',
                'quantity' => 10,
                'harga_satuan' => 50000.00,
                'jumlah_amount' => 500000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purchase_no' => 'PO002',
                'nama_perusahaan' => 'PT XYZ',
                'alamat_kirim' => 'Jl. Thamrin No. 45, Jakarta',
                'quantity' => 20,
                'harga_satuan' => 75000.00,
                'jumlah_amount' => 1500000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
