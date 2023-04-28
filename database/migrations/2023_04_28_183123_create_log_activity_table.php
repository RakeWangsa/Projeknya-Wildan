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
        Schema::create('logActivity', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('id_pesanan');
            $table->string('nama');
            $table->string('id_pemesan');
            $table->string('activity');
            $table->string('lokasi')->nullable();
            $table->string('tujuan')->nullable();
            $table->datetime('waktu')->nullable();
            $table->string('kendaraan')->nullable();
            $table->string('jenis')->nullable();
            $table->datetime('tanggal_pulang')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('kontak')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logActivity');
    }
};
