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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama');
            $table->string('id_pemesan');
            $table->string('lokasi');
            $table->string('tujuan');
            $table->datetime('waktu');
            $table->string('kendaraan');
            $table->string('jenis');
            $table->string('durasi')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('kontak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
