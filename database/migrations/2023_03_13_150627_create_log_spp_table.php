<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_spp', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_lama');
            $table->string('tahun_baru');
            $table->string('nominal_lama');
            $table->string('nominal_baru');
            $table->date('waktu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_spp');
    }
};