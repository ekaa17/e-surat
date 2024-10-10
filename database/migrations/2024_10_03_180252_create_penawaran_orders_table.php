<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penawaranorders', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_no');
            $table->string('nama_perusahaan');
            $table->string('Alamat_kirim');
            $table->string('quantity');
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('jumlah_amount', 15, 2);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penawaran_orders');
    }
};
