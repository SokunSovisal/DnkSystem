<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('app_datetime', 255);
            $table->text('app_description')->nullable();
            $table->integer('app_status')->default('0');
            $table->string('app_services_id', 255);
            $table->unsignedInteger('app_company_id');
            $table->unsignedInteger('app_users_id');
            $table->unsignedInteger('app_created_by');
            $table->unsignedInteger('app_updated_by');
            $table->timestamps();

            $table->foreign('app_company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('app_users_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('app_created_by')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('app_updated_by')
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
        Schema::dropIfExists('appointments');
    }
}
