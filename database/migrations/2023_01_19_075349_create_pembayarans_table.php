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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->string('nisn');
            $table->index('nisn');
            $table->foreign('nisn')->references('nisn')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('spp_id');
            $table->index('spp_id');
            $table->foreign('spp_id')->references('id')->on('spps')->onDelete('cascade');

            $table->string('kode_transaction', 40)->unique();
            $table->string('nama_siswa', 50);
            $table->string('nama_pengelola', 50);
            $table->string('tgl_dibayar', 5);
            $table->string('bln_dibayar', 15);
            $table->string('thn_dibayar', 10);
            $table->string('jumlah_bayar', 20);
            $table->boolean('status_pembayaran');
            $table->enum('midtrans_status', ['success', 'pending', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
};
