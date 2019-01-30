<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('st_name');
            $table->string('st_email',191)->nullable();
            $table->string('st_image', 191)->nullable();
            $table->string('st_phone', 191)->nullable();
            $table->string('st_position', 15)->nullable();
            $table->float('st_salary')->nullable();
            $table->integer('st_gender')->default('1');
            $table->text('st_description')->nullable();
            $table->timestamps();
            $table->unsignedInteger('st_created_by');
            $table->unsignedInteger('st_updated_by');

            $table->foreign('st_created_by')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('st_updated_by')
                ->references('id')->on('users')
                ->onDelete('no action')
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
        Schema::dropIfExists('staffs');
    }
}
