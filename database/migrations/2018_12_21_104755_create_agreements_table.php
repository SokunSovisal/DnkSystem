<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('agr_files',255);
            $table->text('agr_description');
            $table->unsignedInteger('agr_company_id');
            $table->unsignedInteger('agr_created_by');
            $table->unsignedInteger('agr_updated_by');
            $table->timestamps();

            $table->foreign('agr_company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('agr_created_by')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('agr_updated_by')
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
        Schema::dropIfExists('agreements');
    }
}
