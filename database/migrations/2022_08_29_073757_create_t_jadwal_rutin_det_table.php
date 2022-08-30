<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTJadwalRutinDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_jadwal_rutin_det', function (Blueprint $table) {
            $table->integer('id_t_jadwal_rutin_det');
            $table->primary('id_t_jadwal_rutin_det');
            $table->integer('id_t_jadwal_rutin');
            $table->integer('sesi'); //1,2,3,4,5,6,7,8
            $table->time("pukul");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_jadwal_rutin_det');
    }
}
