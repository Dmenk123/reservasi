<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTReservasiDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ###asasa
        Schema::create('t_reservasi_det', function (Blueprint $table) {
            $table->integer('id_t_reservasi_det');
            $table->primary('id_t_reservasi_det');
            $table->string('kode_t_reservasi', 100)->nullable();
            $table->string('kode_konfirmasi', 100)->nullable();
            $table->string('original', 100)->nullable();
            $table->string('medium', 100)->nullable();
            $table->string('small', 100)->nullable();
            $table->string('bank', 100)->nullable();
            $table->decimal('nominal', 20, 0)->default(0);
            $table->integer('verified_by')->nullable();
            $table->timestamp('verified_at')->nullable();
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
        Schema::dropIfExists('t_reservasi_det');
    }
}
