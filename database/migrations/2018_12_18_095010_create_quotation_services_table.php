<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_services', function (Blueprint $table) {
            $table->increments('id');
            $table->float('qs_price');
            $table->integer('qs_qty');
            $table->text('qs_description')->nullable();
            $table->unsignedInteger('qs_quote_id');
            $table->unsignedInteger('qs_service_id');
            $table->unsignedInteger('qs_created_by');
            $table->unsignedInteger('qs_updated_by');
            $table->timestamps();
            
            $table->foreign('qs_quote_id')
                ->references('id')->on('quotations')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('qs_service_id')
                ->references('id')->on('services')
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
        Schema::dropIfExists('quotation_services');
    }
}
