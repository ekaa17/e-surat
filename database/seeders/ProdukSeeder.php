<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
            'nama_produk' => 'Product A',
            'alamat_perusahaan' => '123 Company St',
            'harga_produk' => 100000,
            'id_perusahaan' => 1, // Assuming perusahaan ID 1 exists
            'description' => 'Description of Product A',
            'unit' => 'PC',
        ]);

        Produk::create([
            'nama_produk' => 'Product B',
            'alamat_perusahaan' => '456 Business Ave',
            'harga_produk' => 150000,
            'id_perusahaan' => 2, // Assuming perusahaan ID 2 exists
            'description' => 'Description of Product B',
            'unit' => 'Box',
        ]);
    }
}
