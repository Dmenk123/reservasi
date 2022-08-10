<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMHakAksesBoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_hak_akses_bo', function (Blueprint $table) {
            $table->integer('id_m_hak_akses_bo');
            $table->primary('id_m_hak_akses_bo');
            $table->integer('id_m_user_group_bo');
            $table->integer('id_m_menu_bo');
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
        Schema::dropIfExists('m_hak_akses_bo');
    }
}
