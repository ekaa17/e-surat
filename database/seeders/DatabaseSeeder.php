<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([StaffSeeder::class,]);
        $this->call(PenawaranOrderSeeder::class);
        $this->call(InvoiceSeeder::class);
        $this->call(PerusahaanSeeder::class);
        $this->call(PemesanSeeder::class);
    }
}
