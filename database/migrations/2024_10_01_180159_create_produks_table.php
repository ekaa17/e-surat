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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('alamat_perusahaan');
            $table->decimal('harga_produk', 10, 2); // decimal for price, 10 digits, 2 decimals
            $table->unsignedBigInteger('id_perusahaan'); // assuming 'perusahaans' table exists
            $table->text('description');
            $table->integer('unit');
            $table->timestamps();

            // Foreign key relation to the perusahaans table
            $table->foreign('id_perusahaan')->references('id')->on('perusahaans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
