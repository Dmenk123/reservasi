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
            $table->string('status_code', 3)->nullable();
            $table->string('status_message', 50)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->string('order_id', 10)->nullable();
            $table->string('payment_type', 50)->nullable();
            $table->timestamp('transaction_time')->nullable();
            $table->string('transaction_status', 50)->nullable();
            $table->string('va_number', 50)->nullable();
            $table->string('fraud_status', 50)->nullable();
            $table->string('bca_va_number', 50)->nullable();
            $table->string('permata_va_number', 50)->nullable();
            $table->string('pdf_url', 200)->nullable();
            $table->string('finish_redirect_url', 200)->nullable();
            $table->string('bill_key', 50)->nullable();
            $table->string('biller_code', 50)->nullable();
            $table->integer('opened')->nullable();
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
