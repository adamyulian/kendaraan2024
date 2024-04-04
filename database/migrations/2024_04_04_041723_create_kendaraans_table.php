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
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('nopol')->nullable();
            $table->string('opd')->nullable();
            $table->string('tahun')->nullable();
            $table->string('merk')->nullable();
            $table->string('tipe')->nullable();
            $table->string('lokasi')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->boolean('kunci_mobil')->nullable();
            $table->boolean('stnk')->nullable();
            $table->boolean('dongkrak')->nullable();
            $table->boolean('kunci_ban')->nullable();
            $table->boolean('ban_serep')->nullable();
            $table->boolean('headunit')->nullable();
            $table->string('foto_kendaraan')->nullable();
            $table->date('tgl_keluar')->nullable();
            $table->string('lokasi_new')->nullable();
            $table->boolean('lepas_aki')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
