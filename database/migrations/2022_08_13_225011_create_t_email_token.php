<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTEmailToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_email_token', function (Blueprint $table) {
            $table->integer('id_t_email_token');
            $table->primary('id_t_email_token');
            $table->integer('id_t_reservasi');
            $table->string('email', 100);
            $table->string('token', 100);
            $table->timestamp('expired_at');
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
