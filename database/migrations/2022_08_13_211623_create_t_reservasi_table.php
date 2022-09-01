<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_reservasi', function (Blueprint $table) {
            $table->integer('id_t_reservasi');
            $table->primary('id_t_reservasi');
            $table->string('nm_t_reservasi',100);
            $table->string('email_reservasi',100);
            $table->string('kode_t_reservasi',20);
            $table->string('telp_t_reservasi',15);
            $table->integer('id_m_proses');
            $table->string('hari_t_reservasi', 10);
            $table->date('tanggal_t_reservasi');
            $table->time('jam_t_reservasi');
            $table->string('jenis_t_reservasi', 6); //cash //credit
            $table->string('metode_pembayaran_t_reservasi', 20); //upload //payment gateway
            $table->string('kode_payment_t_reservasi', 50)->nullable(); //kode dari midtrans
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->integer('verified_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_reservasi');
    }
}
