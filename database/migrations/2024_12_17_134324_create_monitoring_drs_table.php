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
        Schema::create('monitoring_drs', function (Blueprint $table) {
            $table->increments('id_dr');
            $table->date('tanggal_registrasi');
            $table->string('dr_number');
            $table->string('type'); // PR/NR
            $table->string('departemen');
            $table->string('batch_number');
            $table->string('impacted_batch');
            $table->string('what');
            $table->string('klasifikasi'); // minor,major,critical
            $table->string('register_by');
            $table->string('type_dr'); // BD/GF
            $table->string('status');
            $table->date('close_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_drs');
    }
};
