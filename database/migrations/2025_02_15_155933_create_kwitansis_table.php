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
        Schema::create('kwitansis', function (Blueprint $table) {
            $table->id();
            $table->string('no_kwitansi')->unique();
            $table->foreignId('id_invoice')->constrained('invoices')->onDelete('cascade');
            // $table->foreignId('id_detail_invoice')->constrained('detail_invoices')->onDelete('cascade');
            $table->enum('status_pengajuan', ['Belum Disetujui', 'Disetujui']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kwitansis');
    }
};
