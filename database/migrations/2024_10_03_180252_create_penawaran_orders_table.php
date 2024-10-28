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
            $table->id(); // Primary key ID untuk PO
            $table->string('nomor_surat')->nullable(); // Nomor Surat (Nullable)
            $table->string('lokasi_gudang'); // Lokasi Gudang
            $table->unsignedBigInteger('id_penawaran')->nullable(); // ID Penawaran (Nullable FK)
            $table->string('bukti'); // Bukti
            $table->decimal('ppn', 5, 2); // PPN (Persentase, DECIMAL dengan 5 digit dan 2 desimal)
            $table->dateTime('waktu_penyerahan_barang'); // Waktu Penyerahan Barang
            $table->dateTime('waktu_pembayaran'); // Waktu Pembayaran
            $table->timestamps();


            // Foreign key constraints
            $table->foreign('id_penawaran')->references('id')->on('penawaran_hargas')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penawaranorders');
    }
};
