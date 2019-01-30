<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTransitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transitions', function (Blueprint $table) {
            $table->increments('id');
			$table->string('pt_date', 191);
			$table->string('pt_number', 191)->nullable();
			$table->float('pt_ammount')->nullable();
			$table->text('pt_description')->nullable();
			$table->unsignedInteger('pt_bill_id');
			$table->unsignedInteger('pt_created_by');
			$table->unsignedInteger('pt_updated_by');
			$table->timestamps();

			$table->foreign('pt_bill_id')
				->references('id')->on('bills')
				->onDelete('cascade')
				->onUpdate('no action');

			$table->foreign('pt_created_by')
				->references('id')->on('users')
				->onDelete('no action')
				->onUpdate('no action');

			$table->foreign('pt_updated_by')
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
        Schema::dropIfExists('payment_transitions');
    }
}
