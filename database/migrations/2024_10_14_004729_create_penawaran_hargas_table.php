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
        Schema::create('penawaran_hargas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemesan');
            $table->unsignedBigInteger('id_produk');
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->string('no_surat')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penawaran_hargas');
    }
};
