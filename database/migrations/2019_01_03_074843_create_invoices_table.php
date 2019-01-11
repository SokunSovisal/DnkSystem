<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoices', function (Blueprint $table) {
			$table->increments('id');
			$table->string('inv_date', 191);
			$table->string('inv_number', 191)->unique();
			$table->string('inv_user_phone', 191)->nullable();
			$table->string('inv_com_address', 191)->nullable();
			$table->integer('inv_vat_status')->default('1');
			$table->string('inv_quote_refer', 191)->nullable();
			$table->text('inv_description')->nullable();
			$table->unsignedInteger('inv_company_id');
			$table->unsignedInteger('inv_created_by');
			$table->unsignedInteger('inv_updated_by');
			$table->timestamps();

			$table->foreign('inv_company_id')
				->references('id')->on('companies')
				->onDelete('no action')
				->onUpdate('no action');

			$table->foreign('inv_created_by')
				->references('id')->on('users')
				->onDelete('no action')
				->onUpdate('no action');

			$table->foreign('inv_updated_by')
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
		Schema::dropIfExists('invoices');
	}
}
