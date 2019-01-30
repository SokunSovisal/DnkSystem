<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
			$table->string('br_date', 191);
			$table->string('br_number', 191)->nullable();
			$table->float('br_total')->nullable();
			$table->text('br_description')->nullable();
			$table->integer('br_paid_status')->default('0');
			$table->unsignedInteger('br_company_id');
			$table->unsignedInteger('br_created_by');
			$table->unsignedInteger('br_updated_by');
			$table->timestamps();

			$table->foreign('br_company_id')
				->references('id')->on('companies')
				->onDelete('no action')
				->onUpdate('no action');

			$table->foreign('br_created_by')
				->references('id')->on('users')
				->onDelete('no action')
				->onUpdate('no action');

			$table->foreign('br_updated_by')
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
        Schema::dropIfExists('bills');
    }
}
