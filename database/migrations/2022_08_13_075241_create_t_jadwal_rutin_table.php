<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTJadwalRutinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_jadwal_rutin', function (Blueprint $table) {
            $table->integer('id_t_jadwal_rutin');
            $table->primary('id_t_jadwal_rutin');
            $table->integer('id_m_interval');
            $table->integer('urut_t_jadwal_rutin');
            $table->time("jam_mulai");
            $table->time("jam_akhir");
            $table->string('hari',100);
            $table->smallInteger('status')->nullable();
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
        Schema::dropIfExists('t_jadwal_rutin');
    }
}
