<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PenawaranHarga;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StaffSeeder::class,
            // PenawaranOrderSeeder::class,
            // InvoiceSeeder::class,
            PerusahaanSeeder::class,
            PemesanSeeder::class,
            SettingSeeder::class,
            ProdukSeeder::class,
            PenawaranHargaSeeder::class
        ]);
    }
}
