<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionChecklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_checklist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tch_start_date',255);
            $table->string('tch_date_alert',255);
            $table->string('tch_name',255);
            $table->text('tch_description')->nullable();
            $table->unsignedInteger('tch_checklist_id');
            $table->unsignedInteger('tch_transaction_id');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->timestamps();

            $table->foreign('tch_checklist_id')
                ->references('id')->on('checklist')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('tch_transaction_id')
                ->references('id')->on('process')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('updated_by')
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
        Schema::dropIfExists('transaction_checklist');
    }
}
