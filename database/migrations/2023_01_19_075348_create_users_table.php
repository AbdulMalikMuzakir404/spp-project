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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 25)->nullable();
            $table->string('password', 70)->nullable();
            $table->string('password_show', 70)->nullable();
            $table->string('email', 70)->unique()->nullable();
            $table->string('name', 35);
            $table->enum('level', ['admin', 'petugas', 'siswa']);

            $table->string('photo', 70)->nullable();

            $table->unsignedBigInteger('ruang_id')->nullable();
            $table->index('ruang_id');
            $table->foreign('ruang_id')->references('id')->on('ruangs')->onDelete('cascade');

            // $table->unsignedBigInteger('spp_id')->nullable();
            // $table->index('spp_id');
            // $table->foreign('spp_id')->references('id')->on('spps')->onDelete('cascade');

            $table->string('nisn', 20)->unique()->nullable();
            $table->string('nis', 70)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('no_telp', 20)->nullable();

            $table->string('total_bayar', 40)->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};