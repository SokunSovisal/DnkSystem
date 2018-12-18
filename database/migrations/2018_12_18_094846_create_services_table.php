<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('s_name')->unique();
            $table->float('s_price');
            $table->text('s_description')->nullable();
            $table->integer('s_alert')->default('0');
            $table->unsignedInteger('s_ms_id');
            $table->unsignedInteger('s_created_by');
            $table->unsignedInteger('s_updated_by');
            $table->timestamps();

            $table->foreign('s_ms_id')
                ->references('id')->on('mainservices')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('s_created_by')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('s_updated_by')
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
        Schema::dropIfExists('services');
    }
}
