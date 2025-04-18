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
        Schema::create('detailorders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_order')->nullable()->constrained('penawaranorders')->onDelete('cascade');
            $table->foreignId('id_produk')->constrained('produks')->onDelete('cascade');
            $table->integer('quantity'); // Mengubah menjadi integer untuk nilai hingga 8000
            $table->decimal('total', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailorders');
    }
};
