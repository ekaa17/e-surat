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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('id_jabatan');
            $table->string('no_telepon');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role',['Admin','Karyawan']);
            $table->string('profile')->nullable();
            $table->string('tandatangan')->nullable();
            $table->timestamps();

            // Foreign key relation to the perusahaans table
            $table->foreign('id_jabatan')->references('id')->on('jabatans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
