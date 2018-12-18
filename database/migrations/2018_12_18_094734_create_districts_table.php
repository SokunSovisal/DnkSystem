<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('districts', function (Blueprint $table) {
			$table->increments('id');
			$table->string('dist_name', 255);
			$table->integer('dist_code')->nullable();
			$table->text('dist_description')->nullable();
			$table->integer('dist_province_id')->unsigned();
			$table->timestamps();

			$table->foreign('dist_province_id')
				  ->references('id')->on('provinces')
				  ->onDelete('cascade')
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
		Schema::dropIfExists('districts');
	}
}
