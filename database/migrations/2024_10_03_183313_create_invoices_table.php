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
            $table->string('bill_to');
            $table->string('no_invoice');
            $table->string('po_number');
            $table->string('description');
            $table->string('unit_price');
            $table->string('quantity');
            $table->string('unit');
            $table->decimal('amount');
            $table->decimal('subtotal');
            $table->decimal('ppn');
            $table->decimal('total');
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
