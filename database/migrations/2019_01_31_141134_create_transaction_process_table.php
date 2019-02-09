<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_process', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tp_start_date',255);
            $table->string('tp_date_alert',255);
            $table->string('tp_name',255);
            $table->text('tp_description')->nullable();
            $table->unsignedInteger('tp_process_id');
            $table->unsignedInteger('tp_transaction_id');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->timestamps();

            $table->foreign('tp_process_id')
                ->references('id')->on('process')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('tp_transaction_id')
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
        Schema::dropIfExists('transaction_process');
    }
}
