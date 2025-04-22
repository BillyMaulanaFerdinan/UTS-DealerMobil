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
        Schema::create('mobil', function (Blueprint $table) {
            $table->id("mobil_id");
            $table->string('merek');
            $table->string('nama');
            $table->string('kode_mesin')->unique();
            $table->string('warna');
            $table->enum('kondisi', ['Baru', 'Bekas']);
            $table->integer('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobil');
    }
};
