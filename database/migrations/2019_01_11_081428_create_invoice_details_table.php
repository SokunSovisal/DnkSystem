<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->float('invd_price');
            $table->integer('invd_qty');
			$table->text('invd_description')->nullable();
			$table->unsignedInteger('invd_invoice_id');
			$table->unsignedInteger('invd_service_id');
            $table->timestamps();

			$table->foreign('invd_invoice_id')
				->references('id')->on('invoices')
				->onDelete('cascade')
				->onUpdate('no action');

			$table->foreign('invd_service_id')
				->references('id')->on('services')
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
        Schema::dropIfExists('invoice_details');
    }
}
