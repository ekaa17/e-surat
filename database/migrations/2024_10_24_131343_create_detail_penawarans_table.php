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
        Schema::create('detail_penawarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk')->references('id')->on('produks')->onDelete('cascade');
            $table->foreignId('id_penawaran')->references('id')->on('penawaran_hargas')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penawarans');
    }
};
