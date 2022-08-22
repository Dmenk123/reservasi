<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pembayaran', function (Blueprint $table) {
            $table->integer('id_t_pembayaran');
            $table->primary('id_t_pembayaran');
            $table->integer('id_t_reservasi');
            $table->decimal('nilai_t_pembayaran', 20, 0); // nilai pembayaran
            $table->string('jenis_t_pembayaran', 100); // cash, cicilan
            $table->decimal('balance_t_pembayaran', 20, 0); // balance uang
            $table->decimal('nominal_cicilan_t_pembayaran', 20, 0)->nullable(); // nilai cicilan (jika jenis cicilan)
            $table->smallInteger('durasi_cicilan_t_pembayaran')->nullable(); // durasi cicilan (jika jenis cicilan)
            $table->smallInteger('cicilan_ke_t_pembayaran')->nullable(); // jumlah ciciran terbayar (jika jenis cicilan)
            $table->decimal('nominal_total_t_pembayaran', 20, 0)->default(0); // jumlah yg telah terbayar
            $table->date('tgl_pelunasan_t_pembayaran')->nullable(); // tgl lunass
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
        Schema::dropIfExists('t_email_token');
    }
}
