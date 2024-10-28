<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'nama_perusahaan' => 'PT. Indokarya Jasa',
            'bidang' => 'Tambang',
            'alamat' => 'Jalan Raya No. 123, Jakarta',
            'no_telpon' => '021-1234567',
            'fax' => '021-7654321',
            'email' => 'info@shinacorp.com',
            'no_rek' => '1234567890',
            'jenis_bank' => 'Bank Mandiri',
            'logo' => 'logo.png',
        ]);
    }
}
