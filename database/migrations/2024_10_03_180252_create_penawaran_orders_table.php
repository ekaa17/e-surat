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
            $table->unsignedBigInteger('id_perusahaan');
            $table->string('bukti')->nullable(); // Bukti
            $table->string('ppn'); // PPN (Persentase, DECIMAL dengan 5 digit dan 2 desimal)
            $table->date('waktu_penyerahan_barang'); // Waktu Penyerahan Barang
            $table->date('waktu_pembayaran'); // Waktu Pembayaran
            $table->enum('status_pengajuan', ['Belum Disetujui', 'Disetujui']);
            $table->timestamps();


            // Foreign key constraints
            $table->foreign('id_penawaran')->references('id')->on('penawaran_hargas')->onDelete('set null');
            $table->foreign('id_perusahaan')->references('id')->on('perusahaans')->onDelete('cascade');
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
