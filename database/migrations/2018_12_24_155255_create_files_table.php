<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name',255);
            $table->text('f_description')->nullable();
            $table->unsignedInteger('f_fc_id');
            $table->unsignedInteger('fc_company_id');
            $table->unsignedInteger('f_created_by');
            $table->unsignedInteger('f_updated_by');
            $table->timestamps();

            $table->foreign('fc_company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('f_fc_id')
                ->references('id')->on('file_categories')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('f_created_by')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('f_updated_by')
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
        Schema::dropIfExists('files');
    }
}
