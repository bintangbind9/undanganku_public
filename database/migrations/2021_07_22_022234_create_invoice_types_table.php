<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_types', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('template_category_id')->unsigned();
            $table->string('name');
            $table->double('amount', 12, 2);
            $table->bigInteger('expired_day');
            $table->timestamps();

            $table->foreign('template_category_id')
                ->references('id')
                ->on('template_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_types');
    }
}
