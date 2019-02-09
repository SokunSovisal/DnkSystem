<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tr_name',255);
            $table->string('tr_start_date',255);
            $table->string('tr_date_alert',255);
            $table->Integer('tr_invoice_id')->nullable();
            $table->text('tr_description')->nullable();
            $table->unsignedInteger('tr_company_id');
            $table->unsignedInteger('tr_service_id');
            $table->unsignedInteger('tr_verify_by');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->timestamps();

            $table->foreign('tr_company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('tr_service_id')
                ->references('id')->on('services')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('tr_verify_by')
                ->references('id')->on('users')
                ->onDelete('no action')
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
        Schema::dropIfExists('transactions');
    }
}
