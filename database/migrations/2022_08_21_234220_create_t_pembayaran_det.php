<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPembayaranDet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pembayaran_det', function (Blueprint $table) {
            $table->integer('id_t_pembayaran_det');
            $table->primary('id_t_pembayaran_det');
            $table->integer('id_t_pembayaran');
            $table->decimal('nominal_t_pembayaran_det', 20, 0);
            $table->string('kode_konfirmasi', 100);
            $table->date('tgl_t_pembayaran_det');
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
        Schema::dropIfExists('t_pembayaran_det');
    }
}
