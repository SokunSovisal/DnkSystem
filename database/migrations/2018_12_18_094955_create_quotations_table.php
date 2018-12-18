<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quote_number')->unique();
            $table->string('quote_date', 255);
            $table->string('quote_purpose', 255);
            $table->string('quote_cp_name', 255);
            $table->string('quote_cp_phone', 255);
            $table->string('quote_cp_email', 255);
            $table->text('quote_term')->nullable();
            $table->integer('quote_status')->default('1');
            $table->unsignedInteger('quote_company_id');
            $table->unsignedInteger('quote_created_by');
            $table->unsignedInteger('quote_updated_by');
            $table->timestamps();

            $table->foreign('quote_company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('quote_created_by')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('quote_updated_by')
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
        Schema::dropIfExists('quotations');
    }
}
