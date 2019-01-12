<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rec_date', 191);
			$table->string('rec_number', 191)->unique();
			$table->float('rec_full_ammount');
			$table->float('rec_received_ammount');
			$table->float('rec_balance');
			$table->text('rec_description')->nullable();
			$table->unsignedInteger('rec_inv_id');
			$table->unsignedInteger('rec_company_id');
			$table->unsignedInteger('rec_created_by');
			$table->unsignedInteger('rec_updated_by');
			$table->timestamps();

			$table->foreign('rec_inv_id')
				->references('id')->on('invoices')
				->onDelete('cascade')
				->onUpdate('no action');

			$table->foreign('rec_company_id')
				->references('id')->on('companies')
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
        Schema::dropIfExists('receipts');
    }
}
