<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('invoices')->insert([
            [
                'bill_to' => 'PT ABC',
                'no_invoice' => 'INV-001',
                'po_number' => 'PO-1234',
                'description' => 'Penjualan Barang A',
                'unit_price' => '50000',
                'quantity' => '10',
                'unit' => 'pcs',
                'amount' => '500000',
                'subtotal' => '500000',
                'ppn' => '50000',
                'total' => '550000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bill_to' => 'PT XYZ',
                'no_invoice' => 'INV-002',
                'po_number' => 'PO-5678',
                'description' => 'Penjualan Barang B',
                'unit_price' => '75000',
                'quantity' => '5',
                'unit' => 'pcs',
                'amount' => '375000',
                'subtotal' => '375000',
                'ppn' => '37500',
                'total' => '412500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
