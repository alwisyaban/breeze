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
        Schema::create('kualifikasi_gownings', function (Blueprint $table) {
            $table->increments('id_kualifikasiGowning');
            $table->integer('nik');
            $table->string('jenis_kualifikasi');
            $table->date('tanggal_kualifikasi');
            $table->integer('dahi')->default(0);
            $table->integer('muka_ka')->default(0);
            $table->integer('muka_ki')->default(0);
            $table->integer('dada_ka')->default(0);
            $table->integer('dada_ki')->default(0);
            $table->integer('lengan_ka')->default(0);
            $table->integer('lengan_ki')->default(0);
            $table->integer('finger_ka')->default(0);
            $table->integer('finger_ki')->default(0);
            $table->string('hasil');
            $table->date('tanggal_rekualifikasi');
            $table->timestamps();

            $table->foreign('nik')->references('nik')->on('karyawans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kualifikasi_gownings');
    }
};
