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
        Schema::create('detail_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_invoice')->nullable()->change();
            $table->foreignId('id_produk')->references('id')->on('produks')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('total', 15, 2);
            $table->timestamps();

            $table->foreignId('id_invoice')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_invoices');
    }
};
