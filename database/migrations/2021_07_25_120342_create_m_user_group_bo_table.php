<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMUserGroupBoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_user_group_bo', function (Blueprint $table) {
            $table->integer('id_m_user_group_bo');
            $table->primary('id_m_user_group_bo');
            $table->string('nm_user_group_bo',40)->nullable();
            $table->string('aktif',1);
            $table->string('keterangan',255)->nullable();
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
        Schema::dropIfExists('m_user_group_bo');
    }
}
