<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
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
                'id_produk' => rand(1,2),
                'id_penawaran' => rand(1,2),
                'nomor_surat' => 'NS-001',
                'quantity' => 10,
                'no_invoice' => 'INV-001',
                'total' => 100000.00,
                'lokasi_gudang' => 'Gudang Jakarta',
                'bukti' => 'bukti1.jpg',
                'waktu_penyerahan_barang' => Carbon::now()->addDays(5),
                'waktu_pembayaran' => Carbon::now()->addDays(30),
                'ppn' => 10.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_produk' => rand(1,2),
                'id_penawaran' => rand(1,2),
                'nomor_surat' => 'NS-002',
                'quantity' => 5,
                'no_invoice' => 'INV-002',
                'total' => 50000.00,
                'lokasi_gudang' => 'Gudang Surabaya',
                'bukti' => 'bukti2.jpg',
                'waktu_penyerahan_barang' => Carbon::now()->addDays(7),
                'waktu_pembayaran' => Carbon::now()->addDays(25),
                'ppn' => 10.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
