<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('p_view')->default('0');
            $table->integer('p_create')->default('0');
            $table->integer('p_edit')->default('0');
            $table->integer('p_delete')->default('0');
            $table->integer('p_only_me')->default('0');
            $table->unsignedInteger('p_module_id');
            $table->unsignedInteger('p_role_id');
            $table->timestamps();

            $table->foreign('p_module_id')
                ->references('id')->on('modules')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('p_role_id')
                ->references('id')->on('user_roles')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
