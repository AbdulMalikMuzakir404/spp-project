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
        DB::unprepared('
        CREATE TRIGGER log_spp BEFORE UPDATE ON `spps` FOR EACH ROW
            BEGIN
                INSERT INTO log_spp SET tahun_lama = old.tahun, tahun_baru = new.tahun, nominal_lama = old.nominal, nominal_baru = new.nominal, waktu = now();
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //  Schema::dropIfExists('spp_trigger');
    }
};