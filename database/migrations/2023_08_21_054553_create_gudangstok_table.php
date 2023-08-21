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
        Schema::create('gudangstok', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gudang_id');
            $table->unsignedBigInteger('barang_id');
            $table->integer('stok');
            $table->timestamps();

            $table->foreign('gudang_id')->references('id')->on('gudang');
            $table->foreign('barang_id')->references('id')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gudangstok');
    }
};
