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
        Schema::create('kualifikasi_teoris', function (Blueprint $table) {
            $table->increments('id_kualifikasiTeori');
            $table->integer('nik');
            $table->date('tanggal_kualifikasi');
            $table->integer('nilai');
            $table->string('hasil');
            $table->date('tanggal_rekualifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kualifikasi_teoris');
    }
};
