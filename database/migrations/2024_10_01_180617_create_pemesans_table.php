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
        Schema::create('pemesans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesan');
            $table->string('asal_pemesan');
            $table->string('no_po')->nullable();
            $table->string('alamat_perusahaan');
            $table->date('tanggal_pemesan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesans');
    }
};
