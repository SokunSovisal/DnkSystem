<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('com_name')->unique();
            $table->string('com_phone', 45)->nullable();
            $table->string('com_email', 55)->nullable();
            $table->integer('com_tax_size');
            $table->string('com_vat_id', 55)->nullable();
            $table->string('com_logo')->nullable();
            $table->text('com_description')->nullable();
            $table->string('com_cus_status', 45)->default('0');
            $table->string('com_addr_map')->nullable();
            $table->string('com_addr_house', 45)->nullable();
            $table->string('com_addr_street', 45)->nullable();
            $table->string('com_addr_group', 45)->nullable();
            $table->string('com_addr_village', 45)->nullable();
            $table->string('com_addr_commune', 45)->nullable();
            $table->string('com_cp_name', 55);
            $table->string('com_cp_phone', 65);
            $table->string('com_cp_email', 45)->nullable();
            $table->integer('com_cp_gender');
            $table->text('com_cp_description')->nullable();
            $table->unsignedInteger('com_district_id');
            $table->unsignedInteger('com_province_id');
            $table->unsignedInteger('com_objective_id');
            $table->unsignedInteger('com_created_by');
            $table->unsignedInteger('com_updated_by');
            $table->timestamps();

            $table->foreign('com_district_id')
                ->references('id')->on('districts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('com_province_id')
                ->references('id')->on('provinces')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('com_objective_id')
                ->references('id')->on('objectives')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('com_created_by')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('com_updated_by')
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
        Schema::dropIfExists('companies');
    }
}
