<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMMenuBoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * id_m_menu_bo
            nm_menu_bo
            aktif
            icon
            route
            id_parent
            created_at
            updated_at
            order_m_menu_bo
            head_title
            page_title
            parent_menu_active
            child_menu_active
            id_m_process
            note_m_menu_bo
         */
        Schema::create('m_menu_bo', function (Blueprint $table) {
            $table->integer('id_m_menu_bo');
            $table->primary('id_m_menu_bo');
            $table->string('nm_menu_bo',100);
            $table->string('aktif',1);
            $table->string('icon',50);
            $table->string('route',100)->nullable();
            $table->integer('id_parent')->nullable();
            $table->integer('order_m_menu_bo')->nullable();
            $table->string('head_title',100)->nullable();
            $table->string('page_title',100)->nullable();
            $table->string('parent_menu_active',100)->nullable();
            $table->string('child_menu_active',100)->nullable();
            $table->integer('id_m_process')->nullable();
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
        Schema::dropIfExists('m_menu_bo');
    }
}
