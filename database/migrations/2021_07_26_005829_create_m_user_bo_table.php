<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMUserBoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_user_bo', function (Blueprint $table) {
            $table->integer('id_m_user_bo');
            $table->primary('id_m_user_bo');
            $table->string('username',40);
            $table->string('nm_user_bo',100);
            $table->string('password',100);
            $table->foreignId('id_m_user_group_bo')->constrained('id_m_user_group_bo')->onDelete('cascade');
            $table->string('aktif',1);
            $table->timestamp('last_login')->nullable();
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
        Schema::dropIfExists('m_user_bo');
    }
}
