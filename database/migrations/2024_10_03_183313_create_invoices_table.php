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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->unique();
            $table->foreignId('id_pemesan')->constrained('pemesans')->onDelete('cascade');
            $table->string('status')->default('Pending');
            $table->enum('status_pengajuan', ['Belum Disetujui', 'Disetujui']);
            $table->string('ppn');
            $table->string('bukti_transaksi')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
