<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE PROCEDURE create_ruang(IN nama_kelas VARCHAR(10), IN kopetensi_keahlian VARCHAR(10), IN created_at TIMESTAMP, IN updated_at TIMESTAMP)
        BEGIN
            INSERT INTO ruangs (nama_kelas, kopetensi_keahlian, created_at, updated_at) VALUES (nama_kelas, kopetensi_keahlian, created_at, updated_at);
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('ruangs_prosedure');
    }
};