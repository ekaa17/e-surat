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
            $table->foreignId('id_pemesan')->references('id')->on('pemesans')->onDelete('cascade');
            $table->string('no_surat')->nullable();
            $table->enum('status_pengajuan', ['belum disetujui', 'disetujui']);
            $table->enum('status_validity', ['belum divalidasi', 'divalidasi']);
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
